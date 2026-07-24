<?php 

session_start();
include ("../config/db_cPCS.php");

// Check if user is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: ../public/loginStudent.php"); 
    exit();
}

$studentID = $_SESSION['studentID'];

/* Student Community */
$communityPosts = mysqli_query($conn,"

SELECT

t.topicID,
t.topicTitle,
t.views,
t.isPinned,
t.created_at,

c.categoryName,

s.fullName,

COUNT(DISTINCT r.replyID) totalReplies,

MAX(r.created_at) lastReplyDate,

(
SELECT s2.fullName
FROM forumreply fr
JOIN student s2
ON fr.studentID=s2.studentID
WHERE fr.topicID=t.topicID
ORDER BY fr.created_at DESC
LIMIT 1
) AS lastReplyBy

FROM forumtopic t

LEFT JOIN forumcategory c
ON t.categoryID=c.categoryID

LEFT JOIN student s
ON t.studentID=s.studentID

LEFT JOIN forumreply r
ON t.topicID=r.topicID

WHERE t.status='Active'

GROUP BY t.topicID

ORDER BY

t.isPinned DESC,
t.created_at DESC

LIMIT 5

");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Price Checker System Student</title>

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
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="../student/dashboard.php" class="logo"><img src="../../assets/images/logo.png" width="90" height="90"></a>
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
                                            <a href="../student/profile.php">My Profile</a>
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


<div class="community-heading">


    <div>

        <h2>
            Community <em>Forum</em>
        </h2>

        <p>
            Discuss products, compare prices, share shopping tips and help fellow students.
        </p>

    </div>


    <a href="createTopic.php" class="community-btn">

        <i class="fa fa-plus"></i>
        New Topic

    </a>


</div>



<!-- SEARCH TOOLBAR -->

<div class="forum-toolbar">


<form method="GET">


<div class="forum-search">

<i class="fa fa-search"></i>

<input 
type="text"
name="search"
placeholder="Search topics..."
value="<?php echo $search; ?>"
>

</div>



<select name="category">


<option value="">
All Categories
</option>


<?php

$catQuery=mysqli_query($conn,"
SELECT *
FROM forumcategory
ORDER BY categoryName
");


while($cat=mysqli_fetch_assoc($catQuery)){


?>


<option

value="<?php echo $cat['categoryID']; ?>"

<?php

if($category==$cat['categoryID'])
echo "selected";

?>

>

<?php echo $cat['categoryName']; ?>


</option>


<?php } ?>


</select>



<select name="sort">


<option value="">
Newest
</option>


<option value="reply">

Most Replies

</option>


<option value="views">

Most Viewed

</option>


</select>



<button>

Filter

</button>


</form>


</div>





<div class="forum-layout">



<!-- LEFT SIDEBAR -->


<div class="forum-left">


<div class="forum-box">


<h4>

Community

</h4>


<a>
All Topics
</a>


<a>
Price Discussion
</a>


<a>
Shopping Tips
</a>


<a>
Product Reviews
</a>


<a>
General Discussion
</a>


<a>
Promotion
</a>


</div>





<div class="forum-box">


<h4>

Popular Tags

</h4>


<span class="forum-tag">

#rice

</span>


<span class="forum-tag">

#promotion

</span>


<span class="forum-tag">

#beverages

</span>


<span class="forum-tag">

#budget

</span>


</div>


</div>






<!-- MAIN TOPICS -->


<div class="forum-main">


<?php while($post=mysqli_fetch_assoc($communityPosts)){ ?>


<div class="topic-card">



<div class="topic-top">


<div>


<?php if($post['isPinned']){ ?>


<span class="pin-badge">

<i class="fa fa-thumb-tack"></i>

Pinned

</span>


<?php } ?>


<span class="category-badge">

<?php echo $post['categoryName']; ?>

</span>


</div>


</div>





<h3>


<a href="../student/viewTopic.php?id=<?php echo $post['topicID']; ?>">


<?php echo $post['topicTitle']; ?>


</a>


</h3>




<p class="topic-author">


Started by

<strong>

<?php echo $post['fullName']; ?>

</strong>


•

<?php echo date("d M Y",strtotime($post['created_at'])); ?>


</p>




<div class="topic-stats">


<span>

<i class="fa fa-eye"></i>

<?php echo $post['views']; ?>

</span>



<span>

<i class="fa fa-comment"></i>

<?php echo $post['totalReplies']; ?>

Replies

</span>



<span>

<i class="fa fa-heart"></i>

0

</span>



<span>

<i class="fa fa-bookmark"></i>

</span>



</div>


</div>


<?php } ?>


</div>








<!-- RIGHT SIDEBAR -->


<div class="forum-right">


<div class="forum-box">


<h4>

Forum Stats

</h4>



<p>

Topics

<strong>

<?php

echo mysqli_num_rows(
mysqli_query($conn,"
SELECT *
FROM forumtopic
")
);

?>

</strong>

</p>



<p>

Replies

<strong>

<?php

echo mysqli_num_rows(
mysqli_query($conn,"
SELECT *
FROM forumreply
")
);

?>

</strong>


</p>



<p>

Members

<strong>

<?php

echo mysqli_num_rows(
mysqli_query($conn,"
SELECT *
FROM student
")
);

?>

</strong>


</p>


</div>



<div class="forum-box">


<h4>
Trending
</h4>


<p>
🔥 Best Milo Price
</p>

<p>
🔥 Cheap Rice
</p>

<p>
🔥 Instant Noodles
</p>


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

    <script>
        function slideCategory(direction){

            const container = document.querySelector(".category-container");
            container.scrollLeft += direction * 350;

        }
    </script>

  </body>
</html>