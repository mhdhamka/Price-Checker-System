<?php

session_start();
include("../config/db_cPCS.php");

/* ==========================
AUTHENTICATION
========================== */

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginStudent.php");
    exit();
}

$adminID=$_SESSION['adminID'];

$studentID = null;

$isAdmin = true;
$pageType = "admin";


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


$topic['userLiked'] = false;
$topic['userBookmarked'] = false;


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/forum.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="icon" href="../../assets/images/logo.png">

</head>

<body>

<?php

    global $conn;

    $sql = "
    SELECT adminUsername, adminIMG
    FROM admin
    WHERE adminID = '$adminID'
    ";

    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        $adminUsername = $user['adminUsername'];
        $img = $user['adminIMG'];
    }
    else
    {
        $adminUsername = "Student";
        $img = "../../assets/images/profile/default.png";
    }

    ?>

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

        <?php 
        
            $topicData = $topic;

            include("../includes/forum/forumTopicHeader.php"); 
        
        ?>


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

<script src="../../assets/js/jquery-2.1.0.min.js"></script>
<script src="../../assets/js/studentTheme.js"></script>
<script src="../../assets/js/header.js"></script>
<script src="../../assets/js/forum/like.js"></script>
<script src="../../assets/js/forum/bookmark.js"></script>
<script src="../../assets/js/forum/modal.js"></script>
<script src="../../assets/js/forum/topic.js"></script>
<script src="../../assets/js/forum/reply.js"></script>
<script src="../../assets/js/forum/adminTopicActions.js"></script>

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