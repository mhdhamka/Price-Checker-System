<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");


if(!isset($_SESSION['studentID']))
{
    exit();
}



$studentID=(int)$_SESSION['studentID'];


$topicID=(int)($_POST['topicID'] ?? 0);


/*
==========================================
GET TOPIC TITLE FOR AUDIT
==========================================
*/


$getTopic=mysqli_query($conn,"

SELECT topicTitle

FROM forumtopic

WHERE topicID='$topicID'

AND studentID='$studentID'

LIMIT 1

");


$topicData=mysqli_fetch_assoc($getTopic);


$oldTitle=$topicData['topicTitle'] ?? "Unknown Topic";


$title=trim($_POST['topicTitle'] ?? '');


$content=trim($_POST['topicContent'] ?? '');


$categoryID=(int)($_POST['categoryID'] ?? 0);


$topicTags=trim($_POST['topicTags'] ?? '');



/* ==========================
VALIDATION
========================== */


if($title=="")
{
    exit("Title required");
}


if($content=="")
{
    exit("Content required");
}



/* ==========================
PROCESS TAGS
MAX 3
========================== */


if($topicTags!="")
{

    $tags=explode(",",$topicTags);


    $tags=array_map(function($tag){

        return trim($tag);

    },$tags);



    $tags=array_filter($tags);



    if(count($tags)>3)
    {
        exit("Maximum 3 tags allowed");
    }



    $tags=array_unique($tags);


    $topicTags=implode(",",$tags);

}
else
{

    $topicTags=null;

}




/* ==========================
UPDATE
========================== */


$stmt=mysqli_prepare($conn,"
UPDATE forumtopic

SET

topicTitle=?,

topicContent=?,

categoryID=?,

topicTags=?,

updated_at=NOW()

WHERE

topicID=?

AND studentID=?

");



mysqli_stmt_bind_param(

$stmt,

"ssisii",

$title,

$content,

$categoryID,

$topicTags,

$topicID,

$studentID

);



if(mysqli_stmt_execute($stmt))
{


    createAuditLog(

        $conn,

        $studentID,

        "Forum",

        "UPDATE_TOPIC",

        $title,

        "Updated forum topic from '".$oldTitle."' to '".$title."'"

    );


    echo "success";

}

else
{

    echo "error";

}



mysqli_stmt_close($stmt);

?>