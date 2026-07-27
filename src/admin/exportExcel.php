<?php

session_start();

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


include("../config/db_cPCS.php");

include("../admin/processes/reportLogger.php");

include("../config/auditLog.php");

$adminID=$_SESSION['adminID'] ?? null;


if(!$adminID)
{
    exit("Access denied.");
}

$type=$_GET['type'] ?? 'item';


$spreadsheet=new Spreadsheet();
$sheet=$spreadsheet->getActiveSheet();



/* =====================
ITEM
===================== */

if($type=="item")
{


$headers=[
    "Product Name",
    "Category",
    "Store",
    "Price"
];


$sql="

SELECT

ItemName,
ItemCategory,
StoreName,
ItemPrice

FROM item

ORDER BY ItemName

";


$filename="Item_Report.xlsx";


}


/* =====================
STUDENT
===================== */

else if($type=="student")
{

$headers=[

    "Student ID",
    "Full Name",
    "Username",
    "Email",
    "Status",
    "Total Ratings"

];


$sql="

SELECT

student.studentID,
student.fullName,
student.username,
student.email,
student.logStatus,

COUNT(ratings.ratingID) AS totalRatings

FROM student

LEFT JOIN ratings

ON student.studentID=ratings.studentID

GROUP BY student.studentID

ORDER BY fullName

";


$filename="Student_Report.xlsx";


}



/* =====================
RATING
===================== */

else if($type=="rating")
{

$headers=[

    "Rating ID",
    "Product",
    "Student",
    "Rating",
    "Comment",
    "Date Created"

];


$sql="

SELECT

ratings.ratingID,
item.ItemName,
student.fullName,
ratings.rating,
ratings.comment,
ratings.dateCreated

FROM ratings

JOIN item

ON ratings.ItemID=item.ItemID


JOIN student

ON ratings.studentID=student.studentID


ORDER BY dateCreated DESC


";


$filename="Rating_Report.xlsx";


}



$column = 'A';

foreach($headers as $header)
{
    $sheet->setCellValue(
        $column.'1',
        $header
    );

    $column++;
}



$result=mysqli_query($conn,$sql);


$row = 2;

while($data=mysqli_fetch_row($result))
{

    $column='A';


    foreach($data as $value)
    {

        $sheet->setCellValue(
            $column.$row,
            $value
        );

        $column++;

    }


    $row++;

}

foreach(range('A','F') as $column)
{
    $sheet->getColumnDimension($column)
    ->setAutoSize(true);
}

$writer=new Xlsx($spreadsheet);


header(
'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);


header(
'Content-Disposition: attachment; filename="'.$filename.'"'
);


$writer->save("php://output");



logReport(
    $conn,
    $adminID,
    $type,
    "Excel"
);



createAuditLog(

    $conn,

    $adminID,

    "Report",

    "EXPORT",

    ucfirst($type)." Report Excel",

    "Exported ".ucfirst($type)." report as Excel file: ".$filename

);



exit();

?>