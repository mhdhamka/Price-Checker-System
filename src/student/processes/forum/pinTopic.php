<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Unauthorized");
}


$adminID = $_SESSION['adminID'];

$topicID = (int)$_POST['topicID'];



/*
================================
GET TOPIC INFO
================================
*/

$result=mysqli_query($conn,"

SELECT

topicTitle,

isPinned

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
TOGGLE PIN STATUS
================================
*/


if($row['isPinned']==1)
{

    mysqli_query($conn,"

    UPDATE forumtopic

    SET isPinned=0

    WHERE topicID='$topicID'

    ");


    $action="UNPIN_TOPIC";

    $message="Removed pin from topic: ".$topicTitle;


    $response="unpinned";


}
else
{

    mysqli_query($conn,"

    UPDATE forumtopic

    SET isPinned=1

    WHERE topicID='$topicID'

    ");



    $action="PIN_TOPIC";

    $message="Pinned topic: ".$topicTitle;


    $response="pinned";

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