<?php

session_start();

include("../../config/db_cPCS.php");


if(!isset($_SESSION['studentID']))
{
    echo "Login required";
    exit;
}


$studentID=$_SESSION['studentID'];

$itemID=$_POST['itemID'];
$rating=$_POST['rating'];
$comment=$_POST['comment'];



$sql="
INSERT INTO ratings
(ItemID, studentID, rating, comment)

VALUES
('$itemID','$studentID','$rating','$comment')

";


if(mysqli_query($conn,$sql))
{
    echo "success";
}
else
{
    echo mysqli_error($conn);
}


?>