<?php

session_start();
include("../../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit("login");
}

$studentID = $_SESSION['studentID'];

$topicTitle   = trim($_POST['topicTitle'] ?? '');
$topicContent = trim($_POST['topicContent'] ?? '');
$categoryID   = (int)($_POST['categoryID'] ?? 0);


/* ===========================================
VALIDATION
=========================================== */

if($topicTitle == "")
{
    exit("Title is required.");
}

if($topicContent == "")
{
    exit("Discussion cannot be empty.");
}

if($categoryID <= 0)
{
    exit("Please select a category.");
}


/* ===========================================
LIMIT LENGTH
=========================================== */

$topicTitle = substr($topicTitle,0,120);

if(strlen($topicContent) > 10000)
{
    exit("Discussion is too long.");
}


/* ===========================================
INSERT
=========================================== */

$stmt = mysqli_prepare($conn,"
INSERT INTO forumtopic
(
    studentID,
    categoryID,
    topicTitle,
    topicContent,
    views,
    isPinned,
    status,
    created_at
)
VALUES
(
?,
?,
?,
?,
0,
0,
'Active',
NOW()
)
");

mysqli_stmt_bind_param(
$stmt,
"iiss",
$studentID,
$categoryID,
$topicTitle,
$topicContent
);

if(mysqli_stmt_execute($stmt))
{
    mysqli_stmt_close($stmt);

    $_SESSION['forum_success'] = "Your discussion has been successfully published.";
    header("Location: ../../../student/forum.php");
    exit();
}
else
{
    mysqli_stmt_close($stmt);

    $_SESSION['forum_error'] = "Something went wrong. Please try again.";
    header("Location: ../../../student/forum.php");
    exit();
}

mysqli_stmt_close($stmt);

?>