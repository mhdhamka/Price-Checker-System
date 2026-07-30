<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Unauthorized");
}


$adminID=$_SESSION['adminID'];


if(!isset($_POST['reportID']))
{
    exit("Invalid Request");
}


$reportID=(int)$_POST['reportID'];



/*==========================
GET REPORT DETAILS
==========================*/

$report=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT

topicID,
replyID

FROM forumreport

WHERE reportID='$reportID'

LIMIT 1

"));


if(!$report)
{
    exit("Report not found");
}



/*==========================
UPDATE REPORT STATUS
==========================*/

mysqli_query($conn,"

UPDATE forumreport

SET status='Rejected'

WHERE reportID='$reportID'

");



/*==========================
RESTORE TOPIC
==========================*/

if(!empty($report['topicID']))
{

    mysqli_query($conn,"

    UPDATE forumtopic

    SET status='Active'

    WHERE topicID='".$report['topicID']."'

    ");

}



/*==========================
RESTORE REPLY
==========================*/

if(!empty($report['replyID']))
{

    mysqli_query($conn,"

    UPDATE forumreply

    SET status='Active'

    WHERE replyID='".$report['replyID']."'

    ");

}



/*==========================
AUDIT LOG
==========================*/

createAuditLog(

    $conn,

    $adminID,

    "Forum Admin",

    "REJECT_REPORT",

    "Report ".$reportID,

    "Rejected forum report and restored reported content."

);



echo "success";

?>