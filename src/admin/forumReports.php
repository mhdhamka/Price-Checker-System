<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginStudent.php");
    exit();
}

$adminID=$_SESSION['adminID'];

$isAdmin=true;
$pageType="admin";


/*==========================
FILTERS
==========================*/

$status = $_GET['status'] ?? "";
$type = $_GET['type'] ?? "";
$sort = $_GET['sort'] ?? "new";


/*==========================
BASE SQL
==========================*/

$sql = "

SELECT

fr.*,

s.fullName,

s.studentIMG,

t.topicTitle,

r.replyContent

FROM forumreport fr

LEFT JOIN student s
ON fr.studentID=s.studentID

LEFT JOIN forumtopic t
ON fr.topicID=t.topicID

LEFT JOIN forumreply r
ON fr.replyID=r.replyID

WHERE 1
";


/*==========================
STATUS FILTER
==========================*/

if($status!="")
{
    $status=mysqli_real_escape_string($conn,$status);

    $sql.=" AND fr.status='$status'";
}


/*==========================
REPORT TYPE FILTER
==========================*/

if($type=="topic")
{
    $sql.=" AND fr.topicID IS NOT NULL";
}
else if($type=="reply")
{
    $sql.=" AND fr.replyID IS NOT NULL";
}


/*==========================
SORTING
==========================*/

switch($sort)
{

case "old":

    $sql.=" ORDER BY fr.created_at ASC";

break;


case "reporter":

    $sql.=" ORDER BY s.fullName ASC";

break;


default:

    $sql.=" ORDER BY fr.created_at DESC";

}


$countResult=mysqli_query($conn,$sql);

$total=mysqli_num_rows($countResult);


/*==========================
PAGINATION
==========================*/

$limit=10;

$page=isset($_GET['page'])
? (int)$_GET['page']
:1;


if($page<1)
{
    $page=1;
}


$totalPages=max(1,ceil($total/$limit));


if($page>$totalPages)
{
    $page=$totalPages;
}


$offset=($page-1)*$limit;


$sql.=" LIMIT $offset,$limit";


$reports=mysqli_query($conn,$sql);



?>


<!DOCTYPE html>

<html>

