<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: loginAdmin.php");
    exit();
}


$adminID=$_SESSION['adminID'];

if(!isset($_GET['id']))
{
    exit("Student not found");
}


$studentID=$_GET['id'];



/* ==========================
STUDENT INFO
========================== */


$student=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT

studentID,
fullName,
username,
studentIMG

FROM student

WHERE studentID='$studentID'

"));



if(!$student)
{
    exit("Student does not exist");
}



/* ==========================
REPORT HISTORY
========================== */


$reports=mysqli_query($conn,"

SELECT


fr.*,

t.topicTitle,


r.replyContent



FROM forumreport fr



LEFT JOIN forumtopic t

ON fr.topicID=t.topicID



LEFT JOIN forumreply r

ON fr.replyID=r.replyID



WHERE fr.studentID='$studentID'


ORDER BY fr.created_at DESC


");





/* ==========================
SUMMARY
========================== */


$total=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreport

WHERE studentID='$studentID'

"))['total'];



$approved=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreport

WHERE studentID='$studentID'

AND status='Approved'

"))['total'];



$rejected=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreport

WHERE studentID='$studentID'

AND status='Rejected'

"))['total'];



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

<html>


<head>

    <title>
        Forum History
    </title>

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


<?php include("../student/includes/header.php"); ?>

    <section class="section community-section" id="community">

        <div class="container">

            <br><br>

            <a href="forumUserModeration.php"
            class="back-dashboard-btn">

                <i class="fa fa-arrow-left"></i>

                Back

            </a>

            <div class="forum-page-header">

                <div class="page-header-icon moderation-header-icon">

                    <i class="fa-solid fa-clock-rotate-left"></i>

                </div>


                <div>

                    <h2>
                        Moderation History
                    </h2>

                    <p>
                        Review student's forum violations and reports.
                    </p>

                </div>

            </div>


            <div class="history-profile-card">

                <div class="history-profile-left">

                    <img src="<?php echo !empty($student['studentIMG'])
                    ? $student['studentIMG']
                    : '../../assets/images/profile/default.png'; ?>">

                    <div>

                        <h2><?php echo htmlspecialchars($student['fullName']); ?></h2>

                        <p>@<?php echo htmlspecialchars($student['username']); ?></p>

                        <span class="history-user-id">
                            Student ID #<?php echo $student['studentID']; ?>
                        </span>

                    </div>

                </div>

                <div class="history-profile-right">

                    <div class="history-stat">
                        <span><?php echo $total; ?></span>
                        <small>Reports</small>
                    </div>

                    <div class="history-stat">
                        <span><?php echo $approved; ?></span>
                        <small>Approved</small>
                    </div>

                    <div class="history-stat">
                        <span><?php echo $rejected; ?></span>
                        <small>Rejected</small>
                    </div>

                </div>

            </div>


            <div class="history-timeline-panel">

                <div class="timeline-header">

                    <h3>

                        <i class="fa-solid fa-clock-rotate-left"></i>

                        Moderation Timeline

                    </h3>

                </div>

                <?php

                    if(mysqli_num_rows($reports)==0){

                ?>

                <div class="timeline-empty">

                    <i class="fa-regular fa-face-smile"></i>

                    <h4>

                        No moderation history found.

                    </h4>

                    <p>

                        This student has not been reported.

                    </p>

                </div>

                <?php

                }

                    while($row=mysqli_fetch_assoc($reports)){

                ?>

                <div class="timeline-card">

                    <div class="timeline-top">

                        <div>

                            <h4>

                                <?php
                                    if(!empty($row['topicTitle']))
                                    {
                                        echo htmlspecialchars($row['topicTitle']);
                                    }
                                    else if(!empty($row['replyContent']))
                                    {
                                        echo "Reply: " . htmlspecialchars(substr($row['replyContent'],0,80));

                                        if(strlen($row['replyContent']) > 80)
                                        {
                                            echo "...";
                                        }
                                    }
                                    else
                                    {
                                        echo "Unknown Content";
                                    }
                                ?>

                            </h4>

                            <span class="timeline-date">

                                <i class="fa-regular fa-calendar"></i>

                                <?php echo date("d M Y H:i",strtotime($row['created_at'])); ?>

                            </span>

                        </div>

                        <span class="timeline-status
                        <?php echo strtolower($row['status']); ?>">

                            <?php echo $row['status']; ?>

                        </span>

                    </div>

                    <div class="timeline-body">

                        <p>

                            <strong>Reason</strong>

                        </p>

                        <p>

                            <?php echo htmlspecialchars($row['reason']); ?>

                        </p>

                    </div>

                </div>

                <?php } ?>

            </div>


        </div>


    </section>



    <?php include("../student/includes/footer.php"); ?>


    <script src="../../assets/js/studentTheme.js"></script>
    <script src="../../assets/js/header.js"></script>


</body>

</html>