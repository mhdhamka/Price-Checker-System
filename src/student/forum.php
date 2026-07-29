<?php

session_start();
include("../config/db_cPCS.php");

/*==========================
LOGIN
==========================*/

if(!isset($_SESSION['studentID']))
{
    header("Location: ../public/loginStudent.php");
    exit();
}

$studentID=$_SESSION['studentID'];

$isAdmin=false;
$pageType="student";


/*==========================
FILTERS
==========================*/

$search   = $_GET['search']   ?? "";
$category = $_GET['category'] ?? "";
$sort     = $_GET['sort']     ?? "newest";


/*==========================
SEARCH QUERY
==========================*/

$where=" WHERE t.status='Active' ";

if($search!="")
{
    $search=mysqli_real_escape_string($conn,$search);

    $where.=" AND (
        t.topicTitle LIKE '%$search%'
        OR t.topicContent LIKE '%$search%'
    )";
}

if($category!="")
{
    $category=(int)$category;

    $where.=" AND t.categoryID=$category";
}


/*==========================
SORT
==========================*/

$order=" ORDER BY t.isPinned DESC,t.created_at DESC ";

if($sort=="views")
{
    $order=" ORDER BY t.views DESC ";
}

if($sort=="reply")
{
    $order=" ORDER BY totalReplies DESC ";
}

/*==========================
TOTAL TOPICS
==========================*/

$countSql = "

SELECT
COUNT(DISTINCT t.topicID) total

FROM forumtopic t

LEFT JOIN forumcategory c
ON t.categoryID=c.categoryID

$where

";

$countResult = mysqli_query($conn,$countSql);

$total = mysqli_fetch_assoc($countResult)['total'];

/*==========================
PAGINATION
==========================*/

$limit = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1)
{
    $page = 1;
}

$totalPages = max(1, ceil($total / $limit));

if($page > $totalPages)
{
    $page = $totalPages;
}

$offset = ($page - 1) * $limit;


/*==========================
TOPICS
==========================*/

$sql="

SELECT

t.*,

c.categoryName,

s.fullName,

COUNT(DISTINCT r.replyID) totalReplies,

MAX(r.created_at) lastReplyDate,

COALESCE(fl.totalLikes,0) totalLikes,

COALESCE(fb.totalBookmarks,0) totalBookmarks,

CASE
WHEN ul.studentID IS NULL THEN 0
ELSE 1
END AS userLiked,

CASE
WHEN ub.studentID IS NULL THEN 0
ELSE 1
END AS userBookmarked,

(

SELECT s2.fullName

FROM forumreply fr

JOIN student s2
ON fr.studentID=s2.studentID

WHERE fr.topicID=t.topicID

ORDER BY fr.created_at DESC

LIMIT 1

) lastReplyBy

FROM forumtopic t

LEFT JOIN forumcategory c
ON t.categoryID=c.categoryID

LEFT JOIN student s
ON t.studentID=s.studentID

LEFT JOIN forumreply r
ON r.topicID=t.topicID

LEFT JOIN
(
SELECT topicID,
COUNT(*) totalLikes
FROM forumlikes
GROUP BY topicID
) fl
ON fl.topicID=t.topicID

LEFT JOIN
(
SELECT topicID,
COUNT(*) totalBookmarks
FROM forumbookmarks
GROUP BY topicID
) fb
ON fb.topicID=t.topicID

LEFT JOIN forumlikes ul
ON ul.topicID=t.topicID
AND ul.studentID='$studentID'

LEFT JOIN forumbookmarks ub
ON ub.topicID=t.topicID
AND ub.studentID='$studentID'

$where

GROUP BY t.topicID

$order

LIMIT $limit OFFSET $offset

";

$communityPosts=mysqli_query($conn,$sql);

/*==========================
FORUM STATS
==========================*/

$totalTopics=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumtopic
"))['total'];

$totalReplies=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM forumreply
"))['total'];

$totalMembers=mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM student
"))['total'];


/*==========================
PROFILE
==========================*/

