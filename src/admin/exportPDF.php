<?php


require '../../vendor/autoload.php';


use Dompdf\Dompdf;


include("../config/db_cPCS.php");

$type = $_GET['type'] ?? 'item';

if($type == "item")
{
    $html = "
    <h1>Price Checker System Report</h1>

    <p>Generated Date: ".date("d-m-Y")."</p>

    <table border='1' width='100%' cellpadding='10'>

        <tr>
            <th>Category</th>
            <th>Total</th>
        </tr>
    ";

    $query = mysqli_query($conn,"
        SELECT ItemCategory, COUNT(*) total
        FROM item
        GROUP BY ItemCategory
    ");

    while($row = mysqli_fetch_assoc($query))
    {
        $html .= "
        <tr>
            <td>{$row['ItemCategory']}</td>
            <td>{$row['total']}</td>
        </tr>";
    }

    $html .= "</table>";

    $filename = "Item_Report.pdf";
}

else
{
    $html = "
    <h1>Student Report</h1>

    <p>Generated Date: ".date("d-m-Y")."</p>

    <table border='1' width='100%' cellpadding='10'>

        <tr>
            <th>Student ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
    ";

    $query = mysqli_query($conn,"
        SELECT *
        FROM student
        ORDER BY fullName
    ");

    while($row = mysqli_fetch_assoc($query))
    {
        $status = $row['logStatus'] ? "Active" : "Disabled";

        $html .= "
        <tr>
            <td>{$row['studentID']}</td>
            <td>{$row['fullName']}</td>
            <td>{$row['username']}</td>
            <td>{$row['email']}</td>
            <td>{$status}</td>
        </tr>";
    }

    $html .= "</table>";

    $filename = "Student_Report.pdf";
}

$pdf = new Dompdf();

$pdf->loadHtml($html);
$pdf->setPaper('A4','portrait');
$pdf->render();

$pdf->stream($filename,[
    "Attachment"=>true
]);


?>