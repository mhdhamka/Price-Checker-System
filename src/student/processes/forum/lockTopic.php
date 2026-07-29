<?php

session_start();

include("../../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Unauthorized");
}

$topicID = (int)$_POST['topicID'];


// Get current lock status
$result = mysqli_query($conn,"
SELECT isLocked
FROM forumtopic
WHERE topicID='$topicID'
");

$row = mysqli_fetch_assoc($result);


// Toggle status
if($row['isLocked'] == 1)
{
    mysqli_query($conn,"
    UPDATE forumtopic
    SET isLocked=0
    WHERE topicID='$topicID'
    ");

    echo "unlocked";
}
else
{
    mysqli_query($conn,"
    UPDATE forumtopic
    SET isLocked=1
    WHERE topicID='$topicID'
    ");

    echo "locked";
}

?>