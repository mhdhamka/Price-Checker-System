<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginStudent.php");
    exit();
}


$adminID=$_SESSION['adminID'];



/*
================================
CHECK TOPIC ID
================================
*/

if(!isset($_GET['id']) || empty($_GET['id']))
{
    die("Missing topic ID");
}


$topicID=(int)$_GET['id'];



/*
================================
LOAD TOPIC
================================
*/
$sql="

SELECT

t.*,

c.categoryName,

s.fullName,

s.studentIMG,

fr.status AS reportStatus


FROM forumtopic t


LEFT JOIN forumcategory c

ON t.categoryID=c.categoryID


LEFT JOIN student s

ON t.studentID=s.studentID


LEFT JOIN forumreport fr

ON t.topicID=fr.topicID
AND fr.status='Approved'


WHERE t.topicID='$topicID'


ORDER BY fr.created_at DESC


LIMIT 1

";


$result=mysqli_query($conn,$sql);



if(mysqli_num_rows($result)==0)
{
    die("Topic not found.");
}


$topic=mysqli_fetch_assoc($result);




/*
================================
LOAD REPLIES
================================
*/

$replyQuery=mysqli_query($conn,"


SELECT

r.*,

s.fullName,

s.studentIMG


FROM forumreply r


LEFT JOIN student s

ON r.studentID=s.studentID


WHERE r.topicID='$topicID'


ORDER BY r.created_at ASC


");




/*
================================
ADMIN PROFILE
================================
*/


$user=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT

adminUsername,

adminIMG

FROM admin

WHERE adminID='$adminID'

"));



$adminUsername=$user['adminUsername'] ?? "Admin";

$img=$user['adminIMG'] ?? "../../assets/images/profile/default.png";



?>



<!DOCTYPE html>

<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Forum Topic View
    </title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800&display=swap" rel="stylesheet">
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

<section class="section community-section admin-topic-page" id="community">

    <div class="container">

        <br><br><br>

        <a href="forum.php" class="back-dashboard-btn">

            <i class="fa fa-arrow-left"></i>
            Back To Forum

        </a>

        <div class="topic-view-wrapper">

            <!-- ==============================
            TOPIC CARD
            ============================== -->

            <div class="topic-view-card">

                <div class="topic-view-top">

                    <div class="topic-profile">

                        <img src="<?php echo htmlspecialchars($topic['studentIMG']); ?>">

                        <div>

                            <h4>

                                <?php echo htmlspecialchars($topic['fullName']); ?>

                            </h4>

                            <span>

                                <i class="fa fa-calendar"></i>

                                <?php echo $topic['created_at']; ?>

                            </span>

                        </div>

                    </div>

                    <div class="topic-actions">

                    <?php if(!empty($topic['reportStatus'])){ ?>


                    <?php if(strtolower($topic['reportStatus'])=="approved"){ ?>

                        <span class="topic-chip reported-approved">

                            <i class="fa-solid fa-flag-checkered"></i>

                            Report Approved

                        </span>

                    <?php } ?>


                    <?php if(strtolower($topic['reportStatus'])=="pending"){ ?>

                        <span class="topic-chip reported-pending">

                            <i class="fa-solid fa-flag"></i>

                            Report Pending

                        </span>


                    <?php } ?>


                    <?php if(strtolower($topic['reportStatus'])=="rejected"){ ?>

                        <span class="topic-chip reported-rejected">

                            <i class="fa-solid fa-flag"></i>

                            Report Rejected

                        </span>


                    <?php } ?>


                    <?php } ?>


                    <?php if($topic['isPinned']){ ?>

                        <span class="topic-chip pinned">

                            <i class="fa fa-thumbtack"></i>

                            Pinned

                        </span>

                    <?php } ?>


                    <?php if($topic['isLocked']){ ?>

                        <span class="topic-chip locked">

                            <i class="fa fa-lock"></i>

                            Locked

                        </span>

                    <?php } ?>

                    </div>

                </div>

                <div class="topic-category">

                    <i class="fa-solid fa-layer-group"></i>

                    <?php echo htmlspecialchars($topic['categoryName']); ?>

                </div>

                <h1>

                    <?php echo htmlspecialchars($topic['topicTitle']); ?>

                </h1>

                <p class="topic-description">

                    <?php echo nl2br(htmlspecialchars($topic['topicContent'])); ?>

                </p>

                <div class="topic-footer">

                    <span>

                        <i class="fa fa-eye"></i>

                        <?php echo $topic['views']; ?>

                        Views

                    </span>

                    <span>

                        <i class="fa fa-comments"></i>

                        Discussion

                    </span>

                    <span>

                        <span>

                            <i class="fa-solid fa-circle-info"></i>

                            <?php echo ucfirst($topic['status']); ?>

                        </span>


                        <?php if(!empty($topic['reportStatus'])){ ?>

                        <span>

                            <i class="fa-solid fa-flag"></i>

                            Report:

                            <?php echo ucfirst($topic['reportStatus']); ?>

                        </span>

                        <?php } ?>

                    </span>

                </div>

            </div>

            <!-- ==============================
            REPLY SECTION
            ============================== -->


            <div class="reply-section">

                <div class="reply-title">

                    <i class="fa-solid fa-comments"></i>
                    Replies

                </div>

                <?php if(mysqli_num_rows($replyQuery)==0){ ?>

                <div class="admin-reply-card">

                    <p>
                        No replies available for this discussion.
                    </p>

                </div>

                <?php } ?>


                <?php while($reply=mysqli_fetch_assoc($replyQuery)){ ?>



                <div class="admin-reply-card">

                    <div class="reply-user">

                        <img src="<?php echo htmlspecialchars($reply['studentIMG']); ?>">

                        <div>

                            <strong>

                                <?php echo htmlspecialchars($reply['fullName']); ?>

                            </strong>


                            <small>

                                <?php echo $reply['created_at']; ?>

                            </small>

                        </div>

                    </div>

                    <p>

                        <?php echo nl2br(htmlspecialchars($reply['replyContent'])); ?>

                    </p>


                    <div>

                        <br>

                        <button class="admin-delete-reply" data-id="<?php echo $reply['replyID']; ?>">

                            <i class="fa-solid fa-trash"></i>
                            Delete Reply

                        </button>

                    </div>

                </div>


                <?php } ?>


            </div>


        </div>


    </div>


</section>



<script src="../../assets/js/custom.js"></script>
<script src="../../assets/js/studentTheme.js"></script>
<script src="../../assets/js/header.js"></script>
<script src="../../assets/js/forum/modal.js"></script>
<script src="../../assets/js/forum/adminTopicActions.js"></script>



</body>


</html>