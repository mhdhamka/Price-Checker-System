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
COMPARE PAGE STATISTICS
========================================================== */

$totalItems = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM item
"))['total'];

$totalStore = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM store
"))['total'];

$lowestPrice = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT MIN(ItemPrice) lowestPrice
FROM item
"))['lowestPrice'];


/* ==========================================================
SEARCH VARIABLES
========================================================== */

$search   = $_GET['search'] ?? "";
$category = $_GET['category'] ?? "";
$store    = $_GET['store'] ?? "";
$sort     = $_GET['sort'] ?? "latest";


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

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
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/filterStudent.css">
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


    <!-- ***** Search Starts ***** -->
    <section class="section bg-light" id="search">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="section-heading">
                        <a href="../student/dashboard.php" class="custom-btn">
                            Back to Dashboard
                        </a>

                        <br><br>

                        <h2>
                            Find The <em>Best Price</em>
                        </h2>

                        <img src="../../assets/images/line-dec.png" alt="">

                        <p>
                            Search products, select items, and compare prices from available stores.
                        </p>

                    </div>

                    <div class="row">

                        <div class="col-lg-4 col-md-4">

                            <div class="dashboard-card">

                                <i class="fa fa-cubes"></i>

                                <h3>

                                    <?php echo $totalItems; ?>

                                </h3>

                                <span>

                                    Total Products

                                </span>

                            </div>

                        </div>

                        <div class="col-lg-4 col-md-4">

                            <div class="dashboard-card">

                                <i class="fa fa-building"></i>

                                <h3>

                                    <?php echo $totalStore; ?>

                                </h3>

                                <span>

                                    Total Stores

                                </span>

                            </div>

                        </div>

                        <div class="col-lg-4 col-md-4">

                            <div class="dashboard-card">

                                <i class="fa fa-money"></i>

                                <h3>

                                    <?php echo $lowestPrice; ?>

                                </h3>

                                <span>

                                    Lowest Price

                                </span>

                            </div>

                        </div>

                    </div>

                    <br>


                    <!-- Search Card -->
                    <div class="compare-card">

                        <!-- Search Form -->
                        <form method="get" onsubmit="return validateSearch()">

                            <div class="search-toolbar">

                                <div class="search-input">

                                    <i class="fa fa-search"></i>

                                    <input type="text" id="searchtextbox" name="search"
                                    placeholder="Search product...">

                                    <!-- Search Suggestions -->
                                    <div id="compareSuggestion"></div>

                                </div>

                                <select name="category">

                                    <option value="">All Categories</option>

                                        <?php

                                        $categoryQuery=mysqli_query($conn,"
                                        SELECT DISTINCT ItemCategory
                                        FROM item
                                        ORDER BY ItemCategory
                                        ");

                                        while($cat=mysqli_fetch_assoc($categoryQuery))
                                        {

                                        ?>

                                    <option value="<?php echo $cat['ItemCategory']; ?>"

                                        <?php

                                        if($category == $cat['ItemCategory'])
                                        {
                                            echo "selected";
                                        }

                                        ?>

                                        >

                                        <?php echo $cat['ItemCategory']; ?>

                                    </option>


                                        <?php

                                        }

                                        ?>

                                </select>

                                <select name="store">

                                    <option value="">All Stores</option>

                                        <?php

                                        $storeQuery=mysqli_query($conn,"
                                        SELECT DISTINCT StoreName
                                        FROM item
                                        ORDER BY StoreName
                                        ");


                                        while($st=mysqli_fetch_assoc($storeQuery))
                                        {

                                        ?>

                                    <option value="<?php echo $st['StoreName']; ?>"

                                        <?php

                                        if($store == $st['StoreName'])
                                        {
                                            echo "selected";
                                        }

                                        ?>

                                        >

                                        <?php echo $st['StoreName']; ?>

                                    </option>


                                        <?php

                                        }

                                        ?>

                                </select>

                                <select name="sort">

                                    <option value="">

                                        Sort

                                    </option>

                                    <option value="lowest">

                                        Lowest Price

                                    </option>

                                    <option value="highest">

                                        Highest Price

                                    </option>

                                    <option value="rating">

                                        Highest Rating

                                    </option>

                                    <option value="reviews">

                                        Most Reviewed

                                    </option>

                                    <option value="newest">

                                        Newest

                                    </option>

                                    </select>


                                <button type="submit">
                                    Search
                                </button>

                            </div>

                            </form>

                            <div class="compare-sticky">

                                <div>

                                    Selected

                                    <span id="selectedCount">

                                        0

                                    </span>

                                    /3 Products

                                </div>

                                <button id="compareNow" type="submit" class="compare-btn">

                                    Compare Now

                                </button>

                            </div>

                                <br>

                                <h6 style="text-align:left;">
                                    Select 2 or 3 items to compare prices between different stores.
                                </h6>

                                <br>

                                <!-- Item Cards -->
                                <form method="post" 
                                action="../student/compare.php" 
                                onsubmit="return validateCompare()">

                                <div class="row">


                                <?php

                                /* ===========================================
                                SEARCH / FILTER VARIABLES
                                =========================================== */

                                $search   = isset($_GET['search']) ? trim($_GET['search']) : "";
                                $category = isset($_GET['category']) ? $_GET['category'] : "";
                                $store    = isset($_GET['store']) ? $_GET['store'] : "";
                                $sort     = isset($_GET['sort']) ? $_GET['sort'] : "latest";

                                $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $limit = 6;
                                $offset = ($page-1)*$limit;


                                /* ===========================================
                                COUNT FOR PAGINATION
                                =========================================== */

                                $countSql="

                                SELECT COUNT(*) total

                                FROM item

                                WHERE 1

                                ";

                                if($search!="")
                                {
                                    $search=mysqli_real_escape_string($conn,$search);

                                    $countSql.="

                                    AND
                                    (
                                        ItemName LIKE '%$search%'
                                        OR ItemCategory LIKE '%$search%'
                                        OR StoreName LIKE '%$search%'
                                    )

                                    ";
                                }

                                if($category!="")
                                {
                                    $countSql.="

                                    AND ItemCategory='$category'

                                    ";
                                }

                                if($store!="")
                                {
                                    $countSql.="

                                    AND StoreName='$store'

                                    ";
                                }

                                $countResult=mysqli_query($conn,$countSql);

                                $totalRows=mysqli_fetch_assoc($countResult)['total'];

                                $totalPages=ceil($totalRows/$limit);


                                /* ===========================================
                                MAIN PRODUCT QUERY
                                =========================================== */

                                $sql="

                                SELECT

                                item.*,

                                COALESCE(ROUND(AVG(r.rating),1),0) averageRating,

                                COUNT(r.ratingID) totalReviews

                                FROM item

                                LEFT JOIN ratings r

                                ON item.ItemID=r.ItemID

                                WHERE 1

                                ";


                                if($search!="")
                                {

                                    $sql.="

                                    AND
                                    (
                                        ItemName LIKE '%$search%'
                                        OR ItemCategory LIKE '%$search%'
                                        OR StoreName LIKE '%$search%'
                                    )

                                    ";

                                }


                                if($category!="")
                                {

                                    $sql.="

                                    AND ItemCategory='$category'

                                    ";

                                }


                                if($store!="")
                                {

                                    $sql.="

                                    AND StoreName='$store'

                                    ";

                                }


                                /* GROUP */

                                $sql.="

                                GROUP BY item.ItemID

                                ";


                                /* SORT */

                                switch($sort)
                                {

                                    case "lowest":

                                        $sql.="

                                        ORDER BY ItemPrice ASC

                                        ";

                                        break;

                                    case "highest":

                                        $sql.="

                                        ORDER BY ItemPrice DESC

                                        ";

                                        break;

                                    case "rating":

                                        $sql.="

                                        ORDER BY averageRating DESC

                                        ";

                                        break;

                                    case "reviews":

                                        $sql.="

                                        ORDER BY totalReviews DESC

                                        ";

                                        break;

                                    default:

                                        $sql.="

                                        ORDER BY ItemID ASC

                                        ";

                                }


                                /* PAGINATION */

                                $sql.="

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

                                        <!-- Card Header -->
                                        <div class="card-top">

                                            <label class="compare-check">

                                                <input type="checkbox" name="compare[]"
                                                value="<?php echo $row['ItemID']; ?>">

                                            </label>

                                            <i 
                                                class="wishlist fa <?php echo in_array($row['ItemID'], $wishlistItems) ? 'fa-heart active' : 'fa-heart-o'; ?>"
                                                data-id="<?php echo $row['ItemID']; ?>">
                                            </i>

                                        </div>


                                        <!-- Product Image -->
                                        <div class="item-image-box">

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

                                                <?php

                                                echo ($row['averageRating'])
                                                ? number_format($row['averageRating'],1)
                                                : "0.0";

                                                ?>

                                            </div>

                                            <div class="rating-review">


                                                <?php

                                                if($row['totalReviews'] > 0)

                                                {

                                                ?>

                                                    <?php echo $row['totalReviews']; ?> Reviews

                                                <?php

                                                }

                                                else

                                                {

                                                ?>

                                                    No Reviews

                                                <?php

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

                                        <span class="price">

                                            RM <?php echo number_format($row['ItemPrice'],2); ?>

                                        </span>


                                        <!-- Badge -->

                                        <?php

                                        if($row['ItemPrice']==$lowestPrice)
                                        {

                                        ?>

                                            <div class="badge best-price">

                                                Lowest Price

                                            </div>

                                        <?php

                                        }

                                        elseif($row['averageRating'] >= 4.5)

                                        {

                                        ?>

                                            <div class="badge top-rated">

                                                Top Rated

                                            </div>

                                        <?php

                                        }

                                        elseif($row['totalReviews'] >= 10)

                                        {

                                        ?>

                                            <div class="badge popular">

                                                Popular

                                            </div>

                                        <?php

                                        }

                                        ?>

                                         <?php

                                            if($row['averageRating']>=4.5)
                                            {
                                                echo "<div class='badge best'>Top Rated</div>";
                                            }
                                            elseif($row['totalReviews']>=15)
                                            {
                                                echo "<div class='badge popular'>Popular</div>";
                                            }
                                            elseif($row['ItemPrice']<=5)
                                            {
                                                echo "<div class='badge deal'>Budget Pick</div>";
                                            }
                                            else
                                            {
                                                echo "<div class='badge'>Recommended</div>";
                                            }

                                        ?>

                                    </div>

                                </div>

                                <?php
                                }

                                }
                                else
                                {

                                    echo "

                                    <div class='col-12'>
                                        <h5>No item found</h5>
                                    </div>

                                    ";

                                }


                                ?>

                                </div>

                                <button 
                                type="submit" 
                                class="btn btn-primary compare-btn"
                                name="compare_submit">

                                    Compare Items

                                </button>

                            </form>


                         <?php

                            $queryString = http_build_query([
                                "search"   => $search,
                                "store"    => $store,
                                "category" => $category,
                                "sort"     => $sort,
                            ]);

                        ?>

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
    <section class="section recent">
        <div class="container">

            <div class="section-heading">
                <h2>Recently <em>Compare</em></h2>
                <img src="../../assets/images/line-dec.png">
                <p>
                    Review your previous comparisons and quickly compare products again.
                </p>
            </div>

            <div class="row">

                <div class="recent-section">

                    <div class="row">

                        <?php

                        while($history=mysqli_fetch_assoc($recentCompared))
                        {

                        ?>

                        <div class="col-lg-3">

                            <div class="recent-card">

                                <i class="fa fa-history"></i>

                                    <h5>

                                    Comparison

                                    </h5>

                                    <p>

                                    <?php echo htmlspecialchars($history['Items'] ?? 'No comparison data'); ?>

                                    Products

                                    </p>

                                    <small>

                                    <?php

                                    echo date(
                                    "d M Y H:i",
                                    strtotime($history['created_at'])
                                    );

                                    ?>

                                    </small>

                                    <br><br>

                                    <a href="../student/compare.php?group=<?php echo $history['comparedGroup']; ?>" class="btn btn-sm btn-warning">

                                        Compare Again

                                    </a>

                                </div>

                            </div>

                            <?php

                            }

                            ?>

                        </div>

                    </div>


                </div>

            </div>
    </section>

    <!-- ***** Compare Suggestion ***** -->
    <section class="compare suggestion">

        <div class="container">

            <div class="section-heading">

                <h2>
                    Compare <em>Suggestions</em>
                </h2>

                <img src="../../assets/images/line-dec.png">

                <p>
                    Discover recommended products based on your comparison activity.
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
                                    Search for similar product
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
    

    <!-- ***** How Compare Work ***** -->
    <section class="section how-it-work">
        <div class="container">

            <div class="section-heading">
                <h2>How Compare <em>Works</em></h2>
                <img src="../../assets/images/line-dec.png">
                <p>
                    Follow four simple steps to find the best price.
                </p>
            </div>

            <div class="row">

                <div class="col-lg-4">
                    <div class="process-card">

                        <div class="step-number">
                            1
                        </div>

                        <h4>Compare products in the same category</h4>

                        <p>
                            Find products by item name, category, or store.
                        </p>

                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="process-card">

                        <div class="step-number">
                            2
                        </div>

                        <h4>Compare prices from multiple stores</h4>

                        <p>
                            Select products and compare prices between stores.
                        </p>

                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="process-card">

                        <div class="step-number">
                            3
                        </div>

                        <h4>Ratings help identify better quality</h4>

                        <p>
                            Choose affordable products that fit your budget.
                        </p>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="process-card">

                        <div class="step-number">
                            4
                        </div>

                        <h4>Select up to 3 products</h4>

                        <p>
                            Choose affordable products that fit your budget.
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

    <!-- Global Init -->
    <script src="../../assets/js/custom.js"></script>
    <script src="../../assets/js/filterStudent.js"></script>
    <script src="../../assets/js/studentTheme.js"></script>

</body>
</html>
