<?php

session_start();


require __DIR__ . "/../../../../../vendor/autoload.php";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



include __DIR__ . "/../../../../config/db_cPCS.php";

include __DIR__ . "/../../reportLogger.php";

include __DIR__ . "/../../../../config/auditLog.php";



$adminID=$_SESSION['adminID'] ?? null;


if(!$adminID)
{
    exit("Access denied.");
}




$spreadsheet=new Spreadsheet();

$sheet=$spreadsheet->getActiveSheet();


$sheet->setTitle("Forum Analytics");





/* =====================================
   HEADERS
===================================== */


$headers=[

    "Metric",
    "Total"

];



$column="A";


foreach($headers as $header)
{

    $sheet->setCellValue(
        $column."1",
        $header
    );

    $column++;

}




/* =====================================
   COMMUNITY STATISTICS
===================================== */


$data=[


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





$row=2;


foreach($data as $item)
{

    $sheet->setCellValue(
        "A".$row,
        $item[0]
    );


    $sheet->setCellValue(
        "B".$row,
        $item[1]
    );


    $row++;

}





/* =====================================
   MOST REPORTED TOPICS
===================================== */


$row+=2;


$sheet->setCellValue(
"A".$row,
"Most Reported Topics"
);


$row++;


$topicHeaders=[

"Topic",
"Reports",
"Status"

];


$column="A";


foreach($topicHeaders as $header)
{

    $sheet->setCellValue(
        $column.$row,
        $header
    );


    $column++;

}



$row++;




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


$sheet->setCellValue(
"A".$row,
$topic['topicTitle']
);



$sheet->setCellValue(
"B".$row,
$topic['totalReports']
);



$sheet->setCellValue(
"C".$row,
$topic['status']
);



$row++;


}







/* =====================================
   MODERATOR ACTIVITY
===================================== */


$row+=2;


$sheet->setCellValue(
"A".$row,
"Moderator Activity"
);


$row++;



$activityHeaders=[

"Action",
"Description",
"Date"

];



$column="A";


foreach($activityHeaders as $header)
{

    $sheet->setCellValue(
        $column.$row,
        $header
    );


    $column++;

}




$row++;



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


$sheet->setCellValue(
"A".$row,
$log['action']
);



$sheet->setCellValue(
"B".$row,
$log['description']
);



$sheet->setCellValue(
"C".$row,
$log['created_at']
);



$row++;


}





/* =====================================
   AUTO SIZE
===================================== */


foreach(range('A','C') as $column)
{

    $sheet->getColumnDimension($column)
    ->setAutoSize(true);

}





/* =====================================
   EXPORT
===================================== */


$filename="Forum_Analytics_Report.xlsx";


$writer=new Xlsx($spreadsheet);



header(
'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);



header(
'Content-Disposition: attachment; filename="'.$filename.'"'
);



$writer->save("php://output");







/* =====================================
   REPORT LOG
===================================== */


logReport(

$conn,

$adminID,

"forum",

"Excel"

);







/* =====================================
   AUDIT LOG
===================================== */


createAuditLog(

$conn,

$adminID,

"Forum Admin",

"EXPORT",

"Forum Analytics Excel",

"Generated Forum Analytics Excel report"

);




exit();

?>