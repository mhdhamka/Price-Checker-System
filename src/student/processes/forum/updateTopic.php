<?php

session_start();
include("../../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit();
}

$studentID=(int)$_SESSION['studentID'];

$topicID=(int)$_POST['topicID'];

$title=trim($_POST['topicTitle']);

$content=trim($_POST['topicContent']);

$categoryID=(int)$_POST['categoryID'];

$stmt=mysqli_prepare($conn,"
UPDATE forumtopic
SET
topicTitle=?,
topicContent=?,
categoryID=?
WHERE
topicID=?
AND studentID=?
");

mysqli_stmt_bind_param(
$stmt,
"ssiii",
$title,
$content,
$categoryID,
$topicID,
$studentID
);

if(mysqli_stmt_execute($stmt))
{
    echo "success";
}
else
{
    echo "error";
}

mysqli_stmt_close($stmt);