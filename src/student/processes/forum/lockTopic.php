<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Unauthorized");
}


$adminID=$_SESSION['adminID'];


$topicID=(int)$_POST['topicID'];




/*
================================
GET TOPIC INFO
================================
*/


$result=mysqli_query($conn,"

SELECT

topicTitle,

isLocked

FROM forumtopic

WHERE topicID='$topicID'

LIMIT 1

");


$row=mysqli_fetch_assoc($result);



if(!$row)
{
    exit("Topic not found");
}



$topicTitle=$row['topicTitle'];




/*
================================
TOGGLE LOCK STATUS
================================
*/


if($row['isLocked']==1)
{

    mysqli_query($conn,"

    UPDATE forumtopic

    SET isLocked=0

    WHERE topicID='$topicID'

    ");


    $action="UNLOCK_TOPIC";

    $message="Unlocked topic: ".$topicTitle;


    $response="unlocked";


}
else
{

    mysqli_query($conn,"

    UPDATE forumtopic

    SET isLocked=1

    WHERE topicID='$topicID'

    ");



    $action="LOCK_TOPIC";

    $message="Locked topic: ".$topicTitle;


    $response="locked";

}




/*
================================
AUDIT LOG
================================
*/


createAuditLog(

    $conn,

    $adminID,

    "Forum Admin",

    $action,

    $topicTitle,

    $message

);



echo $response;


?>