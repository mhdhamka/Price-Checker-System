<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");


if(!isset($_SESSION['studentID']))
{
    exit();
}


$studentID=$_SESSION['studentID'];

$replyID=(int)$_POST['replyID'];



/*
================================
GET REPLY INFO BEFORE DELETE
================================
*/


$getReply=mysqli_query($conn,"

SELECT

t.topicTitle

FROM forumreply r

JOIN forumtopic t

ON r.topicID=t.topicID

WHERE r.replyID='$replyID'

AND r.studentID='$studentID'

LIMIT 1

");



$replyData=mysqli_fetch_assoc($getReply);


$topicTitle=$replyData['topicTitle'] ?? "Unknown Topic";





/*
================================
AUDIT LOG
================================
*/


createAuditLog(

    $conn,

    $studentID,

    "Forum",

    "DELETE_REPLY",

    $topicTitle,

    "Deleted reply from topic: ".$topicTitle

);





/*
================================
DELETE
================================
*/


mysqli_query($conn,"

DELETE

FROM forumreply

WHERE replyID='$replyID'

AND studentID='$studentID'

");



echo "success";


?>