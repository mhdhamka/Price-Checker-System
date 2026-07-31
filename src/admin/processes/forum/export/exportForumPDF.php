<?php

session_start();


require __DIR__ . "/../../../../../vendor/autoload.php";


use Dompdf\Dompdf;



include __DIR__ . "/../../../../config/db_cPCS.php";

include __DIR__ . "/../../reportLogger.php";

include __DIR__ . "/../../../../config/auditLog.php";



$adminID=$_SESSION['adminID'] ?? null;



if(!$adminID)
{
    exit("Access denied.");
}




/* =====================================
   STATISTICS
===================================== */


$totalTopics=mysqli_fetch_assoc(mysqli_query($conn,

"
   SELECT COUNT(*) total
   FROM forumtopic

"

))['total'];




$totalReplies=mysqli_fetch_assoc(mysqli_query($conn,

"
   SELECT COUNT(*) total
   FROM forumreply

"

))['total'];




$totalReports=mysqli_fetch_assoc(mysqli_query($conn,

"
   SELECT COUNT(*) total
   FROM forumreport

"

))['total'];




$approvedReports=mysqli_fetch_assoc(mysqli_query($conn,

"
   SELECT COUNT(*) total
   FROM forumreport
   WHERE status='Approved'

"

))['total'];




$rejectedReports=mysqli_fetch_assoc(mysqli_query($conn,

"
   SELECT COUNT(*) total
   FROM forumreport
   WHERE status='Rejected'

"

))['total'];




$pendingReports=mysqli_fetch_assoc(mysqli_query($conn,

"
   SELECT COUNT(*) total
   FROM forumreport
   WHERE status='Pending'

"

))['total'];







/* =====================================
   MOST REPORTED TOPICS
===================================== */


$topics=mysqli_query($conn,


"
   SELECT

   t.topicTitle,

   COUNT(fr.reportID) AS totalReports,

   t.status

   FROM forumtopic t

   LEFT JOIN forumreport fr

   ON 
   (
      t.topicID = fr.topicID
   )

   OR

   (
      fr.replyID IN
      (
         SELECT replyID
         FROM forumreply
         WHERE forumreply.topicID=t.topicID
      )
   )

   GROUP BY t.topicID

   ORDER BY totalReports DESC

   LIMIT 10


"

);







/* =====================================
   MODERATOR ACTIVITY
===================================== */


$logs=mysqli_query($conn,


"
   SELECT

   action,

   description,

   created_at


   FROM audit_logs


   WHERE module='Forum Admin'


   ORDER BY created_at DESC


   LIMIT 10


"

);







/* =====================================
   BUILD PDF HTML
===================================== */


$html="

<style>


   body{

      font-family:Arial, sans-serif;

      color:#333;

      font-size:12px;

   }


   h1{

      text-align:center;

      color:#ED563B;

   }



   h2{

      color:#ED563B;

      margin-top:25px;

   }



   .summary{


      display:flex;

   }



   .card{


      border:1px solid #ddd;

      padding:12px;

      margin-bottom:15px;

      border-radius:8px;

   }



   table{


      width:100%;

      border-collapse:collapse;

      margin-top:10px;


   }



   th{


      background:#ED563B;

      color:white;

      padding:8px;

   }



   td{


      padding:8px;

      border:1px solid #ddd;


   }



   .stat{


      font-size:14px;

      font-weight:bold;

   }



</style>





<h1>
Forum Analytics Report
</h1>



<p>
Generated Date:
".date("d-m-Y")."
</p>






<h2>
Community Statistics
</h2>



<table>


<tr>

<th>
Metric
</th>


<th>
Total
</th>


</tr>



<tr>

<td>
Total Topics
</td>

<td>
$totalTopics
</td>


</tr>




<tr>

<td>
Total Replies
</td>

<td>
$totalReplies
</td>


</tr>




<tr>

<td>
Total Reports
</td>

<td>
$totalReports
</td>


</tr>




<tr>

<td>
Approved Reports
</td>

<td>
$approvedReports
</td>


</tr>



<tr>

<td>
Rejected Reports
</td>

<td>
$rejectedReports
</td>


</tr>




<tr>

<td>
Pending Reports
</td>

<td>
$pendingReports
</td>


</tr>



</table>






<h2>
Most Reported Topics
</h2>



<table>


<tr>


<th>
Topic
</th>


<th>
Reports
</th>


<th>
Status
</th>



</tr>

";





while($row=mysqli_fetch_assoc($topics))
{


$html.="


<tr>


<td>
".htmlspecialchars($row['topicTitle'])."
</td>


<td>
".$row['totalReports']."
</td>


<td>
".$row['status']."
</td>


</tr>



";


}





$html.="



</table>


<h2>
Moderator Activity
</h2>

<table>


<tr>

   <th>
      Action
   </th>

   <th>
      Description
   </th>

   <th>
      Date
   </th>

</tr>


";






while($log=mysqli_fetch_assoc($logs))
{


$html.="


<tr>


<td>
".htmlspecialchars($log['action'])."
</td>


<td>
".htmlspecialchars($log['description'])."
</td>


<td>
".$log['created_at']."
</td>


</tr>



";


}





$html.="</table>";







/* =====================================
   GENERATE PDF
===================================== */



$pdf=new Dompdf();



$pdf->loadHtml($html);



$pdf->setPaper(
'A4',
'landscape'
);



$pdf->render();



$pdf->stream(

"Forum_Analytics_Report.pdf",

[
"Attachment"=>true
]

);








/* =====================================
   REPORT LOG
===================================== */


logReport(

$conn,

$adminID,

"forum",

"PDF"

);



/* =====================================
   AUDIT LOG
===================================== */


createAuditLog(

    $conn,

    $adminID,

    "Forum Admin",

    "EXPORT",

    "Forum Analytics PDF",

    "Generated Forum Analytics PDF report"

);




exit();


?>