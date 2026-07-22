<?php

session_start();

include("../config/db_cPCS.php");


$studentID=$_SESSION['studentID'];

$itemID=$_POST['itemID'];

$rating=$_POST['rating'];

$comment=$_POST['comment'];



$sql="
UPDATE ratings

SET

rating='$rating',
comment='$comment'

WHERE ItemID='$itemID'
AND studentID='$studentID'

";


if(mysqli_query($conn,$sql))
{
    echo "success";
}

?>