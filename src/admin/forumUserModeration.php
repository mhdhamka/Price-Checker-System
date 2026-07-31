<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}


$adminID=$_SESSION['adminID'];


/* ==========================
USER SEARCH + PAGINATION
========================== */


$search=$_GET['search'] ?? "";


/* Pagination */

$limit = 9;

$page = $_GET['page'] ?? 1;

$page = max(1, intval($page));


$offset = ($page - 1) * $limit;



/* ==========================
STUDENT MODERATION DATA
========================== */

$query="

SELECT


s.studentID,

s.fullName,

s.username,

s.studentIMG,


COUNT(fr.reportID) totalReports,


SUM(
CASE 
WHEN fr.status='Approved'
THEN 1
ELSE 0
END
) approvedReports,


SUM(
CASE
WHEN fr.status='Rejected'
THEN 1
ELSE 0
END
) rejectedReports


FROM student s


LEFT JOIN forumreport fr

ON s.studentID=fr.studentID

WHERE

s.fullName LIKE '%$search%'

GROUP BY s.studentID


ORDER BY totalReports DESC


LIMIT $limit OFFSET $offset


";


/* ==========================
TOTAL STUDENTS
========================== */


$countQuery="

SELECT COUNT(*) total

FROM student


WHERE fullName LIKE '%$search%'


";


$total=mysqli_fetch_assoc(
mysqli_query($conn,$countQuery)
)['total'];



$totalPages=ceil($total/$limit);



$students=mysqli_query($conn,$query);


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

    <meta charset="UTF-8">

    <title>Forum User Moderation</title>

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


            <a href="forumModeration.php"
            class="back-dashboard-btn">

                <i class="fa fa-arrow-left"></i>

                Back To Moderation

            </a>

            <div class="forum-page-header">

                <div class="page-header-icon moderation-header-icon">

                    <i class="fa-solid fa-user-shield"></i>

                </div>

                <div>

                    <h2>
                        User Moderation
                    </h2>

                    <p>
                        Monitor student report history and moderation behaviour.
                    </p>

                </div>

            </div>


            <!-- SEARCH -->
            <div class="user-moderation-toolbar">

                <form>

                    <div class="moderation-search">

                        <i class="fa-solid fa-search"></i>

                        <input 
                        type="text"
                        name="search"
                        placeholder="Search student..."
                        value="<?php echo htmlspecialchars($search); ?>">

                        <button>

                            Search
                        </button>

                    </div>

                </form>

            </div>

            <div class="user-grid">

                <?php while($student=mysqli_fetch_assoc($students)){


                $level="Normal";

                if($student['approvedReports'] >= 5)
                {
                    $level="High Risk";
                }

                else if($student['approvedReports'] >= 2)
                {
                    $level="Warning";
                }


                ?>

                <div class="user-card">

                    <div class="user-card-top">

                        <div class="user-profile">

                            <img
                            src="<?php echo !empty($student['studentIMG'])
                            ? $student['studentIMG']
                            : '../../assets/images/profile/default.png'; ?>">

                            <div>

                                <h3>
                                    <?php echo htmlspecialchars($student['fullName']); ?>
                                </h3>

                                <span class="username">
                                    @<?php echo htmlspecialchars($student['username']); ?>
                                </span>

                            </div>

                        </div>

                        <span class="risk-badge <?php echo strtolower(str_replace(' ','-',$level)); ?>">

                            <i class="fa-solid fa-shield-halved"></i>

                            <?php echo $level; ?>

                        </span>

                    </div>


                    <div class="user-divider"></div>


                    <div class="user-stat-grid">

                        <div class="user-stat">

                            <span>

                                <?php echo $student['totalReports']; ?>

                            </span>

                            <small>Total Reports</small>

                        </div>

                        <div class="user-stat">

                            <span>

                                <?php echo $student['approvedReports']; ?>

                            </span>

                            <small>Approved</small>

                        </div>

                        <div class="user-stat">

                            <span>

                                <?php echo $student['rejectedReports']; ?>

                            </span>

                            <small>Rejected</small>

                        </div>

                    </div>


                    <?php

                    $rate = 0;

                    if($student['totalReports'] > 0)
                    {
                        $rate = round(($student['approvedReports'] / $student['totalReports']) * 100);
                    }

                    ?>


                    <div class="moderation-progress">

                        <div class="progress-title">

                            <span>Violation Rate</span>

                            <strong><?php echo $rate; ?>%</strong>

                        </div>

                        <div class="progress-bar">

                            <div class="progress-fill"
                            style="width:<?php echo $rate; ?>%">

                            </div>

                        </div>

                    </div>


                    <a href="forumHistory.php?id=<?php echo $student['studentID']; ?>"
                    class="moderation-history-btn">

                        <span>

                            View Moderation History

                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>


            <?php } ?>


        </div>

        <?php if($totalPages>1){ ?>


            <div class="pagination">


                <?php if($page>1){ ?>

                <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>">

                    <i class="fa fa-angle-left"></i>

                </a>

                <?php } ?>


                <?php


                $start=max(1,$page-2);

                $end=min($totalPages,$page+2);


                for($i=$start;$i<=$end;$i++)

                {


                ?>


                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"
                class="<?php echo ($page==$i)?'active':''; ?>">

                    <?php echo $i; ?>

                </a>

                <?php } ?>


                <?php if($page<$totalPages){ ?>

                <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>">

                    <i class="fa fa-angle-right"></i>

                </a>


                <?php } ?>



            </div>


            <div class="pagination-info">

                Showing

                <strong>

                    <?php echo $offset+1; ?>

                </strong>

                to

                <strong>

                    <?php echo min($offset+$limit,$total); ?>

                </strong>

                of

                <strong>

                    <?php echo $total; ?>

                </strong>

                students

            </div>


            <?php } ?>


    </div>


    </section>



    <?php include("../student/includes/footer.php"); ?>


    <script src="../../assets/js/studentTheme.js"></script>
    <script src="../../assets/js/header.js"></script>


</body>

</html>