$user=mysqli_fetch_assoc(

mysqli_query($conn,"

SELECT
username,
studentIMG

FROM student

WHERE studentID='$studentID'

")

);

$username=$user['username'];
$img=$user['studentIMG'];

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
    SELECT username, studentIMG
    FROM student
    WHERE studentID = '$studentID'
    ";

    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        $username = $user['username'];
        $img = $user['studentIMG'];
    }
    else
    {
        $username = "Student";
        $img = "../../assets/images/profile/default.png";
    }

    ?>
    
    <?php include("../student/includes/header.php"); ?>


    <!-- ***** Community Forum ***** -->
    <section class="section community-section" id="community">

        <div class="container">

            <?php
                $isAdmin = false;
                $pageType = "student";

                /* ==========================
                RIGHT SIDEBAR DATA
                ========================== */

                $trendingTopics = mysqli_query($conn,"
                    SELECT
                        topicID,
                        topicTitle,
                        views
                    FROM forumtopic
                    WHERE status='Active'
                    ORDER BY views DESC
                    LIMIT 5
                ");

                /* ==========================
                CREATE / EDIT CATEGORY LIST
                ========================== */

                $categoryQuery = mysqli_query($conn,"
                    SELECT
                        categoryID,
                        categoryName
                    FROM forumcategory
                    ORDER BY categoryName ASC
                ");
            ?>

            <?php include("../includes/forum/forumHeader.php"); ?>

            <?php include("../includes/forum/forumToolbar.php"); ?>

            <div class="forum-layout">

                <?php include("../includes/forum/forumLeftSidebar.php"); ?>

                <div class="forum-center">

                    <?php include("../includes/forum/forumTopicList.php"); ?>

                     <?php if($totalPages > 1){ ?>

                        <div class="pagination">

                            <?php

                            if($page > 1)
                            {
                            ?>

                            <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category); ?>&sort=<?php echo urlencode($sort); ?>">
                                <i class="fa fa-angle-left"></i>
                            </a>

                            <?php
                            }

                            if($page > 3)
                            {
                            ?>

                            <a href="?page=1&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category); ?>&sort=<?php echo urlencode($sort); ?>">
                                1
                            </a>

                            <?php

                            if($page > 4)
                            {
                            ?>

                            <span class="dots">...</span>

                            <?php
                            }

                            }

                            $start=max(1,$page-2);
                            $end=min($totalPages,$page+2);

                            for($i=$start;$i<=$end;$i++)
                            {
                            ?>

                            <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category); ?>&sort=<?php echo urlencode($sort); ?>"
                            class="<?php if($page==$i) echo "active"; ?>">
                                <?php echo $i; ?>
                            </a>

                            <?php
                            }

                            if($page < $totalPages-2)
                            {

                                if($page < $totalPages-3)
                                {
                            ?>

                            <span class="dots">...</span>

                            <?php
                                }
                            ?>

                            <a href="?page=<?php echo $totalPages; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category); ?>&sort=<?php echo urlencode($sort); ?>">
                                <?php echo $totalPages; ?>
                            </a>

                            <?php
                            }

                            if($page < $totalPages)
                            {
                            ?>

                            <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($category); ?>&sort=<?php echo urlencode($sort); ?>">
                                <i class="fa fa-angle-right"></i>
                            </a>

                            <?php
                            }

                            ?>

                        </div>

                        <div class="pagination-info">

                            Showing

                            <strong><?php echo $total == 0 ? 0 : $offset + 1; ?></strong>

                            to

                            <strong><?php echo min($offset + $limit, $total); ?></strong>

                            of

                            <strong><?php echo $total; ?></strong>

                            topics

                        </div>

                        <?php } ?>

                </div>

                <?php include("../includes/forum/forumRightSidebar.php"); ?>

            </div>

            <!-- ==========================
                MODALS
            ========================== -->


            <!-- CREATE TOPIC MODAL -->
            <?php include(__DIR__ . "/../includes/forum/forumCreateModal.php"); ?>


            <!-- EDIT TOPIC MODAL -->
            <?php include(__DIR__ . "/../includes/forum/forumEditModal.php"); ?>


            <!-- DELETE TOPIC MODAL -->
            <?php include(__DIR__ . "/../includes/forum/forumDeleteModal.php"); ?>


            <!-- REPORT MODAL -->
            <?php include(__DIR__ . "/../includes/forum/reportModal.php"); ?>


            <!-- ==========================
                FOOTER
            ========================== -->

            <?php include("../includes/forum/forumFooter.php"); ?>

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

    <script>
        function slideCategory(direction){

            const container = document.querySelector(".category-container");
            container.scrollLeft += direction * 350;

        }
    </script>

  </body>
</html>