<head>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>
        Forum Reports
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

        <!-- BACK BUTTON -->
        <a href="forumModeration.php" class="back-dashboard-btn">
            <i class="fa fa-arrow-left"></i>
            Back to Moderation
        </a>

        <div class="forum-page-header">


            <div class="page-header-icon report-header-icon">

                <i class="fa-solid fa-flag"></i>

            </div>


            <div>

                <h2>
                    Report Management
                </h2>

                <p>
                    Review and manage reported forum content
                </p>

            </div>


        </div>


        <div class="forum-toolbar">

            <form method="GET">

                <select name="status">

                    <option value="">All Status</option>

                    <option value="Pending" <?=($status=="Pending")?"selected":"";?>>

                        Pending

                    </option>

                    <option value="Approved" <?=($status=="Approved")?"selected":"";?>>

                        Approved

                    </option>

                    <option value="Rejected" <?=($status=="Rejected")?"selected":"";?>>

                        Rejected

                    </option>

                </select>

                <select name="type">

                    <option value="">All Reports</option>

                    <option value="topic" <?=($type=="topic")?"selected":"";?>>

                        Topic

                    </option>

                    <option value="reply" <?=($type=="reply")?"selected":"";?>>

                        Reply

                    </option>

                </select>


                <select name="sort">

                    <option value="new" <?=($sort=="new")?"selected":"";?>>

                        Newest

                    </option>

                    <option value="old" <?=($sort=="old")?"selected":"";?>>

                        Oldest

                    </option>

                    <option value="reporter" <?=($sort=="reporter")?"selected":"";?>>

                        Reporter A-Z

                    </option>

                </select>

                <button type="submit">

                    <i class="fa fa-filter"></i>

                    Apply

                </button>

            </form>

        </div>



        <div class="report-grid">

            <?php while($report=mysqli_fetch_assoc($reports)){ ?>

            <div class="report-card">

                <div class="report-top">

                    <div class="report-type">

                        <div class="report-avatar">

                            <img src="<?php echo !empty($report['studentIMG']) 
                            ? $report['studentIMG'] 
                            : '../../assets/images/profile/default.png'; ?>">

                        </div>

                        <div>

                            <strong>
                                <?php echo htmlspecialchars($report['fullName']); ?>
                            </strong>


                            <small>
                                Reporter
                            </small>

                        </div>

                    </div>


                    <span class="report-status pending">

                        <i class="fa-solid fa-clock"></i>

                        <?php echo $report['status'] ?? "Pending"; ?>

                    </span>

                </div>


                <div class="report-body">


                    <h4>


                    <?php

                    if($report['topicID'])
                    {

                        ?>

                        <i class="fa-solid fa-comments"></i>

                        <?php

                        echo htmlspecialchars($report['topicTitle']);

                    }
                    else
                    {

                        ?>

                        <i class="fa-solid fa-reply"></i>

                        Reply Report


                        <?php

                    }

                    ?>


                    </h4>



                    <?php if($report['replyContent']){ ?>


                    <div class="reported-content">


                        <?php echo htmlspecialchars($report['replyContent']); ?>


                    </div>


                    <?php } ?>




                    <div class="report-info">


                        <div>

                            <i class="fa-solid fa-circle-exclamation"></i>

                            Reason

                            <strong>

                            <?php echo htmlspecialchars($report['reason']); ?>

                            </strong>


                        </div>




                        <div>

                            <i class="fa-solid fa-calendar"></i>

                            <?php echo $report['created_at']; ?>


                        </div>


                    </div>


                </div>

                <div class="report-actions">

                    <?php if($report['topicID']){ ?>


                    <a href="forumTopicView.php?id=<?php echo $report['topicID']; ?>"
                    class="report-btn view-btn">

                        <i class="fa-solid fa-eye"></i>

                        View

                    </a>

                    <?php } ?>

                    <?php 

                    $status = strtolower($report['status'] ?? "pending");

                    ?>


                    <?php if($status != "approved"){ ?>


                    <button class="report-btn approve-btn"
                    data-id="<?php echo $report['reportID']; ?>">


                        <i class="fa-solid fa-check"></i>

                        Approve


                    </button>


                    <?php } ?>




                    <?php if($status != "rejected"){ ?>


                    <button class="report-btn reject-btn"
                    data-id="<?php echo $report['reportID']; ?>">


                        <i class="fa-solid fa-xmark"></i>

                        Reject


                    </button>


                    <?php } ?>



                    </div>



            </div>

            <?php } ?>


        </div>


        <?php if($totalPages>1){ ?>

            <div class="pagination">

            <?php if($page>1){ ?>

                <a href="?page=<?php echo $page-1; ?>&status=<?php echo urlencode($status); ?>&type=<?php echo urlencode($type); ?>&sort=<?php echo urlencode($sort); ?>">

                    <i class="fa fa-angle-left"></i>

                </a>

            <?php } ?>


            <?php

            $start=max(1,$page-2);

            $end=min($totalPages,$page+2);

            for($i=$start;$i<=$end;$i++)
            {

            ?>

                <a href="?page=<?php echo $i; ?>&status=<?php echo urlencode($status); ?>&type=<?php echo urlencode($type); ?>&sort=<?php echo urlencode($sort); ?>"
                class="<?php echo ($page==$i) ? 'active' : ''; ?>">

                    <?php echo $i; ?>

                </a>

            <?php } ?>

            <?php if($page<$totalPages){ ?>

                <a href="?page=<?php echo $page+1; ?>&status=<?php echo urlencode($status); ?>&type=<?php echo urlencode($type); ?>&sort=<?php echo urlencode($sort); ?>">

                    <i class="fa fa-angle-right"></i>

                </a>

            <?php } ?>

            </div>


            <div class="pagination-info">

                Showing

                <strong>

                <?php echo $total==0 ? 0 : $offset+1; ?>

                </strong>

                to

                <strong>

                <?php echo min($offset+$limit,$total); ?>

                </strong>

                of

                <strong>

                <?php echo $total; ?>

                </strong>

                reports

            </div>

            <?php } ?>


</div>


    <!-- ==========================
    APPROVE REPORT MODAL
    ========================== -->

    <div class="report-modal-overlay" id="approveReportModal">


        <div class="report-modal-card">


            <div class="report-modal-icon approve-modal-icon">

                <i class="fa-solid fa-check"></i>

            </div>



            <h3>
                Approve Report?
            </h3>


            <p>
                This action will mark the report as valid and remove the reported content.
            </p>



            <div class="report-modal-actions">


                <button class="modal-cancel-btn"
                onclick="closeApproveModal()">

                    Cancel

                </button>



                <button class="modal-confirm approve-confirm-btn"
                id="confirmApproveBtn">

                    <i class="fa-solid fa-check"></i>

                    Approve

                </button>


            </div>



        </div>


    </div>



    <!-- ==========================
    REJECT REPORT MODAL
    ========================== -->

    <div class="report-modal-overlay" id="rejectReportModal">


        <div class="report-modal-card">


            <div class="report-modal-icon reject-modal-icon">

                <i class="fa-solid fa-xmark"></i>

            </div>



            <h3>
                Reject Report?
            </h3>


            <p>
                This report will be dismissed and the content will remain visible.
            </p>



            <div class="report-modal-actions">


                <button class="modal-cancel-btn"
                onclick="closeRejectModal()">

                    Cancel

                </button>



                <button class="modal-confirm reject-confirm-btn"
                id="confirmRejectBtn">


                    <i class="fa-solid fa-xmark"></i>

                    Reject


                </button>


            </div>



        </div>


    </div>


</section>

    <?php include("../student/includes/footer.php"); ?>

    <!-- Global Init -->
    <script src="../../assets/js/custom.js"></script>
    <script src="../../assets/js/studentTheme.js"></script>
    <script src="../../assets/js/header.js"></script>
    <script src="../../assets/js/forum/topic.js"></script>
    <script src="../../assets/js/forum/adminTopicActions.js"></script>
    <script src="../../assets/js/forum/adminReportActions.js"></script>


</body>

</html>