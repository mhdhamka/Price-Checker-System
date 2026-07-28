<?php

session_start();
include("../../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit();
}

$studentID=$_SESSION['studentID'];

$replyID=(int)$_POST['replyID'];

$content=trim($_POST['replyContent']);

mysqli_query($conn,"
UPDATE forumreply
SET replyContent='".mysqli_real_escape_string($conn,$content)."'
WHERE replyID='$replyID'
AND studentID='$studentID'
");

echo "success";