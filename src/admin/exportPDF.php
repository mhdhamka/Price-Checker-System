<?php

require '../../vendor/autoload.php';

use Dompdf\Dompdf;

include("../config/db_cPCS.php");

$type = $_GET['type'] ?? 'item';


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


/* ============================
ITEM REPORT
============================ */

if($type=="item")
{

$html .= "

<h2>Item Report</h2>

<table>

<tr>

<th>Item Name</th>
<th>Category</th>
<th>Store</th>
<th>Price</th>

</tr>

";


$query=mysqli_query($conn,"
SELECT 
ItemName,
ItemCategory,
StoreName,
ItemPrice

FROM item

ORDER BY ItemName

");


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


$query=mysqli_query($conn,"

SELECT 

student.*,

COUNT(ratings.ratingID) totalRatings


FROM student


LEFT JOIN ratings

ON student.studentID = ratings.studentID


GROUP BY student.studentID


ORDER BY fullName


");


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
<th>Item</th>
<th>Student</th>
<th>Rating</th>
<th>Comment</th>
<th>Date</th>


</tr>


";


$query=mysqli_query($conn,"

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
ORDER BY ratings.dateCreated DESC


");


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


$pdf->stream($filename,[

"Attachment"=>true

]);


?>