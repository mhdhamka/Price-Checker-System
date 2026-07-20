<?php


require '../../vendor/autoload.php';


use Dompdf\Dompdf;


include("../config/db_cPCS.php");



$html="

<h1>
Price Checker System Report
</h1>


<p>
Generated Date:
".date("d-m-Y")."
</p>



<table border='1'
width='100%'
cellpadding='10'>


<tr>

<th>
Category
</th>

<th>
Total
</th>

</tr>



";



$query=mysqli_query($conn,

"SELECT ItemCategory, COUNT(*) total
FROM item
GROUP BY ItemCategory"

);



while($row=mysqli_fetch_assoc($query))
{

$html.="

<tr>

<td>
".$row['ItemCategory']."
</td>


<td>
".$row['total']."
</td>


</tr>

";

}

$html.="</table>";

$pdf=new Dompdf();

$pdf->loadHtml($html);
$pdf->setPaper('A4','portrait');
$pdf->render();

$pdf->stream(
"PriceChecker_Report.pdf",
[
"Attachment"=>true
]
);


?>