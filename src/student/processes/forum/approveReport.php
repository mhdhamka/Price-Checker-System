<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Unauthorized");
}


$adminID=$_SESSION['adminID'];


$reportID=(int)$_POST['reportID'];



/*
=========================
GET REPORT DATA
=========================
*/

$result=mysqli_query($conn,"

SELECT *

FROM forumreport

WHERE reportID='$reportID'

");


$report=mysqli_fetch_assoc($result);



if(!$report)
{
    exit("Report not found");
}



/*
=========================
APPROVE REPORT
=========================
*/


mysqli_query($conn,"

UPDATE forumreport

SET status='Approved'

WHERE reportID='$reportID'

");




/*
=========================
REMOVE CONTENT
=========================
*/


if($report['topicID'])
{

    mysqli_query($conn,"

    UPDATE forumtopic

    SET status='Hidden'

    WHERE topicID='".$report['topicID']."'

    ");


    $description="Deleted reported forum topic ID ".$report['topicID'];

}
elseif($report['replyID'])
{

    mysqli_query($conn,"

    UPDATE forumreply

    SET status='Hidden'

    WHERE replyID='".$report['replyID']."'

    ");


    $description="Deleted reported forum reply ID ".$report['replyID'];

}
else
{

    $description="Approved report ID ".$reportID;

}




/*
=========================
AUDIT LOG
=========================
*/


createAuditLog(

    $conn,

    $adminID,

    "Forum Admin",

    "APPROVE_REPORT",

    "Report ".$reportID,

    $description

);



echo "success";

?>