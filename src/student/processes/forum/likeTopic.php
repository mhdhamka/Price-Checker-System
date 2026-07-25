<?php

session_start();
include("../../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit();
}

$studentID=(int)$_SESSION['studentID'];
$topicID=(int)$_POST['topicID'];

$check=mysqli_query($conn,"
SELECT *
FROM forumlikes
WHERE topicID='$topicID'
AND studentID='$studentID'
");

if(mysqli_num_rows($check)>0)
{

    mysqli_query($conn,"
    DELETE FROM forumlikes
    WHERE topicID='$topicID'
    AND studentID='$studentID'
    ");

    echo "removed";

}
else
{

    mysqli_query($conn,"
    INSERT INTO forumlikes(topicID,studentID)
    VALUES('$topicID','$studentID')
    ");

    echo "added";

}