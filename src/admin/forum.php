<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

$adminID = $_SESSION['adminID'];

$isAdmin = true;
$pageType = "admin";


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
FROM forumbookmark
GROUP BY topicID
) fb
ON fb.topicID=t.topicID

$where

GROUP BY t.topicID

$order

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
adminUsername,
adminIMG

FROM admin

WHERE adminID='$adminID'

")

);

$adminUsername=$user['adminUsername'];
$img=$user['adminIMG'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Price Checker System Admin</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/forum.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

</head>
    
<body>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>

    <?php

    global $conn;

    $sql = "
    SELECT adminUsername, adminIMG
    FROM admin
    WHERE adminID='$adminID'
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
        $adminUsername = "Admin";
        $img = "../../assets/images/profile/default.png";
    }

    ?>
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="../admin/dashboard.php" class="logo"><img src="../../assets/images/logo.png" width="90" height="90"></a>
                        <!-- ***** Logo End ***** -->

                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top">Home</a></li>
                            <li class="scroll-to-section"><a href="#compare">Compare </a></li>
                            <li class="scroll-to-section"><a href="#search">Products</a></li>
                            <li class="scroll-to-section"><a href="#tools">Tools</a></li>
                            <li class="scroll-to-section"><a href="#trend">Trending</a></li>
                            <li class="scroll-to-section"><a href="#community" class="active">Community</a></li>
                            <li class="scroll-to-section"><a href="#why-us">About</a></li>

                            <form method="get">
                                <div class="icons">
                                    <div class="dropdown">
                                        <img src="<?php echo $img; ?>" width="40" height="40" class="rounded-circle">
                                        <div class="dropdown-content">
                                            <a href="../admin/profile.php">My Profile</a>
                                            <a href="../public/logout.php" name="logout">Log Out</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>


    <!-- ***** Community Forum ***** -->
    <section class="section community-section" id="community">

        <div class="container">

            <?php
                $isAdmin = true;
                $pageType = "admin";

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

                <?php include("../includes/forum/forumTopicList.php"); ?>

                <?php include("../includes/forum/forumRightSidebar.php"); ?>

            </div>

            <!-- ==========================
                MODALS
            ========================== -->

            <?php include("../includes/forum/forumCreateModal.php"); ?>

            <?php include("../includes/forum/forumEditModal.php"); ?>

            <?php include("../includes/forum/forumDeleteModal.php"); ?>

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
    <script src="../../assets/js/forum/like.js"></script>
    <script src="../../assets/js/forum/bookmark.js"></script>
    <script src="../../assets/js/forum/modal.js"></script>
    <script src="../../assets/js/forum/topic.js"></script>

    <script>
        function slideCategory(direction){

            const container = document.querySelector(".category-container");
            container.scrollLeft += direction * 350;

        }
    </script>

  </body>
</html>