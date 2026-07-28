<?php

session_start();
include("../../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit();
}

$replyID=(int)$_POST['replyID'];

$result=mysqli_query($conn,"
SELECT *
FROM forumreply
WHERE replyID='$replyID'
LIMIT 1
");

echo json_encode(mysqli_fetch_assoc($result));