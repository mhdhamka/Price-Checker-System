<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    header("Location: ../public/loginStudent.php");
    exit();
}

$studentID=$_SESSION['studentID'];

if(!isset($_GET['id']))
{
    header("Location: forum.php");
    exit();
}

$topicID=(int)$_GET['id'];

mysqli_query($conn,"
UPDATE forumtopic
SET views=views+1
WHERE topicID='$topicID'
");

$sql="

SELECT

t.*,

c.categoryName,

s.fullName,

s.studentIMG,

(
SELECT COUNT(*)
FROM forumlikes l
WHERE l.topicID=t.topicID
) AS totalLikes,

(
SELECT COUNT(*)
FROM forumbookmarks b
WHERE b.topicID=t.topicID
) AS totalBookmarks

FROM forumtopic t

LEFT JOIN forumcategory c
ON t.categoryID=c.categoryID

LEFT JOIN student s
ON t.studentID=s.studentID

WHERE t.topicID='$topicID'

LIMIT 1

";

$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==0)
{
    die("Topic not found.");
}

$topic=mysqli_fetch_assoc($result);


$replyQuery=mysqli_query($conn,"

SELECT

r.*,

s.fullName,

s.studentIMG

FROM forumreply r

JOIN student s

ON r.studentID=s.studentID

WHERE r.topicID='$topicID'

ORDER BY r.created_at ASC

");

?>


<!DOCTYPE html>

<html>

<head>

    <title>

        <?php echo $topic['topicTitle']; ?>

    </title>

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../../assets/css/font-awesome.css">

    <link rel="stylesheet" href="../../assets/css/forum.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

</head>

<body>

<div class="container">

    <br>

    <a href="forum.php" class="community-btn">

        <i class="fa fa-arrow-left"></i>

        Back to Forum

    </a>

    <br><br>

        <?php include("../includes/forum/forumTopicHeader.php"); ?>

    <hr>

        <?php include("../includes/forum/replyForm.php"); ?>

    <hr>

        <?php include("../includes/forum/replyCard.php"); ?>

</div>

<script src="../../assets/js/jquery-2.1.0.min.js"></script>
<script src="../../assets/js/forum.js"></script>

<script>

$(function(){

    $.post(

        "processes/updateView.php",

        {

            topicID:<?php echo $topicID; ?>

        }

    );

});

</script>

</body>

</html>