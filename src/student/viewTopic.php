<?php

session_start();

include("../config/db_cPCS.php");



/* ==========================
AUTHENTICATION
========================== */

if(!isset($_SESSION['studentID']))
{
    header("Location: ../public/loginStudent.php");
    exit();
}


$studentID=$_SESSION['studentID'];




/* ==========================
CHECK TOPIC ID
========================== */


if(!isset($_GET['id']))
{
    header("Location: forum.php");
    exit();
}


$topicID=(int)$_GET['id'];





/* ==========================
LOAD USER PROFILE
========================== */


$userQuery=mysqli_query($conn,"

SELECT

username,
studentIMG

FROM student

WHERE studentID='$studentID'

");


if(mysqli_num_rows($userQuery)>0)
{

    $user=mysqli_fetch_assoc($userQuery);

    $username=$user['username'];
    $img=$user['studentIMG'];

}
else
{

    $username="Student";
    $img="../../assets/images/profile/default.png";

}



/* ==========================
LOAD TOPIC
========================== */


$sql="

SELECT

t.*,

c.categoryName,

s.fullName,

s.studentIMG,


/* TOTAL LIKES */

(
SELECT COUNT(*)

FROM forumlikes l

WHERE l.topicID=t.topicID

) AS totalLikes,



/* TOTAL BOOKMARKS */

(
SELECT COUNT(*)

FROM forumbookmarks b

WHERE b.topicID=t.topicID

) AS totalBookmarks,



/* CHECK CURRENT USER LIKE STATUS */

(
SELECT COUNT(*)

FROM forumlikes ul

WHERE ul.topicID=t.topicID

AND ul.studentID='$studentID'

) AS userLiked,



/* CHECK CURRENT USER BOOKMARK STATUS */

(
SELECT COUNT(*)

FROM forumbookmarks ub

WHERE ub.topicID=t.topicID

AND ub.studentID='$studentID'

) AS userBookmarked



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







/* ==========================
LOAD REPLIES
========================== */


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

<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo htmlspecialchars($topic['topicTitle']); ?>
    </title>

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/forum.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="icon" href="../../assets/images/logo.png">

</head>


<body>


<?php include("../student/includes/header.php"); ?>

<section class="section" id="community">

    <main class="container forum-topic-page">

        <br><br>

        <!-- TOPIC HEADER -->

        <br><br><br>

        <!-- BACK BUTTON -->
        <a href="forum.php" class="back-dashboard-btn">

            <i class="fa fa-arrow-left"></i>

            Back to Forum

        </a>

        <?php include("../includes/forum/forumTopicHeader.php"); ?>


        <!-- REPLY SECTION -->
        <section class="reply-section">


            <?php include("../includes/forum/replyForm.php"); ?>


        </section>


        <!-- REPLY LIST -->
        <section class="reply-section">

            <?php include("../includes/forum/replyList.php"); ?>

        </section>


    </main>

</section>




<br><br>

<?php include("../includes/forum/replyEditModal.php"); ?>

<?php include("../includes/forum/replyDeleteModal.php"); ?>

<?php include("../student/includes/footer.php"); ?>


<script src="../../assets/js/jquery-2.1.0.min.js"></script>
<script src="../../assets/js/studentTheme.js"></script>
<script src="../../assets/js/header.js"></script>
<script src="../../assets/js/forum/like.js"></script>
<script src="../../assets/js/forum/bookmark.js"></script>
<script src="../../assets/js/forum/modal.js"></script>
<script src="../../assets/js/forum/topic.js"></script>
<script src="../../assets/js/forum/reply.js"></script>


<script>


$(function(){


    $.post(

        "processes/updateView.php",

        {

            topicID: <?php echo $topicID; ?>

        }

    );


});


</script>


</body>


</html>