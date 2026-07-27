<?php 

session_start(); 
include ("../config/db_cPCS.php"); 

// Check if user is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: ../public/loginStudent.php"); 
    exit();
}

$studentID = $_SESSION['studentID'];

/* ==========================================================
WISHLIST STATISTICS
========================================================== */

$totalWishlists = mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM wishlist

WHERE studentID='$studentID'

"))['total'];


$averageRating = mysqli_fetch_assoc(mysqli_query($conn,"

SELECT

ROUND(AVG(r.rating),1) averageRating

FROM wishlist w

JOIN ratings r

ON w.ItemID=r.ItemID

WHERE w.studentID='$studentID'

"))['averageRating'] ?? 0;


$lowestPrice = mysqli_fetch_assoc(mysqli_query($conn,"

SELECT

MIN(i.ItemPrice) lowestPrice

FROM wishlist w

JOIN item i

ON w.ItemID=i.ItemID

WHERE w.studentID='$studentID'

"))['lowestPrice'];


/* ==========================================================
WISHLIST
========================================================== */

$wishlistItems = [];

$wishlist = mysqli_query($conn,"
SELECT ItemID
FROM wishlist
WHERE studentID='$studentID'
");

while($row=mysqli_fetch_assoc($wishlist))
{
    $wishlistItems[] = $row['ItemID'];
}

/* ==========================================================
PAGINATION
========================================================== */

$limit = 6;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1)
{
    $page = 1;
}

$offset = ($page-1) * $limit;


/* ==========================================================
RECENTLY COMPARED
========================================================== */

$recentCompared = mysqli_query($conn,"

SELECT

c.comparedGroup,

GROUP_CONCAT(i.ItemName SEPARATOR ', ') Items,

MAX(c.created_at) created_at

FROM comparisonhistory c

JOIN item i

ON c.ItemID=i.ItemID

WHERE c.studentID='$studentID'

GROUP BY c.comparedGroup

ORDER BY created_at DESC

LIMIT 4;

");


/* ==========================================
MOST COMPARED CATEGORY
========================================== */

$favoriteCategory = "";

$categoryHistory = mysqli_query($conn,"

SELECT

i.ItemCategory,
COUNT(*) total

FROM comparisonhistory c

INNER JOIN item i

ON c.ItemID=i.ItemID

WHERE c.studentID='$studentID'

GROUP BY i.ItemCategory

ORDER BY total DESC

LIMIT 1

");

if(mysqli_num_rows($categoryHistory)>0)
{
    $favoriteCategory = mysqli_fetch_assoc($categoryHistory)['ItemCategory'];
}

/* ==========================================
COMPARE SUGGESTIONS
========================================== */

if($favoriteCategory!="")
{

$suggestion=mysqli_query($conn,"

SELECT

item.*,

COALESCE(ROUND(AVG(r.rating),1),0) averageRating,

COUNT(r.ratingID) totalReviews

FROM item

LEFT JOIN ratings r

ON item.ItemID=r.ItemID

WHERE ItemCategory='$favoriteCategory'

GROUP BY item.ItemID

ORDER BY RAND()

LIMIT 6

");

}
else
{

$suggestion=mysqli_query($conn,"

SELECT
item.*,

COALESCE(ROUND(AVG(r.rating),1),0) averageRating,
COUNT(r.ratingID) totalReviews

FROM item

LEFT JOIN ratings r
ON item.ItemID=r.ItemID

GROUP BY item.ItemID
ORDER BY RAND()

LIMIT 6

");

}

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

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/wishlistStudent.css">
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
    <!-- ***** Preloader End ***** -->


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

    <!-- ***** Wishlist Starts ***** -->
    <section class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="section-heading">
                        <a href="../student/dashboard.php" class="custom-btn">
                            Back to Dashboard
                        </a>

                        <br><br>

                        <h2>
                            My <em>Wishlist</em>
                        </h2>

                        <img src="../../assets/images/line-dec.png" alt="">

                        <p>
                            Save your favourite products and compare them later.
                        </p>

                    </div>

                    <div class="row">

                        <div class="col-lg-4 col-md-4">

                            <div class="dashboard-card">

                                <i class="fa fa-cubes"></i>

                                <h3>

                                    <?php echo $totalWishlists; ?>

                                </h3>

                                <span>

                                    Saved Items

                                </span>

                            </div>

                        </div>

                        <div class="col-lg-4 col-md-4">

                            <div class="dashboard-card">

                                <i class="fa fa-star"></i>

                                <h3>

                                    <?php echo number_format($averageRating,1); ?>

                                    ★

                                </h3>

                                <span>

                                    Average Rating

                                </span>

                            </div>

                        </div>

                        <div class="col-lg-4 col-md-4">

                            <div class="dashboard-card">

                                <i class="fa fa-money"></i>

                                <h3>

                                    RM <?php echo number_format($lowestPrice,2); ?>

                                </h3>

                                <span>

                                    Lowest Saved Price

                                </span>

                            </div>

                        </div>

                    </div>

                    <br>


                    <!-- Search Card -->
                    <div class="compare-card">

                        <!-- Search Form -->
                        <form method="get" onsubmit="return validateSearch()">

                            </form>

                                <!-- Item Cards -->
                                <form method="post" 
                                action="../student/compare.php" 
                                onsubmit="return validateCompare()">

                                <div class="row">


                                <?php


                                /* ===========================================
                                COUNT FOR PAGINATION
                                =========================================== */

                                $countSql="

                                    SELECT COUNT(*) total

                                    FROM wishlist

                                    WHERE studentID='$studentID'

                                ";

                                $countResult = mysqli_query($conn,$countSql);

                                $totalRows = mysqli_fetch_assoc($countResult)['total'];

                                $totalPages = ceil($totalRows/$limit);


                                /* ===========================================
                                MAIN WISHLIST QUERY
                                =========================================== */

                                $sql="

                                SELECT

                                wishlist.wishlistID,

                                wishlist.created_at,

                                item.*,

                                COALESCE(ROUND(AVG(r.rating),1),0) AS averageRating,

                                COUNT(r.ratingID) AS totalReviews

                                FROM wishlist

                                INNER JOIN item

                                ON wishlist.ItemID=item.ItemID

                                LEFT JOIN ratings r

                                ON item.ItemID=r.ItemID

                                WHERE wishlist.studentID='$studentID'

                                GROUP BY item.ItemID

                                ORDER BY wishlist.created_at ASC

                                LIMIT $offset,$limit

                                ";


                                $result=mysqli_query($conn,$sql);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    {

                                ?>

                                <div class="col-lg-4 col-md-6 mb-4">

                                    <div class="item-card">

                                        <!-- Product Image -->
                                        <div class="item-image-box">

                                            <?php

                                                if($row['averageRating'] >= 4.5)
                                                {

                                                    echo "<div class='badge top-rated'>Top Rated</div>";

                                                }
                                                elseif($row['totalReviews'] >= 15)
                                                {

                                                    echo "<div class='badge popular'>Popular Choice</div>";

                                                }
                                                elseif($row['ItemPrice'] == $lowestPrice)
                                                {

                                                    echo "<div class='badge best-price'>Lowest Price</div>";

                                                }
                                                else
                                                {

                                                    echo "<div class='badge saved'>Saved</div>";

                                                }

                                            ?>

                                            <!-- Wishlist -->

                                            <i 
                                                class="wishlist fa <?php echo in_array($row['ItemID'], $wishlistItems) ? 'fa-heart active' : 'fa-heart-o'; ?>"
                                                data-id="<?php echo $row['ItemID']; ?>">
                                            </i>


                                            <img
                                                src="<?php echo $row['ItemImage']; ?>"
                                                class="item-image"
                                                alt="<?php echo $row['ItemName']; ?>">
                                        
                                        </div>

                                        <!-- Product Name -->

                                        <h4>

                                            <?php echo $row['ItemName']; ?>

                                        </h4>


                                        <!-- Rating -->

                                        <div class="rating-box">

                                            <div class="rating-score">

                                                <i class="fa fa-star"></i>

                                                <?php echo number_format($row['averageRating'],1); ?>

                                            </div>

                                            <div class="rating-review">

                                                <?php

                                                if($row['totalReviews'] > 0)
                                                {

                                                    echo $row['totalReviews']." Reviews";

                                                }
                                                else
                                                {

                                                    echo "No Reviews";

                                                }

                                                ?>

                                            </div>

                                        </div>


                                        <!-- Category -->

                                        <small class="category">

                                            <i class="fa fa-tags"></i>

                                            <?php echo $row['ItemCategory']; ?>

                                        </small>


                                        <!-- Store -->

                                        <p>

                                            <i class="fa fa-shopping-cart"></i>

                                            <?php echo $row['StoreName']; ?>

                                        </p>


                                        <!-- Price -->

                                        <div class="price">

                                            RM <?php echo number_format($row['ItemPrice'],2); ?>

                                        </div>

                                        <div class="wishlist-actions">

                                            <a href="../student/filter.php?highlight=<?php echo $row['ItemID']; ?>"
                                            class="compare-btn">

                                                <i class="fa fa-random"></i>

                                                Compare

                                            </a>

                                            <a href="../student/search.php?item=<?php echo $row['ItemID']; ?>"
                                            class="view-btn">

                                                <i class="fa fa-search"></i>

                                                View

                                            </a>

                                        </div>

                                    </div>

                                </div>

                                <?php
                                }

                                }
                                else
                                {

                                ?>

                                <div class="empty-wishlist">

                                    <i class="fa fa-heart-o"></i>

                                    <h3>
                                        Your wishlist is empty
                                    </h3>

                                    <p>
                                        Start saving products you love.
                                    </p>

                                    <a href="../student/search.php" class="custom-btn">
                                        Browse Products
                                    </a>

                                </div>

                                <?php

                                }


                                ?>

                                </div>

                            </form>

                            <div class="pagination">

                            <!-- Previous -->

                            <?php if($page > 1){ ?>

                                <a href="?page=<?php echo $page-1; ?>&<?php echo $queryString; ?>">

                                    <i class="fa fa-angle-left"></i>

                                </a>

                            <?php } ?>


                            <?php

                            $start = max(1,$page-2);

                            $end = min($totalPages,$page+2);

                            if($start > 1)
                            {

                            ?>

                                <a href="?page=1&<?php echo $queryString; ?>">

                                    1

                                </a>

                                <?php if($start > 2){ ?>

                                    <span class="dots">...</span>

                                <?php } ?>

                            <?php

                            }

                            ?>


                            <?php

                            for($i=$start;$i<=$end;$i++)
                            {

                            ?>

                                <a

                                href="?page=<?php echo $i; ?>&<?php echo $queryString; ?>"

                                class="<?php echo ($page==$i) ? 'active' : ''; ?>">

                                    <?php echo $i; ?>

                                </a>

                            <?php

                            }

                            ?>


                            <?php

                            if($end < $totalPages)
                            {

                                if($end < $totalPages-1)
                                {

                            ?>

                                    <span class="dots">...</span>

                            <?php

                                }

                            ?>

                                <a href="?page=<?php echo $totalPages; ?>&<?php echo $queryString; ?>">

                                    <?php echo $totalPages; ?>

                                </a>

                            <?php

                            }

                            ?>


                            <!-- Next -->

                            <?php if($page < $totalPages){ ?>

                                <a href="?page=<?php echo $page+1; ?>&<?php echo $queryString; ?>">

                                    <i class="fa fa-angle-right"></i>

                                </a>

                            <?php } ?>

                        </div>

                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>


    <!-- ***** Recently Compared ***** -->
    <section class="section wishlist-recent">

        <div class="container">

            <div class="section-heading">

                <h2>Your <em>Comparison History</em></h2>

                <img src="../../assets/images/line-dec.png">

                <p>
                    Quickly revisit products you compared before.
                </p>

            </div>



            <div class="recent-grid">


                <?php

                if(mysqli_num_rows($recentCompared)>0)
                {

                while($history=mysqli_fetch_assoc($recentCompared))

                {

                ?>


                    <div class="recent-compare-card">


                        <div class="recent-icon">

                            <i class="fa fa-random"></i>

                        </div>

                        <div class="recent-info">

                            <h5>
                                Compared Products
                            </h5>

                            <p>

                                <?php 

                                echo htmlspecialchars($history['Items']);

                                ?>

                            </p>


                            <span>

                                <i class="fa fa-clock"></i>

                                <?php

                                echo date(
                                "d M Y",
                                strtotime($history['created_at'])
                                );

                                ?>

                            </span>


                        </div>


                        <a href="../student/compare.php?group=<?php echo $history['comparedGroup']; ?>"
                        class="recent-btn">

                            Compare Again

                        </a>


                    </div>

                    <?php

                    }

                    }

                    else

                    {

                    ?>


                    <div class="empty-history">

                        <i class="fa fa-history"></i>

                        <h4>
                            No comparison history yet
                        </h4>

                        <p>
                            Start comparing products to see them here.
                        </p>


                    </div>


                    <?php

                    }

                    ?>


                </div>
                <br>

            </div>

    </section>


    <!-- ***** Compare Suggestion ***** -->
    <section class="compare suggestion">

        <div class="container">

            <div class="section-heading">

                <h2>
                    Recommended From Your <em>Wishlist</em>
                </h2>

                <img src="../../assets/images/line-dec.png">

                <p>
                    Products you may want to compare based on your shopping interest.
                </p>

            </div>

            <div class="suggestion-section">

                <h3>
                    You May Also Like
                </h3> 
                <br>

                <div class="row">

                    <?php

                    while($item=mysqli_fetch_assoc($suggestion))

                    {

                    ?>


                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="suggestion-card">

                            <div class="suggestion-image">

                                <img 
                                src="<?php echo $item['ItemImage']; ?>"
                                alt="<?php echo $item['ItemName']; ?>">

                            </div>

                            <div class="suggestion-content">

                                <h5>
                                    <?php echo $item['ItemName']; ?>
                                </h5>

                                <p class="suggestion-store">

                                    <i class="fa fa-shopping-cart"></i>

                                    <?php echo $item['StoreName']; ?>

                                </p>

                                <div class="suggestion-price">

                                    RM <?php echo number_format($item['ItemPrice'],2); ?>

                                </div>

                                <a href="../student/search.php?item=<?php echo $item['ItemID']; ?>"
                                class="suggestion-btn">

                                    <i class="fa fa-eye"></i>
                                    View Product
                                </a>

                            </div>

                        </div>

                    </div>

                    <?php

                    }

                    ?>

                </div>

            </div>

        </div>

    </section>


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

    <!-- Global Init -->
    <script src="../../assets/js/custom.js"></script>
    <script src="../../assets/js/filterStudent.js"></script>
    <script src="../../assets/js/studentTheme.js"></script>
    <script src="../../assets/js/header.js"></script>

</body>
</html>
