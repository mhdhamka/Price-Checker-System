<?php

session_start();

include("../../../config/db_cPCS.php");


header('Content-Type: application/json');



/*
================================
CHECK LOGIN
================================
*/

if(!isset($_SESSION['studentID']))
{

    echo json_encode([
        "status"=>"error",
        "message"=>"Not logged in"
    ]);

    exit();

}



if(!isset($_POST['replyID']))
{

    echo json_encode([
        "status"=>"error",
        "message"=>"Missing reply ID"
    ]);

    exit();

}



$studentID=(int)$_SESSION['studentID'];

$replyID=(int)$_POST['replyID'];



/*
================================
GET OWNER REPLY
================================
*/


$stmt=mysqli_prepare($conn,"
SELECT

    replyID,
    topicID,
    replyContent

FROM forumreply

WHERE replyID=?

AND studentID=?

LIMIT 1

");



mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $replyID,
    $studentID
);



mysqli_stmt_execute($stmt);



$result=mysqli_stmt_get_result($stmt);



if(mysqli_num_rows($result)==0)
{

    echo json_encode([

        "status"=>"error",
        "message"=>"Reply not found or you do not own this reply"

    ]);

    exit();

}



$reply=mysqli_fetch_assoc($result);



echo json_encode([

    "status"=>"success",
    "data"=>$reply

]);



exit();

?>