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



/*==========================
FILTERS
==========================*/

$filterAction=$_GET['action'] ?? "";

$sort=$_GET['sort'] ?? "new";


/*==========================
BASE SQL
==========================*/

$sql="

SELECT *

FROM audit_logs

WHERE module IN ('Forum','Forum Admin')

";


/*==========================
ACTION FILTER
==========================*/

if($filterAction!="")
{
    $filterAction=mysqli_real_escape_string($conn,$filterAction);

    $sql.=" AND action='$filterAction'";
}


/*==========================
SORTING
==========================*/

switch($sort)
{

case "old":

    $sql.=" ORDER BY created_at ASC";

break;


case "action":

    $sql.=" ORDER BY action ASC";

break;


default:

    $sql.=" ORDER BY created_at DESC";

}


/*==========================
COUNT TOTAL RECORDS
==========================*/

$countSQL="

SELECT COUNT(*) AS total

FROM audit_logs

WHERE module IN ('Forum','Forum Admin')

";


if($filterAction!="")
{
    $countSQL.=" AND action='$filterAction'";
}


$countResult=mysqli_query($conn,$countSQL);


$total=mysqli_fetch_assoc($countResult)['total'];


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

$result=mysqli_query($conn,$sql);



/* ==========================
ADMIN PROFILE
========================== */


$user=mysqli_fetch_assoc(

mysqli_query($conn,"

SELECT

adminUsername,

adminIMG

FROM admin

WHERE adminID='$adminID'

")

);


$adminUsername=$user['adminUsername'] ?? "Admin";

$img=$user['adminIMG'] ?? "../../assets/images/profile/default.png";



?>



<!DOCTYPE html>

<html lang="en">


<head>


    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
        Forum Audit Logs
    </title>


    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="../../assets/css/styleindex.css">

    <link rel="stylesheet" href="../../assets/css/forum.css">

    <link rel="stylesheet" href="../../assets/css/footer.css">

    <link rel="icon" href="../../assets/images/logo.png">



</head>


<body>



<?php include("../student/includes/header.php"); ?>




<section class="section community-section" id="community">

    <div class="container">

    <br><br>



    <!-- BACK BUTTON -->

    <a href="forumModeration.php" class="back-dashboard-btn">
        <i class="fa fa-arrow-left"></i>
        Back to Moderation
    </a>

    <!-- PAGE HEADER -->

    <div class="forum-page-header audit-page-header">

        <div class="page-header-icon audit-header-icon">

            <i class="fa-solid fa-clock-rotate-left"></i>

        </div>

        <div>

            <h2>

                Forum Audit Logs

            </h2>


            <p>

                Monitor forum activities, moderation actions and content changes.

            </p>


        </div>



    </div>

    <div class="forum-toolbar">

        <form method="GET">

            <select name="action">

                <option value="">All Actions</option>

                <option value="CREATE_TOPIC"
                <?php if($filterAction=="CREATE_TOPIC") echo "selected"; ?>>

                    Create Topic

                </option>

                <option value="UPDATE_TOPIC"
                <?php if($filterAction=="UPDATE_TOPIC") echo "selected"; ?>>

                    Update Topic

                </option>

                <option value="DELETE_TOPIC"
                <?php if($filterAction=="DELETE_TOPIC") echo "selected"; ?>>

                    Delete Topic

                </option>

                <option value="PIN_TOPIC"
                <?php if($filterAction=="PIN_TOPIC") echo "selected"; ?>>

                    Pin Topic

                </option>

                <option value="LOCK_TOPIC"
                <?php if($filterAction=="LOCK_TOPIC") echo "selected"; ?>>

                    Lock Topic

                </option>

                <option value="APPROVE_REPORT"
                <?php if($filterAction=="APPROVE_REPORT") echo "selected"; ?>>

                    Approve Report

                </option>

                <option value="REJECT_REPORT"
                <?php if($filterAction=="REJECT_REPORT") echo "selected"; ?>>

                    Reject Report

                </option>

            </select>

            <select name="sort">

                <option value="new"
                <?php if($sort=="new") echo "selected"; ?>>

                    Newest

                </option>

                <option value="old"
                <?php if($sort=="old") echo "selected"; ?>>

                    Oldest

                </option>

                <option value="action"
                <?php if($sort=="action") echo "selected"; ?>>

                    Action (A-Z)

                </option>

            </select>

            <button type="submit">

                <i class="fa fa-filter"></i>

                Apply

            </button>

        </form>

    </div>



<!-- AUDIT TIMELINE -->

<div class="audit-timeline">

    <?php if(mysqli_num_rows($result)==0){ ?>

    <div class="audit-empty">


        <i class="fa-solid fa-folder-open"></i>


        <h4>
            No Forum Activity Found
        </h4>


        <p>
            Forum actions will appear here when users interact with the system.
        </p>

    </div>

    <?php } ?>


    <?php while($log=mysqli_fetch_assoc($result)){ ?>


        <?php


        $logAction=$log['action'];



        $badgeClass="audit-update";


        if(str_contains($logAction,"DELETE"))
        {
            $badgeClass="audit-delete";
        }

        elseif(str_contains($logAction,"CREATE"))
        {
            $badgeClass="audit-create";
        }

        elseif(str_contains($logAction,"LOCK") || str_contains($logAction,"PIN"))
        {
            $badgeClass="audit-admin";
        }


        ?>


        <div class="audit-card">

            <div class="audit-marker">

                <i class="fa-solid fa-shield-halved"></i>

            </div>

            <div class="audit-content">

                <div class="audit-title-row">


                    <h4>

                        <?php echo htmlspecialchars($logAction); ?>

                    </h4>


                    <span class="audit-action <?php echo $badgeClass; ?>">

                        Forum

                    </span>

                </div>

                <p>

                    <?php echo htmlspecialchars($log['description']); ?>

                </p>

                <div class="audit-meta">

                    <span>

                        <i class="fa-solid fa-user"></i>


                        User ID:

                        <?php echo $log['adminID']; ?>


                    </span>

                    <span>

                        <i class="fa-solid fa-calendar"></i>


                        <?php echo $log['created_at']; ?>


                    </span>

                </div>

            </div>

        </div>


        <?php } ?>

    </div>

    <?php if($totalPages > 1){ ?>


    <div class="pagination">

        <?php if($page > 1){ ?>

        <a href="?page=<?php echo $page-1; ?>&action=<?php echo urlencode($filterAction); ?>&sort=<?php echo urlencode($sort); ?>">

            <i class="fa fa-angle-left"></i>

        </a>

        <?php } ?>

        <?php


        $start=max(1,$page-2);

        $end=min($totalPages,$page+2);



        for($i=$start;$i<=$end;$i++)
        {

        ?>


        <a 

        href="?page=<?php echo $i; ?>&action=<?php echo urlencode($filterAction); ?>&sort=<?php echo urlencode($sort); ?>"

        class="<?php echo ($page==$i) ? 'active':''; ?>">

            <?php echo $i; ?>

        </a>


        <?php } ?>


        <?php if($page < $totalPages){ ?>


        <a href="?page=<?php echo $page+1; ?>&action=<?php echo urlencode($filterAction); ?>&sort=<?php echo urlencode($sort); ?>">

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

        logs

    </div>

    <?php } ?>

</div>


</section>




<br><br>


<?php include("../student/includes/footer.php"); ?>





<script src="../../assets/js/custom.js"></script>

<script src="../../assets/js/studentTheme.js"></script>

<script src="../../assets/js/header.js"></script>

<script src="../../assets/js/forum/topic.js"></script>



</body>

</html>