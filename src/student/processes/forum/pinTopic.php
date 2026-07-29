<?php

session_start();

include("../../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Unauthorized");
}

$topicID = (int)$_POST['topicID'];


// Get current pin status
$result = mysqli_query($conn,"
SELECT isPinned
FROM forumtopic
WHERE topicID='$topicID'
");

$row = mysqli_fetch_assoc($result);


// Toggle status
if($row['isPinned'] == 1)
{
    mysqli_query($conn,"
    UPDATE forumtopic
    SET isPinned=0
    WHERE topicID='$topicID'
    ");

    echo "unpinned";
}
else
{
    mysqli_query($conn,"
    UPDATE forumtopic
    SET isPinned=1
    WHERE topicID='$topicID'
    ");

    echo "pinned";
}

?>