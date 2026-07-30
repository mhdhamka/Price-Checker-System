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
   ANALYTICS DATA
========================== */


/* TOTAL REPORTS */

$totalReports = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumreport
"))['total'];



/* APPROVED REPORTS */

$approvedReports=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumreport
WHERE status='Approved'
"))['total'];



/* REJECTED REPORTS */

$rejectedReports=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumreport
WHERE status='Rejected'
"))['total'];



/* PENDING REPORTS */

$pendingReports=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumreport
WHERE status='Pending'
"))['total'];



/* CONTENT STATUS */


$activeTopics=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumtopic
WHERE status='Active'
"))['total'];



$hiddenTopics=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumtopic
WHERE status='Hidden'
"))['total'];



$activeReplies=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumreply
WHERE status='Active'
"))['total'];



$hiddenReplies=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumreply
WHERE status='Hidden'
"))['total'];



/* MOST REPORTED TOPICS */

$reportedTopics=mysqli_query($conn,"

SELECT

t.topicTitle,

COUNT(fr.reportID) totalReports,

t.status

FROM forumreport fr

JOIN forumtopic t

ON fr.topicID=t.topicID

GROUP BY t.topicID

ORDER BY totalReports DESC

LIMIT 5

");



/* MODERATOR ACTIVITY */

$moderatorActivity=mysqli_query($conn,"

SELECT *

FROM audit_logs

WHERE module='Forum Admin'

ORDER BY created_at DESC

LIMIT 6

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

            <a href="forumModeration.php" class="back-dashboard-btn">

                <i class="fa fa-arrow-left"></i>

                Back to Moderation

            </a>

            <div class="analytics-header">

                <div class="page-header-icon">

                    <i class="fa-solid fa-chart-line"></i>

                </div>

                <div>

                    <h2>
                        Forum Analytics
                    </h2>

                    <p>
                        Monitor reports and community activities.
                    </p>

                </div>


            </div>


            <!-- =====================
            STATS
            ===================== -->
            <div class="analytics-stats">

                <div class="analytics-card">

                    <div class="analytics-icon">

                        <i class="fa-solid fa-flag"></i>

                    </div>

                    <div class="analytics-content">

                        <h3>
                            <?php echo $totalReports; ?>
                        </h3>

                        <p>
                            Total Reports
                        </p>

                    </div>

                </div>


                <div class="analytics-card">

                    <div class="analytics-icon">

                        <i class="fa-solid fa-circle-check"></i>

                    </div>

                    <div class="analytics-content">

                        <h3>
                            <?php echo $approvedReports; ?>
                        </h3>

                        <p>
                            Approved
                        </p>

                    </div>

                </div>


                <div class="analytics-card">

                    <div class="analytics-icon">

                        <i class="fa-solid fa-xmark"></i>

                    </div>

                    <div class="analytics-content">

                        <h3>
                            <?php echo $rejectedReports; ?>
                        </h3>

                        <p>
                            Rejected
                        </p>

                    </div>

                </div>

                <div class="analytics-card">

                    <div class="analytics-icon">

                        <i class="fa-solid fa-clock"></i>

                    </div>

                    <div class="analytics-content">

                        <h3>
                            <?php echo $pendingReports; ?>
                        </h3>

                        <p>
                            Pending
                        </p>

                    </div>

                </div>


            </div>

            <!-- =====================
            ANALYTICS CONTENT
            ===================== -->

            <div class="analytics-grid">


                <!-- REPORT OVERVIEW -->

                <div class="analytics-card-panel">


                    <div class="panel-header">

                        <div class="panel-icon">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>

                        <div>
                            <h3>Report Overview</h3>
                            <p>Report status distribution</p>
                        </div>

                    </div>


                    <div class="panel-body">

                        <div class="chart-wrapper">
                            <canvas id="reportChart"></canvas>
                        </div>

                    </div>


                </div>




                <!-- CONTENT STATUS -->

                <div class="analytics-card-panel">


                    <div class="panel-header">

                        <div class="panel-icon">

                            <i class="fa-solid fa-chart-column"></i>

                        </div>


                        <div>

                            <h3>Content Status</h3>

                            <p>Topic and reply statistics</p>

                        </div>


                    </div>



                    <div class="panel-body">


                        <div class="chart-wrapper">

                            <canvas id="contentChart"></canvas>

                        </div>


                    </div>



                </div>



            </div>






            <!-- =====================
            TABLE + ACTIVITY
            ===================== -->


            <div class="analytics-grid">


                <!-- MOST REPORTED TOPICS -->


                <div class="analytics-card-panel">


                    <div class="panel-header">


                        <div class="panel-icon">

                            <i class="fa-solid fa-fire"></i>

                        </div>


                        <div>

                            <h3>Most Reported Topics</h3>

                            <p>Top reported discussions</p>

                        </div>


                    </div>



                    <div class="panel-body table-container">


                        <table class="analytics-table">


                            <thead>

                                <tr>

                                    <th>Topic</th>

                                    <th>Reports</th>

                                    <th>Status</th>

                                </tr>

                            </thead>



                            <tbody>


                            <?php while($topic=mysqli_fetch_assoc($reportedTopics)){ ?>


                                <tr>

                                    <td>
                                        <?php echo htmlspecialchars($topic['topicTitle']); ?>
                                    </td>


                                    <td>

                                        <strong>
                                        <?php echo $topic['totalReports']; ?>
                                        </strong>

                                    </td>


                                    <td>


                                        <span class="analytics-badge 
                                        
                                        <?php echo ($topic['status']=="Hidden") 
                                        ? 'badge-hidden' 
                                        : 'badge-active'; ?>">


                                        <?php echo $topic['status']; ?>


                                        </span>


                                    </td>


                                </tr>


                            <?php } ?>


                            </tbody>


                        </table>


                    </div>


                </div>







                <!-- MODERATOR ACTIVITY -->


                <div class="analytics-card-panel">


                    <div class="panel-header">


                        <div class="panel-icon">

                            <i class="fa-solid fa-user-shield"></i>

                        </div>


                        <div>

                            <h3>Moderator Activity</h3>

                            <p>Recent moderation actions</p>

                        </div>


                    </div>




                    <div class="panel-body">


                        <div class="analytics-timeline">


                        <?php while($log=mysqli_fetch_assoc($moderatorActivity)){ ?>


                            <div class="timeline-item">


                                <div class="timeline-icon">

                                    <i class="fa-solid fa-shield"></i>

                                </div>



                                <div class="timeline-content">


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


                            </div>



                        <?php } ?>


                        </div>


                    </div>


                </div>



            </div>

            </div> <!-- container -->

        </section>

    
    <br><br>

    <?php include("../student/includes/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>


        const reportCtx = document.getElementById("reportChart").getContext("2d");

        const reportGradient1 = reportCtx.createLinearGradient(0,0,0,300);
        reportGradient1.addColorStop(0,"#22c55e");
        reportGradient1.addColorStop(1,"#16a34a");

        const reportGradient2 = reportCtx.createLinearGradient(0,0,0,300);
        reportGradient2.addColorStop(0,"#ef4444");
        reportGradient2.addColorStop(1,"#dc2626");

        const reportGradient3 = reportCtx.createLinearGradient(0,0,0,300);
        reportGradient3.addColorStop(0,"#f59e0b");
        reportGradient3.addColorStop(1,"#d97706");

        new Chart(reportCtx,{
            type:"doughnut",

            data:{
                labels:["Approved","Rejected","Pending"],
                datasets:[{
                    data:[
                        <?php echo $approvedReports; ?>,
                        <?php echo $rejectedReports; ?>,
                        <?php echo $pendingReports; ?>
                    ],
                    backgroundColor:[
                        reportGradient1,
                        reportGradient2,
                        reportGradient3
                    ],
                    borderWidth:0,
                    spacing:5,
                    hoverOffset:18,
                    borderRadius:8,
                    cutout:"72%"
                }]
            },

            options:{
                responsive:true,
                maintainAspectRatio:false,

                animation:{
                    duration:1200,
                    easing:"easeOutQuart"
                },

                plugins:{
                    legend:{
                        position:"bottom",
                        labels:{
                            usePointStyle:true,
                            pointStyle:"circle",
                            padding:25,
                            boxWidth:10,
                            color:getComputedStyle(document.body)
                                .getPropertyValue("--text")
                        }
                    },

                    tooltip:{
                        backgroundColor:"#1E293B",
                        padding:14,
                        cornerRadius:14,
                        displayColors:false,
                        titleColor:"#fff",
                        bodyColor:"#fff"
                    }
                }
            }
        });


        const contentCtx = document
        .getElementById("contentChart")
        .getContext("2d");


        new Chart(contentCtx,{

            type:"bar",

            data:{

                labels:[
                    "Active Topics",
                    "Hidden Topics",
                    "Active Replies",
                    "Hidden Replies"
                ],

                datasets:[{

                    label:"Content",

                    data:[

                        <?php echo $activeTopics; ?>,
                        <?php echo $hiddenTopics; ?>,
                        <?php echo $activeReplies; ?>,
                        <?php echo $hiddenReplies; ?>

                    ],

                    borderRadius:12,

                    backgroundColor:[

                        "#22c55e",
                        "#ef4444",
                        "#3b82f6",
                        "#f59e0b"

                    ]

                }]

            },


            options:{

                responsive:true,

                maintainAspectRatio:false,


                plugins:{

                    legend:{
                        display:false
                    }

                },


                scales:{

                    y:{

                        beginAtZero:true,

                        ticks:{
                            precision:0
                        }

                    }

                }

            }

        });


    </script>

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