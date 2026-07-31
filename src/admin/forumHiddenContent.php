<?php

session_start();

include("../config/db_cPCS.php");


/* ==========================
   ADMIN AUTH
========================== */

if (!isset($_SESSION['adminID'])) {
    header("Location: ../public/loginStudent.php");
    exit();
}


$adminID = $_SESSION['adminID'];

$isAdmin = true;
$pageType = "admin";

/* ==========================
   COUNT HIDDEN CONTENT
========================== */


$hiddenTopicCount = mysqli_fetch_assoc(mysqli_query($conn,"
    
    SELECT COUNT(*) AS total

    FROM forumtopic

    WHERE status='Hidden'

"))['total'];



$hiddenReplyCount = mysqli_fetch_assoc(mysqli_query($conn,"
    
    SELECT COUNT(*) AS total

    FROM forumreply

    WHERE status='Hidden'

"))['total'];




/* ==========================
   TOPIC PAGINATION
========================== */


$topicLimit = 6;


$topicPage = isset($_GET['topicPage'])
? (int)$_GET['topicPage']
: 1;


if($topicPage < 1)
{
    $topicPage = 1;
}



$topicTotalPages = max(
    1,
    ceil($hiddenTopicCount / $topicLimit)
);



if($topicPage > $topicTotalPages)
{
    $topicPage=$topicTotalPages;
}



$topicOffset = ($topicPage-1) * $topicLimit;




/* ==========================
   HIDDEN TOPICS
========================== */


$hiddenTopics = mysqli_query($conn,"

    SELECT

        t.topicID,
        t.topicTitle,
        t.topicContent,
        t.created_at,

        s.fullName,

        fr.reason

    FROM forumtopic t


    LEFT JOIN student s

    ON t.studentID=s.studentID


    LEFT JOIN forumreport fr

    ON t.topicID=fr.topicID


    WHERE t.status='Hidden'


    ORDER BY t.created_at DESC


    LIMIT $topicLimit OFFSET $topicOffset


");





/* ==========================
   REPLY PAGINATION
========================== */


$replyLimit = 6;


$replyPage = isset($_GET['replyPage'])
? (int)$_GET['replyPage']
: 1;



if($replyPage < 1)
{
    $replyPage=1;
}



$replyTotalPages=max(
    1,
    ceil($hiddenReplyCount/$replyLimit)
);



if($replyPage>$replyTotalPages)
{
    $replyPage=$replyTotalPages;
}



$replyOffset=($replyPage-1)*$replyLimit;




/* ==========================
   HIDDEN REPLIES
========================== */


$hiddenReplies=mysqli_query($conn,"

    SELECT

        r.replyID,
        r.replyContent,
        r.created_at,
        r.topicID,

        s.fullName,

        fr.reason


    FROM forumreply r



    LEFT JOIN student s

    ON r.studentID=s.studentID

    LEFT JOIN forumreport fr

    ON r.replyID=fr.replyID

    WHERE r.status='Hidden'

    ORDER BY r.created_at DESC


    LIMIT $replyLimit OFFSET $replyOffset


");



/* ==========================
   ADMIN PROFILE
========================== */

$user = mysqli_fetch_assoc(mysqli_query($conn, "

    SELECT
        adminUsername,
        adminIMG

    FROM admin

    WHERE adminID='$adminID'

"));


$adminUsername = $user['adminUsername'] ?? "Admin";
$img = $user['adminIMG'] ?? "../../assets/images/profile/default.png";

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Hidden Content Management</title>

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/forum.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

</head>


<body>

<?php include("../student/includes/header.php"); ?>


<section class="section community-section">

    <div class="container">

        <a href="forumModeration.php" class="back-dashboard-btn">
            <i class="fa fa-arrow-left"></i>
            Back to Moderation
        </a>

        <div class="forum-page-header">

            <div class="page-header-icon report-header-icon">
                <i class="fa-solid fa-eye-slash"></i>
            </div>


            <div>

                <h2>
                    Hidden Content Management
                </h2>

                <p>
                    Review content hidden after approved reports.
                </p>

            </div>

        </div>

        <!-- ======================
        STATS
        ====================== -->
        <div class="moderation-stats">

            <div class="moderation-stat-card">

                <div class="moderation-stat-icon">

                    <i class="fa-solid fa-comments"></i>

                </div>

                <div class="moderation-stat-content">

                    <h3>
                        <?php echo $hiddenTopicCount; ?>
                    </h3>

                    <p>
                        Hidden Topics
                    </p>

                </div>


            </div>

            <div class="moderation-stat-card">

                <div class="moderation-stat-icon">

                    <i class="fa-solid fa-reply"></i>

                </div>

                <div class="moderation-stat-content">

                    <h3>

                        <?php echo $hiddenReplyCount; ?>

                    </h3>

                    <p>
                        Hidden Replies
                    </p>

                </div>


            </div>



        </div>


        <!-- ======================
        HIDDEN TOPICS
        ====================== -->

        <div class="moderation-section-title">

            <i class="fa-solid fa-lock"></i>

            Hidden Topics

        </div>

        <div class="hidden-grid">

            <?php while ($topic = mysqli_fetch_assoc($hiddenTopics)) { ?>

            <div class="hidden-card">

                <div class="hidden-card-header">

                    <i class="fa-solid fa-eye-slash"></i>

                    <h4>
                        <?= htmlspecialchars($topic['topicTitle']); ?>
                    </h4>

                </div>


                <p>
                    <?= htmlspecialchars(substr($topic['topicContent'],0,150)); ?>...
                </p>


                <div class="hidden-meta">

                    <span>
                        <i class="fa fa-user"></i>
                        <?= htmlspecialchars($topic['fullName']); ?>
                    </span>


                    <span>
                        <i class="fa fa-flag"></i>
                        Reason:
                        <?= htmlspecialchars($topic['reason'] ?? "Unknown"); ?>
                    </span>

                </div>


                <a href="forumTopicView.php?id=<?= $topic['topicID']; ?>"
                class="moderation-action-btn">

                    <i class="fa fa-eye"></i>
                    View Topic

                </a>

            </div>

            <?php } ?>

        </div>

        <?php if($topicTotalPages>1){ ?>

            <div class="pagination">

                <?php if($topicPage>1){ ?>

                <a href="?topicPage=<?php echo $topicPage-1; ?>&replyPage=<?php echo $replyPage; ?>">

                <i class="fa fa-angle-left"></i>

                </a>

                <?php } ?>

                <?php

                $start=max(1,$topicPage-2);

                $end=min($topicTotalPages,$topicPage+2);


                for($i=$start;$i<=$end;$i++)

                {

                ?>


                <a href="?topicPage=<?php echo $i; ?>&replyPage=<?php echo $replyPage; ?>"

                class="<?php echo ($topicPage==$i)?'active':''; ?>">


                    <?php echo $i; ?>

                </a>


                <?php } ?>

                <?php if($topicPage<$topicTotalPages){ ?>


                <a href="?topicPage=<?php echo $topicPage+1; ?>&replyPage=<?php echo $replyPage; ?>">

                    <i class="fa fa-angle-right"></i>

                </a>


                <?php } ?>


            </div>


            <div class="pagination-info">

                Showing

                <strong>

                    <?php echo $topicOffset+1; ?>

                </strong>


                to


                <strong>

                    <?php echo min($topicOffset+$topicLimit,$hiddenTopicCount); ?>

                </strong>


                of


                <strong>

                    <?php echo $hiddenTopicCount; ?>

                </strong>


                topics


            </div>


        <?php } ?>


        <!-- ======================
        HIDDEN REPLIES
        ====================== -->

        <div class="moderation-section-title">

            <i class="fa-solid fa-reply"></i>

            Hidden Replies

        </div>


        <div class="hidden-grid">

            <?php while($reply=mysqli_fetch_assoc($hiddenReplies)){ ?>

                <div class="hidden-card">

                    <div class="hidden-card-header">

                        <i class="fa-solid fa-comment-slash"></i>

                        <h4>
                            Reply #<?php echo $reply['replyID']; ?>
                        </h4>


                    </div>

                    <p>

                        <?php echo htmlspecialchars(

                        substr($reply['replyContent'],0,150)

                        ); ?>


                        ...

                    </p>

                    <div class="hidden-meta">

                        <span>
                            <i class="fa fa-user"></i>

                            <?php echo htmlspecialchars($reply['fullName']); ?>

                        </span>

                        <span>

                            <i class="fa fa-flag"></i>

                            Reason:

                            <?php echo htmlspecialchars($reply['reason'] ?? "Unknown"); ?>

                        </span>


                    </div>

                    <a href="forumTopicView.php?id=<?php echo $reply['topicID']; ?>"

                    class="moderation-action-btn">

                        <i class="fa fa-eye"></i>

                        View Discussion

                    </a>

                </div>

                <?php } ?>


        </div>


        <?php if($replyTotalPages>1){ ?>

            <div class="pagination">


                <?php if($replyPage>1){ ?>


                <a href="?replyPage=<?php echo $replyPage-1; ?>&topicPage=<?php echo $topicPage; ?>">

                    <i class="fa fa-angle-left"></i>

                </a>


                <?php } ?>



                <?php

                $start=max(1,$replyPage-2);

                $end=min($replyTotalPages,$replyPage+2);


                for($i=$start;$i<=$end;$i++)

                {

                ?>


                <a href="?replyPage=<?php echo $i; ?>&topicPage=<?php echo $topicPage; ?>"

                class="<?php echo ($replyPage==$i)?'active':''; ?>">


                    <?php echo $i; ?>


                </a>


                <?php } ?>

                <?php if($replyPage<$replyTotalPages){ ?>

                <a href="?replyPage=<?php echo $replyPage+1; ?>&topicPage=<?php echo $topicPage; ?>">

                    <i class="fa fa-angle-right"></i>

                </a>

                <?php } ?>


            </div>


            <div class="pagination-info">

                Showing

                <strong>

                    <?php echo $replyOffset+1; ?>

                </strong>

                to

                <strong>

                    <?php echo min($replyOffset+$replyLimit,$hiddenReplyCount); ?>

                </strong>

                of

                <strong>

                    <?php echo $hiddenReplyCount; ?>

                </strong>

                replies

            </div>


        <?php } ?>



    </div>


</section>



<?php include("../student/includes/footer.php"); ?>



<script src="../../assets/js/custom.js"></script>

<script src="../../assets/js/studentTheme.js"></script>

<script src="../../assets/js/header.js"></script>



</body>


</html>