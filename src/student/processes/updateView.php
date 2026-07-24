<?php

session_start();

include("../../config/db_cPCS.php");

$studentID=$_SESSION['studentID'];

$topicID=$_POST['topicID'];

$check=mysqli_query($conn,"
SELECT *
FROM forumviews
WHERE topicID='$topicID'
AND studentID='$studentID'
");

if(mysqli_num_rows($check)==0)
{

    mysqli_query($conn,"
    INSERT INTO forumviews
    (topicID,studentID)
    VALUES
    ('$topicID','$studentID')
    ");

    mysqli_query($conn,"
    UPDATE forumtopic
    SET views=views+1
    WHERE topicID='$topicID'
    ");

}

echo "success";

?>