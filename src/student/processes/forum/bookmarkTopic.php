<?php

session_start();
include("../../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit();
}

$studentID=$_SESSION['studentID'];
$topicID=(int)$_POST['topicID'];

$check=mysqli_query($conn,"
SELECT *
FROM forumbookmarks
WHERE topicID='$topicID'
AND studentID='$studentID'
");

if(mysqli_num_rows($check)>0)
{

    mysqli_query($conn,"
    DELETE FROM forumbookmarks
    WHERE topicID='$topicID'
    AND studentID='$studentID'
    ");

}
else
{

    mysqli_query($conn,"
    INSERT INTO forumbookmarks(topicID,studentID)
    VALUES('$topicID','$studentID')
    ");

}

$count=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumbookmarks
WHERE topicID='$topicID'
"));

echo $count['total'];