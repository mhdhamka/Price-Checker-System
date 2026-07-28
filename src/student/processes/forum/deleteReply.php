<?php

session_start();
include("../../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit();
}

$studentID=$_SESSION['studentID'];

$replyID=(int)$_POST['replyID'];

mysqli_query($conn,"
DELETE
FROM forumreply
WHERE replyID='$replyID'
AND studentID='$studentID'
");

echo "success";