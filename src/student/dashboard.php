<?php 

session_start();
include ("../config/db_cPCS.php");

// Check if user is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: ../public/loginStudent.php"); 
    exit();
}

$studentID = $_SESSION['studentID'];

/* Dashboard Statistics */
// Count Items
$totalItems =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total FROM item"
)
)['total'];


// Count Stores
$totalStore =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total FROM store"
)
)['total'];

// Count Categories
$totalCategory =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total FROM category"
)
)['total'];

$averageRating = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT ROUND(AVG(rating),2) avgRate
FROM ratings
"))['avgRate'];


/* TOP RATED PRODUCTS */

$topRated = mysqli_query($conn, "

SELECT

item.ItemID,
item.ItemName,
item.ItemImage,
item.ItemPrice,
item.ItemCategory,
item.StoreName,

ROUND(AVG(r.rating),1) AS averageRating,

COUNT(r.ratingID) AS totalReviews

FROM item item

LEFT JOIN ratings r
ON item.ItemID = r.ItemID

GROUP BY item.ItemID

HAVING totalReviews > 0

ORDER BY averageRating DESC,
totalReviews DESC

LIMIT 6

");


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

COUNT(r.replyID) totalReplies
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
    <link rel="stylesheet" href="../../assets/css/styleStudent.css">
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
    
    <?php include("../student/includes/header.php"); ?>
    

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="../../assets/images/preview/groceryshop.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h2>Smart Shopping with</h2>
                <h2><em>PRICE CHECKER SYSTEM</em></h2>
                <p>Compare prices, discover affordable choices, and manage your budget easily.</p>
                <br><br><br>
                <h6>
                </h6>
                </div>
            </div>
        </div>
    </div>
  

    <!-- ***** Filter & Compare Start ***** -->
    <section class="section" id="compare">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">

                        <span class="section-subtitle">

                            Compare Prices

                        </span>

                        <h2>

                            Find the <em>Best Deal</em>

                        </h2>

                        <img src="../../assets/images/line-dec.png">

                        <p style="color:#000000;">
                            Compare item prices from different stores and find the best option within your budget.
                        </p>

                    </div>
                </div>
            </div>

            <!-- Hot Deals -->
            <div class="row mb-5">

                <div class="col-lg-10 offset-lg-1">

                    <h3 class="text-center mb-4">
                        <em>Hot Deals</em>
                    </h3>


                    <div class="row">

                    <?php

                    $sql = "SELECT * FROM item ORDER BY ItemPrice ASC LIMIT 3";

                    $result = mysqli_query($conn,$sql);


                    while($row = $result->fetch_assoc()){

                        echo "

                        <div class='col-lg-4 col-md-6 mb-4'>

                            <div class='deal-card'>

                                <img src='".$row['ItemImage']."'>

                                <div class='deal-content'>

                                    <h4>".$row['ItemName']."</h4>

                                    <span class='price'>
                                        RM ".$row['ItemPrice']."
                                    </span>

                                    <p>
                                        ".$row['StoreName']."
                                    </p>
                                </div>
                            </div>
                        </div>

                        ";

                    }

                    ?>


                    </div>
                </div>
            </div>

            <!-- Preview Table -->
            <div class="row">

                <div class="col-lg-10 offset-lg-1">


                <h3 class="text-center mb-4">
                    Item Preview
                </h3>

                <div class="table-responsive">

                <table class="preview-table">

                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Category</th>
                            <th>Store</th>
                            <th>Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $sql = "SELECT * FROM item LIMIT 5";

                        $result = mysqli_query($conn,$sql);


                        while($row=$result->fetch_assoc()){


                            echo "

                            <tr>

                                <td class='item-name'>
                                    <img src='".$row['ItemImage']."'>
                                    <span>".$row['ItemName']."</span>
                                </td>

                                <td>".$row['ItemCategory']."</td>


                                <td>".$row['StoreName']."</td>

                                <td>
                                    RM ".$row['ItemPrice']."
                                </td>

                            </tr>

                            ";

                        }


                        ?>


                    </tbody>


                </table>

                </div>

                <br>


                <div class="main-button">

                    <center>
                    <a href="../student/filter.php">
                        Filter & Compare
                    </a>
                    </center>

                </div>

                </div>
            </div>
        </div>

    </section>
    


    <!-- ***** Search Preview Starts ***** -->
    <section class="section search-preview-section" id="search">

        <div class="container">

            <div class="section-heading">

                <h2>
                    Discover <em>Products</em>
                </h2>

                <img src="../../assets/images/line-dec.png">

                <p>
                    Search products, compare prices across stores, and discover trusted community ratings.
                </p>

            </div>

            <!-- Search Preview Box -->
            <div class="search-preview-box">

                <div class="preview-search">

                    <i class="fa fa-search"></i>

                    <span>
                        Search products, brands, or stores...
                    </span>

                </div>

                <div class="search-feature-list">

                    <div class="feature-item">

                        <i class="fa fa-filter"></i>

                        <span>
                            Filter Products
                        </span>

                    </div>

                    <div class="feature-item">

                        <i class="fa fa-random"></i>

                        <span>
                            Compare Prices
                        </span>

                    </div>

                    <div class="feature-item">

                        <i class="fa fa-star"></i>

                        <span>
                            View Ratings
                        </span>

                    </div>

                </div>

            </div>


            <!-- Statistics -->
            <div class="searchpreview-stats">

                <div class="searchpreview-card">

                    <i class="fa fa-cubes"></i>

                    <h3>
                        <?php echo $totalItems; ?>
                    </h3>

                    <p>
                        Products
                    </p>

                </div>


                <div class="searchpreview-card">

                    <i class="fa fa-building"></i>

                    <h3>
                        <?php echo $totalStore; ?>
                    </h3>

                    <p>
                        Stores
                    </p>

                </div>


                <div class="searchpreview-card">

                    <i class="fa fa-tags"></i>

                    <h3>
                        <?php echo $totalCategory; ?>
                    </h3>

                    <p>
                        Categories
                    </p>

                </div>

                <div class="searchpreview-card">

                    <i class="fa fa-star"></i>

                    <h3>
                        <?php echo number_format($averageRating,1); ?>
                        ★
                    </h3>

                    <p>
                        Community Ratings
                    </p>

                </div>

            </div>


            <div class="main-button">

                <center>

                    <a href="../student/search.php">

                        Explore Products

                    </a>

                </center>

            </div>

        </div>

    </section>


    <!-- ***** Quick Access Starts ***** -->
    <section class="section quick-access-section" id="tools">

        <div class="container">

            <div class="section-heading">

                <h2>
                    Quick <em>Access</em>
                </h2>

                <img src="../../assets/images/line-dec.png">

                <p>
                    Easily access shopping tools and manage your shopping experience.
                </p>

            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6">

                    <div class="quick-card">

                        <i class="fa fa-search"></i>

                        <h4>
                            Search Products
                        </h4>

                        <p>
                            Find products, stores, and prices quickly.
                        </p>


                        <a href="../student/search.php">
                            Explore
                        </a>


                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="quick-card">

                        <i class="fa fa-exchange"></i>

                        <h4>
                            Compare Prices
                        </h4>

                        <p>
                            Compare prices from different stores.
                        </p>


                        <a href="../student/filter.php">
                            Compare
                        </a>


                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="quick-card">

                        <i class="fa fa-heart"></i>

                        <h4>
                            My Wishlist
                        </h4>

                        <p>
                            Save products you want to check later.
                        </p>


                        <a href="../student/wishlist.php">
                            View Wishlist
                        </a>


                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ***** Trending Products ***** -->
    <section class="section favourites-section" id="trend">

        <div class="container">

            <div class="section-heading">

                <h2>
                    Trending <em>Products</em>
                </h2>

                <img src="../../assets/images/line-dec.png">

                <p>
                    Products highly recommended by students based on ratings and reviews.
                </p>

            </div>


            <div class="row">

                <?php while($item=mysqli_fetch_assoc($topRated)){ ?>

                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="favourite-product">

                            <div class="favourite-img">

                                <img src="<?php echo $item['ItemImage']; ?>">

                                <span class="badge-top">

                                    Top Rated

                                </span>

                            </div>


                            <div class="favourite-info">

                                <h4>

                                <?php echo $item['ItemName']; ?>

                                </h4>


                                <div class="meta">

                                    <span>

                                        <i class="fa fa-tags"></i>

                                        <?php echo $item['ItemCategory']; ?>

                                    </span>

                                    <span>

                                        <i class="fa fa-shopping-cart"></i>

                                        <?php echo $item['StoreName']; ?>

                                    </span>

                                </div>

                                <h3>

                                    RM <?php echo number_format($item['ItemPrice'],2); ?>

                                </h3>


                                <div class="rating-row">

                                    <div class="stars">

                                        ★★★★★

                                    </div>

                                <div>

                                <strong>

                                    <?php echo $item['averageRating']; ?>

                                </strong>

                                <span>

                                    (<?php echo $item['totalReviews']; ?> reviews)

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <?php } ?>

        </div>

        </div>

    </section>


    <!-- ***** Student Community ***** -->
   <section class="section community-section" id="community">

        <div class="container">

            <div class="section-heading">

                <h2>

                    Student <em>Community</em>

                </h2>

                <img src="../../assets/images/line-dec.png">

                <p>

                Ask questions, share shopping tips and help fellow students.

                </p>

            </div>


            <div class="community-wrapper">

                <?php while($post=mysqli_fetch_assoc($communityPosts)){ ?>

                    <div class="community-card">

                        <div class="community-left">

                            <div class="community-icon">

                                <i class="fa fa-comments"></i>

                            </div>

                        </div>


                        <div class="community-body">

                            <div class="community-top">

                                <?php

                                if($post['isPinned']==1){

                                echo "<span class='pin-badge'>Pinned</span>";

                                }

                                ?>

                                <span class="category-badge">

                                <?php echo $post['categoryName']; ?>

                                </span>

                            </div>

                            <h4>

                                <?php echo $post['topicTitle']; ?>

                            </h4>

                            <p>

                                By

                                <strong>

                                    <?php echo $post['fullName']; ?>

                                </strong>

                            </p>


                            <div class="community-meta">

                                <span>

                                    <i class="fa fa-eye"></i>

                                    <?php echo $post['views']; ?>

                                </span>

                                <span>

                                    <i class="fa fa-reply"></i>

                                    <?php echo $post['totalReplies']; ?>

                                    Replies

                                </span>

                                <span>

                                    <i class="fa fa-clock-o"></i>

                                    <?php echo date("d M Y",strtotime($post['created_at'])); ?>

                                    </span>

                            </div>

                        </div>

                    </div>

                        <?php } ?>


                    <div class="text-center mt-5">

                        <a href="../student/forum.php"

                        class="community-btn">

                            Visit Community Forum

                        </a>

                    </div>

                </div>

            </div>

    </section>


    <!-- ***** Why Us Starts ***** -->
    <section class="section" id="why-us">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 offset-lg-3">

                    <div class="section-heading">

                    <h2>Why <em>Use Us</em></h2>

                    <img src="../../assets/images/line-dec.png">

                    <p>
                    Price Checker System helps students manage their spending by providing easy price comparison and affordable shopping choices.
                    </p>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">

                    <div class="why-card">

                        <i class="fa fa-search"></i>

                        <h4>Easy Price Search</h4>

                        <p>
                        Quickly search available items and discover prices from different stores.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="why-card">

                        <i class="fa fa-bar-chart"></i>

                        <h4>Smart Comparison</h4>

                        <p>
                        Compare item prices and select the best option based on your budget.
                        </p>


                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="why-card">
                        <i class="fa fa-money"></i>

                        <h4>Budget Friendly</h4>

                        <p>
                        Find affordable products and make smarter purchasing decisions.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <br>

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