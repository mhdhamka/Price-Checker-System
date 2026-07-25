<?php

session_start();
include("../../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit();
}

$studentID=(int)$_SESSION['studentID'];
$topicID=(int)$_POST['topicID'];

$sql="

SELECT

topicID,
topicTitle,
topicContent,
categoryID

FROM forumtopic

WHERE

topicID='$topicID'

AND studentID='$studentID'

LIMIT 1

";

$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==0)
{
    exit();
}

echo json_encode(mysqli_fetch_assoc($result));