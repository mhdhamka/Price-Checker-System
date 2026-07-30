<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");


if(!isset($_SESSION['studentID']))
{
    exit("login");
}


$studentID = $_SESSION['studentID'];


$topicTitle   = trim($_POST['topicTitle'] ?? '');
$topicContent = trim($_POST['topicContent'] ?? '');
$categoryID   = (int)($_POST['categoryID'] ?? 0);
$topicTags    = trim($_POST['topicTags'] ?? '');



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
PROCESS TAGS
MAXIMUM 3 TAGS
=========================================== */


if($topicTags != "")
{

    $tags = explode(",", $topicTags);


    $tags = array_map(function($tag){

        return trim($tag);

    }, $tags);



    $tags = array_filter($tags);



    if(count($tags) > 3)
    {
        exit("Maximum 3 tags allowed.");
    }



    // remove duplicate tags
    $tags = array_unique($tags);



    // save as comma separated text
    $topicTags = implode(",", $tags);

}
else
{

    $topicTags = null;

}




/* ===========================================
LIMIT LENGTH
=========================================== */


$topicTitle = substr($topicTitle,0,150);


if(strlen($topicContent) > 10000)
{
    exit("Discussion is too long.");
}



if(strlen($topicTags) > 255)
{
    exit("Tags are too long.");
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
    topicTags,
    views,
    isPinned,
    isLocked,
    status,
    created_at
)

VALUES
(
    ?,
    ?,
    ?,
    ?,
    ?,
    0,
    0,
    0,
    'Active',
    NOW()
)

");



mysqli_stmt_bind_param(
    $stmt,
    "iisss",
    $studentID,
    $categoryID,
    $topicTitle,
    $topicContent,
    $topicTags
);



if(mysqli_stmt_execute($stmt))
{


    /*
    ==========================================
    AUDIT LOG
    ==========================================
    */


    createAuditLog(

        $conn,

        $studentID,

        "Forum",

        "CREATE_TOPIC",

        $topicTitle,

        "Created new forum topic: ".$topicTitle

    );



    mysqli_stmt_close($stmt);


    $_SESSION['forum_success'] = 
    "Your discussion has been successfully published.";


    header("Location: ../../../student/forum.php");

    exit();

}

else
{

    mysqli_stmt_close($stmt);


    $_SESSION['forum_error'] = 
    "Something went wrong. Please try again.";


    header("Location: ../../../student/forum.php");

    exit();

}


mysqli_stmt_close($stmt);


?>