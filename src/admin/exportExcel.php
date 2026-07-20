<?php


require '../../vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



include("../config/db_cPCS.php");



$spreadsheet=new Spreadsheet();
$sheet=$spreadsheet->getActiveSheet();

$sheet->setCellValue(
"A1",
"Item Name"
);

$sheet->setCellValue(
"B1",
"Category"
);

$sheet->setCellValue(
"C1",
"Store"
);

$result=mysqli_query($conn,

"SELECT *
FROM item"

);

$row=2;

while($data=mysqli_fetch_assoc($result))
{

$sheet->setCellValue(
"A".$row,
$data['ItemName']
);

$sheet->setCellValue(
"B".$row,
$data['ItemCategory']
);

$sheet->setCellValue(
"C".$row,
$data['StoreName']
);

$row++;

}

$writer=new Xlsx($spreadsheet);

header(
'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);

header(
'Content-Disposition: attachment;filename="PriceChecker_Report.xlsx"'
);

$writer->save("php://output");

?>