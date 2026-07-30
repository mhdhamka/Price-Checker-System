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

$content=trim($_POST['replyContent']);



/*
================================
GET REPLY INFO
================================
*/


$getReply=mysqli_query($conn,"

SELECT

r.replyContent,

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
UPDATE
================================
*/


$stmt=mysqli_prepare($conn,"

UPDATE forumreply

SET replyContent=?

WHERE replyID=?

AND studentID=?

");



mysqli_stmt_bind_param(

$stmt,

"sii",

$content,

$replyID,

$studentID

);



if(mysqli_stmt_execute($stmt))
{


    createAuditLog(

        $conn,

        $studentID,

        "Forum",

        "UPDATE_REPLY",

        $topicTitle,

        "Updated reply in topic: ".$topicTitle

    );



    echo "success";

}
else
{

    echo "error";

}



mysqli_stmt_close($stmt);


?>