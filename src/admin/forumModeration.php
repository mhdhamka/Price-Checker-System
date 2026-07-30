<?php

session_start();

include("../config/db_cPCS.php");


/* ==========================
ADMIN AUTH
========================== */

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginStudent.php");
    exit();
}


$adminID=$_SESSION['adminID'];

$isAdmin=true;
$pageType="admin";



/* ==========================
STATISTICS
========================== */


/* Pending Reports */

$pendingReports=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreport

WHERE status='Pending'

"))['total'];



/* Approved Today */

$approvedToday=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreport

WHERE status='Approved'

AND DATE(created_at)=CURDATE()

"))['total'];



/* Hidden Topics */

$hiddenTopics=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumtopic

WHERE status='Hidden'

"))['total'];



/* Hidden Replies */

$hiddenReplies=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreply

WHERE status='Hidden'

"))['total'];



/* Total Reports */

$totalReports=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreport

"))['total'];



/* Active Topics */

$activeTopics=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumtopic

WHERE status='Active'

"))['total'];




/* ==========================
RECENT REPORTS
========================== */


$recentReports=mysqli_query($conn,"

SELECT

fr.*,

s.fullName,

t.topicTitle


FROM forumreport fr


LEFT JOIN student s

ON fr.studentID=s.studentID


LEFT JOIN forumtopic t

ON fr.topicID=t.topicID


ORDER BY fr.created_at DESC


LIMIT 5

");



/* ==========================
RECENT ACTIONS
========================== */


$recentActions=mysqli_query($conn,"

SELECT *

FROM audit_logs

WHERE module IN ('Forum','Forum Admin')

ORDER BY created_at DESC

LIMIT 5

");



/* ==========================
ADMIN PROFILE
========================== */


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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Price Checker System Forum</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/forum.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

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


    <section class="section community-section" id="community">

        <div class="container">

            <br><br>

            <a href="forum.php" class="back-dashboard-btn">

                <i class="fa fa-arrow-left"></i>
                Back To Forum

            </a>

            <div class="forum-page-header">

                <div class="page-header-icon moderation-header-icon">

                    <i class="fa-solid fa-shield-halved"></i>

                </div>

                <div>

                    <h2>
                        Forum Moderation Dashboard
                    </h2>


                    <p>
                        Monitor reports, hidden content and moderation activities.
                    </p>

                </div>

            </div>

            <!-- STAT CARDS -->
            <div class="moderation-stats">

                <div class="moderation-card">

                    <div class="moderation-icon pending-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>

                    <div>

                        <h3>
                            <?php echo $pendingReports; ?>
                        </h3>

                        <p>
                            Pending Reports
                        </p>

                    </div>

                </div>

                <div class="moderation-card">

                    <div class="moderation-icon approved-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <div>

                        <h3>
                            <?php echo $approvedToday; ?>
                        </h3>

                        <p>
                            Approved Today
                        </p>

                    </div>

                </div>


                <div class="moderation-card">

                    <div class="moderation-icon hidden-topic-icon">
                        <i class="fa-solid fa-eye-slash"></i>
                    </div>

                    <div>

                        <h3>
                        <?php echo $hiddenTopics; ?>
                        </h3>

                        <p>
                        Hidden Topics
                        </p>

                    </div>

                </div>


                <div class="moderation-card">

                    <div class="moderation-icon hidden-reply-icon">
                        <i class="fa-solid fa-comment-slash"></i>
                    </div>

                    <div>

                        <h3>
                            <?php echo $hiddenReplies; ?>
                        </h3>

                        <p>
                            Hidden Replies
                        </p>

                    </div>

                </div>

                <div class="moderation-card">

                    <div class="moderation-icon report-total-icon">
                        <i class="fa-solid fa-flag"></i>
                    </div>

                    <div>

                        <h3>
                            <?php echo $totalReports; ?>
                        </h3>

                        <p>
                            Total Reports
                        </p>

                    </div>

                </div>

                <div class="moderation-card">

                    <div class="moderation-icon active-topic-icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>

                    <div>
                        <h3>
                            <?php echo $activeTopics; ?>
                        </h3>

                        <p>
                            Active Topics
                        </p>

                    </div>

                </div>

            </div>


            <!-- ==========================
            MODERATION TOOLS
            ========================== -->
            <div class="moderation-section-title">

                <i class="fa-solid fa-toolbox"></i>

                Moderation Tools

            </div>

            <div class="moderation-grid">

                <!-- REPORT MANAGEMENT -->
                <div class="moderation-card">

                    <div class="moderation-card-header">

                        <i class="fa-solid fa-flag"></i>

                        <h3>
                            Report Management
                        </h3>

                    </div>

                    <p>
                        Review reported topics and replies.
                        Approve valid reports or reject false reports.
                    </p>

                    <a href="forumReports.php"
                    class="moderation-action-btn">

                        <i class="fa-solid fa-arrow-right"></i>
                        Manage Reports

                    </a>


                </div>


                <!-- HIDDEN CONTENT -->

                <div class="moderation-card">

                    <div class="moderation-card-header">

                        <i class="fa-solid fa-eye-slash"></i>

                        <h3>
                            Hidden Content
                        </h3>


                    </div>

                        <p>

                        View topics and replies hidden after moderation actions.

                        </p>

                        <a href="forumHiddenContent.php"
                        class="moderation-action-btn">


                        <i class="fa-solid fa-arrow-right"></i>

                            Manage Hidden

                        </a>

                    </div>

                <!-- AUDIT LOG -->
                <div class="moderation-card">

                    <div class="moderation-card-header">

                        <i class="fa-solid fa-clock-rotate-left"></i>

                        <h3>
                            Audit Logs
                        </h3>

                    </div>

                    <p>
                        Track moderator actions and forum changes.
                    </p>

                    <a href="forumAuditLogs.php"
                    class="moderation-action-btn">

                        <i class="fa-solid fa-arrow-right"></i>
                        View Logs

                    </a>


                </div>

                <!-- ANALYTICS -->
                <div class="moderation-card">

                    <div class="moderation-card-header">

                        <i class="fa-solid fa-chart-line"></i>

                        <h3>
                            Report Analytics
                        </h3>

                    </div>

                    <p>
                        Analyze report trends and moderation performance.
                    </p>

                    <a href="forumAnalytics.php"
                    class="moderation-action-btn">

                    <i class="fa-solid fa-arrow-right"></i>
                        View Analytics
                    </a>

                </div>


            <!-- USER HISTORY -->

            <div class="moderation-card">


            <div class="moderation-card-header">

            <i class="fa-solid fa-user-shield"></i>


            <h3>
            User Moderation
            </h3>


            </div>



            <p>

            Review student moderation history and previous violations.

            </p>



            <a href="forumUserModeration.php"
            class="moderation-action-btn">


            <i class="fa-solid fa-arrow-right"></i>

            View Users


            </a>


            </div>



            </div>


            <div class="moderation-grid">

                <div class="moderation-panels-wrapper">

                    <!-- RECENT REPORTS -->
                    <div class="moderation-panel">

                        <h3>

                            <i class="fa-solid fa-flag"></i>
                            Recent Reports

                        </h3>

                        <?php while($report=mysqli_fetch_assoc($recentReports)){ ?>


                        <div class="moderation-item">

                            <strong>

                                <?php echo htmlspecialchars(
                                $report['topicTitle'] ?? "Reply Report"
                                ); ?>

                            </strong>

                            <span>

                                <?php echo $report['status']; ?>

                            </span>

                            <small>

                                Reported by:

                                <?php echo $report['fullName']; ?>

                            </small>

                        </div>

                        <?php } ?>


                    </div>


                    <!-- RECENT ACTIONS -->
                    <div class="moderation-panel">

                        <h3>

                            <i class="fa-solid fa-clock-rotate-left"></i>

                            Recent Moderator Actions

                        </h3>

                        <?php while($log=mysqli_fetch_assoc($recentActions)){ ?>


                        <div class="moderation-item">

                            <strong>

                                <?php echo htmlspecialchars($log['action']); ?>

                            </strong>

                            <p>

                                <?php echo htmlspecialchars($log['description']); ?>

                            </p>

                            <small>

                                <?php echo $log['created_at']; ?>

                            </small>

                        </div>

                        <?php } ?>

                    </div>
                </div>

            </div>

        </div>

    </section>

    
    <br><br>

    <?php include("../student/includes/footer.php"); ?>

    <!-- jQuery -->
    <script src="../../assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="../../assets/js/popper.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="../../assets/js/scrollreveal.min.js"></script>
    <script src="../../assets/js/waypoints.min.js"></script>
    <script src="../../assets/js/jquery.counterup.min.js"></script>
    <script src="../../assets/js/imgfix.min.js"></script> 
    <script src="../../assets/js/mixitup.js"></script> 
    <script src="../../assets/js/accordions.js"></script>
    <script src="../../assets/js/slideshow.js"></script>
    <!-- Global Init -->
    <script src="../../assets/js/custom.js"></script>
    <script src="../../assets/js/studentTheme.js"></script>
    <script src="../../assets/js/header.js"></script>
    <script src="../../assets/js/forum/like.js"></script>
    <script src="../../assets/js/forum/bookmark.js"></script>
    <script src="../../assets/js/forum/modal.js"></script>
    <script src="../../assets/js/forum/topic.js"></script>
    <script src="../../assets/js/forum/searchTopic.js"></script>
    <script src="../../assets/js/forum/topicSuggestion.js"></script>
    <script src="../../assets/js/forum/adminTopicActions.js"></script>

    <script>
        function slideCategory(direction){

            const container = document.querySelector(".category-container");
            container.scrollLeft += direction * 350;

        }
    </script>

  </body>
</html>