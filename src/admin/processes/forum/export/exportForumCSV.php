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
   FORUM ANALYTICS CSV
========================================== */


$filename="Forum_Analytics_Report.csv";



header("Content-Type: text/csv; charset=UTF-8");

header(
"Content-Disposition: attachment; filename=".$filename
);



/* UTF-8 BOM */
echo "\xEF\xBB\xBF";



$output=fopen("php://output","w");




/* ==========================================
   COMMUNITY STATISTICS
========================================== */


fputcsv($output,[

    "Metric",
    "Total"

]);



$statistics=[


[
"Total Topics",

mysqli_fetch_assoc(mysqli_query($conn,

"SELECT COUNT(*) total FROM forumtopic"

))['total']

],



[
"Total Replies",

mysqli_fetch_assoc(mysqli_query($conn,

"SELECT COUNT(*) total FROM forumreply"

))['total']

],



[
"Total Reports",

mysqli_fetch_assoc(mysqli_query($conn,

"SELECT COUNT(*) total FROM forumreport"

))['total']

],



[
"Approved Reports",

mysqli_fetch_assoc(mysqli_query($conn,

"
SELECT COUNT(*) total
FROM forumreport
WHERE status='Approved'

"

))['total']

],



[
"Rejected Reports",

mysqli_fetch_assoc(mysqli_query($conn,

"
SELECT COUNT(*) total
FROM forumreport
WHERE status='Rejected'

"

))['total']

],



[
"Pending Reports",

mysqli_fetch_assoc(mysqli_query($conn,

"
SELECT COUNT(*) total
FROM forumreport
WHERE status='Pending'

"

))['total']

]


];





foreach($statistics as $stat)
{

    fputcsv($output,$stat);

}




/* ==========================================
   MOST REPORTED TOPICS
========================================== */


fputcsv($output,[]);


fputcsv($output,[

    "Most Reported Topics"

]);



fputcsv($output,[

    "Topic",
    "Reports",
    "Status"

]);



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
        WHERE forumreply.topicID = t.topicID
    )
)

GROUP BY t.topicID

ORDER BY totalReports DESC

LIMIT 10

"


);



while($topic=mysqli_fetch_assoc($topics))
{

    fputcsv($output,[

        $topic['topicTitle'],

        $topic['totalReports'],

        $topic['status']

    ]);

}




/* ==========================================
   MODERATOR ACTIVITY
========================================== */


fputcsv($output,[]);


fputcsv($output,[

    "Moderator Activity"

]);



fputcsv($output,[

    "Action",
    "Description",
    "Date"

]);




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





while($log=mysqli_fetch_assoc($logs))
{


    fputcsv($output,[

        $log['action'],

        $log['description'],

        $log['created_at']

    ]);


}




fclose($output);





/* ==========================================
   REPORT LOG
========================================== */


logReport(

    $conn,

    $adminID,

    "forum",

    "CSV"

);





/* ==========================================
   AUDIT LOG
========================================== */


createAuditLog(

    $conn,

    $adminID,

    "Forum Admin",

    "EXPORT",

    "Forum Analytics CSV",

    "Generated Forum Analytics report in CSV format"

);





exit();

?>