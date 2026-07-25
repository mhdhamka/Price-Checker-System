<?php

session_start();
include("../../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit();
}

$studentID=(int)$_SESSION['studentID'];

$topicID=(int)$_POST['topicID'];

mysqli_query($conn,"
DELETE
FROM forumreply
WHERE topicID='$topicID'
");

mysqli_query($conn,"
DELETE
FROM forumlikes
WHERE topicID='$topicID'
");

mysqli_query($conn,"
DELETE
FROM forumbookmarks
WHERE topicID='$topicID'
");

mysqli_query($conn,"
DELETE
FROM forumtopic
WHERE
topicID='$topicID'
AND studentID='$studentID'
");

echo "success";