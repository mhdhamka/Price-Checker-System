<?php

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include("../config/db_cPCS.php");

$type = $_GET['type'] ?? 'item';

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if($type == "item")
{
    // Item headings
    $sheet->setCellValue("A1","Item Name");
    $sheet->setCellValue("B1","Category");
    $sheet->setCellValue("C1","Store");

    $result = mysqli_query($conn,"
        SELECT *
        FROM item
    ");

    $row = 2;

    while($data = mysqli_fetch_assoc($result))
    {
        $sheet->setCellValue("A".$row,$data['ItemName']);
        $sheet->setCellValue("B".$row,$data['ItemCategory']);
        $sheet->setCellValue("C".$row,$data['StoreName']);

        $row++;
    }

    $filename = "Item_Report.xlsx";
}
else if($type == "student")
{
    // Student headings
    $sheet->setCellValue("A1","Student ID");
    $sheet->setCellValue("B1","Full Name");
    $sheet->setCellValue("C1","Username");
    $sheet->setCellValue("D1","Email");
    $sheet->setCellValue("E1","Status");

    $result = mysqli_query($conn,"
        SELECT *
        FROM student
        ORDER BY fullName
    ");

    $row = 2;

    while($data = mysqli_fetch_assoc($result))
    {
        $sheet->setCellValue("A".$row,$data['studentID']);
        $sheet->setCellValue("B".$row,$data['fullName']);
        $sheet->setCellValue("C".$row,$data['username']);
        $sheet->setCellValue("D".$row,$data['email']);
        $sheet->setCellValue("E".$row,
            $data['logStatus'] ? "Active" : "Disabled"
        );

        $row++;
    }

    $filename = "Student_Report.xlsx";
}

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$filename.'"');

$writer->save("php://output");
exit();