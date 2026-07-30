<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");


if(!isset($_SESSION['studentID']))
{
    exit("login");
}


$studentID=$_SESSION['studentID'];

$topicID=(int)$_POST['topicID'];

$content=trim($_POST['replyContent']);



if($content=="")
{
    exit("empty");
}



/*
================================
CHECK IF TOPIC IS LOCKED
================================
*/

$checkLock=mysqli_query($conn,"
SELECT isLocked
FROM forumtopic
WHERE topicID='$topicID'
");


$lock=mysqli_fetch_assoc($checkLock);


if($lock && $lock['isLocked']==1)
{
    echo "locked";
    exit();
}



/*
================================
GET TOPIC TITLE FOR AUDIT
================================
*/


$topicQuery=mysqli_query($conn,"

SELECT topicTitle

FROM forumtopic

WHERE topicID='$topicID'

LIMIT 1

");


$topicData=mysqli_fetch_assoc($topicQuery);


$topicTitle=$topicData['topicTitle'] ?? "Unknown Topic";





/*
================================
INSERT REPLY
================================
*/


$stmt=mysqli_prepare($conn,"
INSERT INTO forumreply
(
    topicID,
    studentID,
    replyContent,
    created_at
)
VALUES
(
    ?,
    ?,
    ?,
    NOW()
)
");


mysqli_stmt_bind_param(
$stmt,
"iis",
$topicID,
$studentID,
$content
);



if(mysqli_stmt_execute($stmt))
{

    $replyID=mysqli_insert_id($conn);



    /*
    ================================
    AUDIT LOG
    ================================
    */


    createAuditLog(

        $conn,

        $studentID,

        "Forum",

        "CREATE_REPLY",

        $topicTitle,

        "Added reply in topic: ".$topicTitle

    );




    $reply=mysqli_fetch_assoc(mysqli_query($conn,"

    SELECT

        r.*,

        s.fullName,

        s.studentIMG

    FROM forumreply r

    JOIN student s

    ON r.studentID=s.studentID

    WHERE r.replyID='$replyID'

    "));



    echo json_encode($reply);

}


?>