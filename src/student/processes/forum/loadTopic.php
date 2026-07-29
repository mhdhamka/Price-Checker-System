

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



if(!isset($_POST['topicID']))
{

    echo json_encode([
        "status"=>"error",
        "message"=>"Missing topic ID"
    ]);

    exit();

}



$studentID=(int)$_SESSION['studentID'];

$topicID=(int)$_POST['topicID'];


/*
================================
GET OWNER TOPIC
================================
*/


$stmt=mysqli_prepare($conn,"

SELECT

    topicID,

    topicTitle,

    topicContent,

    categoryID,

    topicTags


FROM forumtopic


WHERE topicID=?

AND studentID=?

LIMIT 1


");



mysqli_stmt_bind_param(

    $stmt,

    "ii",

    $topicID,

    $studentID

);




mysqli_stmt_execute($stmt);



$result=mysqli_stmt_get_result($stmt);




if(mysqli_num_rows($result)==0)
{

    echo json_encode([

        "status"=>"error",

        "message"=>"Topic not found or you do not own this topic"

    ]);

    exit();

}




$topic=mysqli_fetch_assoc($result);




echo json_encode([

    "status"=>"success",

    "data"=>$topic

]);


exit();

?>