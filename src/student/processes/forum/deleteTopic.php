<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");

if(!isset($_SESSION['studentID']))
{
    exit();
}

$studentID=(int)$_SESSION['studentID'];

$topicID=(int)$_POST['topicID'];

/*
==========================================
GET TOPIC TITLE BEFORE DELETE
==========================================
*/


$getTopic=mysqli_query($conn,"

SELECT topicTitle

FROM forumtopic

WHERE topicID='$topicID'

AND studentID='$studentID'

LIMIT 1

");


$topicData=mysqli_fetch_assoc($getTopic);


$topicTitle=$topicData['topicTitle'] ?? "Unknown Topic";


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



createAuditLog(

    $conn,

    $studentID,

    "Forum",

    "DELETE_TOPIC",

    $topicTitle,

    "Deleted forum topic: ".$topicTitle

);



echo "success";