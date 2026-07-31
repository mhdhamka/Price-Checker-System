<?php

session_start();


include __DIR__ . "/../../../../config/db_cPCS.php";

include __DIR__ . "/../../reportLogger.php";

include __DIR__ . "/../../../../config/auditLog.php";



$adminID=$_SESSION['adminID'] ?? null;



if(!$adminID)
{
    exit("Access denied.");
}




/* ==========================================
   FILE NAME
========================================== */


$filename="Forum_Analytics_Report.json";



$data=[];




/* ==========================================
   COMMUNITY STATISTICS
========================================== */


$statistics=[];



$statistics[]=[

    "metric"=>"Total Topics",

    "total"=>mysqli_fetch_assoc(mysqli_query($conn,

    "SELECT COUNT(*) total FROM forumtopic"

    ))['total']

];



$statistics[]=[

    "metric"=>"Total Replies",

    "total"=>mysqli_fetch_assoc(mysqli_query($conn,

    "SELECT COUNT(*) total FROM forumreply"

    ))['total']

];



$statistics[]=[

    "metric"=>"Total Reports",

    "total"=>mysqli_fetch_assoc(mysqli_query($conn,

    "SELECT COUNT(*) total FROM forumreport"

    ))['total']

];



$statistics[]=[

    "metric"=>"Approved Reports",

    "total"=>mysqli_fetch_assoc(mysqli_query($conn,

    "
    SELECT COUNT(*) total
    FROM forumreport
    WHERE status='Approved'
    "

    ))['total']

];



$statistics[]=[

    "metric"=>"Rejected Reports",

    "total"=>mysqli_fetch_assoc(mysqli_query($conn,

    "
    SELECT COUNT(*) total
    FROM forumreport
    WHERE status='Rejected'
    "

    ))['total']

];



$statistics[]=[

    "metric"=>"Pending Reports",

    "total"=>mysqli_fetch_assoc(mysqli_query($conn,

    "
    SELECT COUNT(*) total
    FROM forumreport
    WHERE status='Pending'
    "

    ))['total']

];





$data["community_statistics"]=$statistics;





/* ==========================================
   MOST REPORTED TOPICS
========================================== */


$topics=[];



$result=mysqli_query($conn,


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
        WHERE forumreply.topicID = t.topicID
    )
)

GROUP BY t.topicID

ORDER BY totalReports DESC

LIMIT 10

"


);



while($row=mysqli_fetch_assoc($result))
{

    $topics[]=$row;

}



$data["most_reported_topics"]=$topics;







/* ==========================================
   MODERATOR ACTIVITY
========================================== */


$logs=[];



$result=mysqli_query($conn,


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



while($row=mysqli_fetch_assoc($result))
{

    $logs[]=$row;

}



$data["moderator_activity"]=$logs;







/* ==========================================
   EXPORT JSON
========================================== */



header("Content-Type:application/json");


header(
"Content-Disposition: attachment; filename=".$filename
);






/* ==========================================
   REPORT LOG
========================================== */


logReport(

    $conn,

    $adminID,

    "forum",

    "JSON"

);






/* ==========================================
   AUDIT LOG
========================================== */


createAuditLog(

    $conn,

    $adminID,

    "Forum Admin",

    "EXPORT",

    "Forum Analytics JSON",

    "Generated Forum Analytics report as JSON file: ".$filename

);







echo json_encode(

$data,

JSON_PRETTY_PRINT

);





exit();

?>