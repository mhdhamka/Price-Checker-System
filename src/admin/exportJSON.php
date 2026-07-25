<?php

session_start();

include("../config/db_cPCS.php");

include("../admin/processes/reportLogger.php");

$adminID=$_SESSION['adminID'] ?? 1;

$type=$_GET['type'] ?? "item";

switch($type)
{

case "student":

$sql="

SELECT

student.*,

COUNT(ratings.ratingID) totalRatings

FROM student

LEFT JOIN ratings

ON student.studentID=ratings.studentID

GROUP BY student.studentID

";

$filename="Student_Report.json";

break;

case "rating":

$sql="

SELECT

ratings.*,

item.ItemName,

student.fullName

FROM ratings

JOIN item

ON ratings.ItemID=item.ItemID

JOIN student

ON ratings.studentID=student.studentID

";

$filename="Rating_Report.json";

break;

default:

$sql="SELECT * FROM item";

$filename="Item_Report.json";

}

$result=mysqli_query($conn,$sql);

$data=[];

while($row=mysqli_fetch_assoc($result))
{
    $data[]=$row;
}

header("Content-Type:application/json");

header("Content-Disposition: attachment; filename=".$filename);

logReport(
    $conn,
    $adminID,
    $type,
    "JSON"
);

echo json_encode(

$data,

JSON_PRETTY_PRINT

);

exit();

?>