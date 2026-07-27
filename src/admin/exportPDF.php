<?php

session_start();

require '../../vendor/autoload.php';

use Dompdf\Dompdf;

include("../config/db_cPCS.php");

include("../admin/processes/reportLogger.php");

include("../config/auditLog.php");


$adminID=$_SESSION['adminID'] ?? null;


if(!$adminID)
{
    exit("Access denied.");
}


$type=$_GET['type'] ?? 'item';


$store=mysqli_real_escape_string(
$conn,
$_GET['store'] ?? ''
);


$category=mysqli_real_escape_string(
$conn,
$_GET['category'] ?? ''
);


$from=$_GET['from'] ?? '';

$to=$_GET['to'] ?? '';


$html = "

<style>

table{
    border-collapse:collapse;
    width:100%;
}

th{
    background:#ED563B;
    color:white;
}

td,th{
    padding:8px;
    border:1px solid #000;
}

h1{
    text-align:center;
}

</style>


<h1>Price Checker System Report</h1>

<p>
    Generated Date: ".date("d-m-Y")."
</p>

";


function addFilters($sql,$store,$category,$from,$to)
{

    if($store!="")
    {
        $sql .= " AND StoreName='$store'";
    }


    if($category!="")
    {
        $sql .= " AND ItemCategory='$category'";
    }


    if($from!="" && $to!="")
    {
        $sql .= "
        AND dateCreated 
        BETWEEN '$from'
        AND '$to'
        ";
    }


    return $sql;

}


/* ============================
ITEM REPORT
============================ */

if($type=="item")
{

$html .= "

<h2>Item Report</h2>

<table>

<tr>

    <th>Product Name</th>
    <th>Category</th>
    <th>Store</th>
    <th>Price</th>

</tr>

";


$sql="

SELECT 

ItemName,
ItemCategory,
StoreName,
ItemPrice

FROM item

WHERE 1

";

$sql=addFilters(
$sql,
$store,
$category,
$from,
$to
);


$sql.=" ORDER BY ItemName";


$query=mysqli_query($conn,$sql);


while($row=mysqli_fetch_assoc($query))
{

$html .= "

<tr>

    <td>{$row['ItemName']}</td>

    <td>{$row['ItemCategory']}</td>

    <td>{$row['StoreName']}</td>

    <td>RM {$row['ItemPrice']}</td>

</tr>

";

}


$filename="Item_Report.pdf";


}


/* ============================
STUDENT REPORT
============================ */

else if($type=="student")
{

$html .= "

<h2>Student Report</h2>


<table>

<tr>

    <th>ID</th>
    <th>Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Status</th>
    <th>Total Ratings</th>

</tr>

";


$sql="

SELECT

student.studentID,
student.fullName,
student.username,
student.email,
student.logStatus,
student.created_at,

COUNT(ratings.ratingID) AS totalRatings


FROM student


LEFT JOIN ratings

ON student.studentID = ratings.studentID


WHERE 1

";



if($from!="" && $to!="")
{

$sql.="

AND student.created_at

BETWEEN '$from'
AND '$to'

";

}



$sql.="

GROUP BY student.studentID

ORDER BY fullName

";


$query=mysqli_query($conn,$sql);


while($row=mysqli_fetch_assoc($query))
{

$status=$row['logStatus']
? "Active"
: "Disabled";


$html.="

<tr>

    <td>{$row['studentID']}</td>

    <td>{$row['fullName']}</td>

    <td>{$row['username']}</td>

    <td>{$row['email']}</td>

    <td>{$status}</td>

    <td>{$row['totalRatings']}</td>

</tr>

";


}


$filename="Student_Report.pdf";


}


/* ============================
RATING REPORT
============================ */

else if($type=="rating")
{


$html.="


<h2>Rating Report</h2>


<table>


<tr>

    <th>ID</th>
    <th>Product</th>
    <th>Student</th>
    <th>Rating</th>
    <th>Comment</th>
    <th>Date</th>


</tr>


";


$sql="

SELECT

ratings.ratingID,
item.ItemName,
student.fullName,
ratings.rating,
ratings.comment,
ratings.dateCreated,
item.StoreName,
item.ItemCategory


FROM ratings


JOIN item

ON ratings.ItemID=item.ItemID


JOIN student

ON ratings.studentID=student.studentID


WHERE 1

";


if($store!="")
{
$sql.=" AND item.StoreName='$store'";
}


if($category!="")
{
$sql.=" AND item.ItemCategory='$category'";
}


if($from!="" && $to!="")
{
$sql.=" 
AND ratings.dateCreated 
BETWEEN '$from'
AND '$to'
";
}


$sql.=" ORDER BY ratings.dateCreated DESC";


$query=mysqli_query($conn,$sql);


while($row=mysqli_fetch_assoc($query))
{


$html.="


<tr>

    <td>{$row['ratingID']}</td>
    <td>{$row['ItemName']}</td>
    <td>{$row['fullName']}</td>
    <td>{$row['rating']}</td>
    <td>{$row['comment']}</td>
    <td>{$row['dateCreated']}</td>

</tr>


";


}


$filename="Rating_Report.pdf";


}



$html.="</table>";


$pdf=new Dompdf();


$pdf->loadHtml($html);


$pdf->setPaper('A4','landscape');


$pdf->render();


$pdf->render();


$pdf->stream(
    $filename,
    [
        "Attachment"=>true
    ]
);



logReport(
    $conn,
    $adminID,
    $type,
    "PDF"
);



createAuditLog(

    $conn,

    $adminID,

    "Report",

    "EXPORT",

    ucfirst($type)." Report PDF",

    "Generated ".ucfirst($type)." PDF report"
    .
    ($store!="" ? " | Store: ".$store : "")
    .
    ($category!="" ? " | Category: ".$category : "")
    .
    ($from!="" && $to!="" ? " | Date: ".$from." to ".$to : "")

);



exit();


?>