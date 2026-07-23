
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
SEARCH PAGE STATISTICS
========================================================== */

/* Total Products */

$totalItems = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM item
"))['total'];


/* Highest Rated Product */

$highestRated = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT
item.ItemName,
ROUND(AVG(ratings.rating),1) averageRating

FROM item

LEFT JOIN ratings
ON item.ItemID = ratings.ItemID

GROUP BY item.ItemID

ORDER BY averageRating DESC

LIMIT 1
"));


/* Lowest Rated Product */

$lowestRated = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT
item.ItemName,
ROUND(AVG(ratings.rating),1) averageRating

FROM item

LEFT JOIN ratings
ON item.ItemID = ratings.ItemID

GROUP BY item.ItemID

HAVING COUNT(ratings.ratingID) > 0

ORDER BY averageRating ASC

LIMIT 1
"));


/* ==========================================
SEARCH VARIABLES
========================================== */

$search   = $_GET['search'] ?? "";

$category = $_GET['category'] ?? "";

$store    = $_GET['store'] ?? "";

$sort     = $_GET['sort'] ?? "";

$star     = $_GET['star'] ?? "";


/* ==========================================================
PAGINATION
========================================================== */

$limit = 6;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$offset = ($page - 1) * $limit;

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
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/searchStudent.css">
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


    /* ==========================================================
    SEARCH PAGE STATISTICS
    ========================================================== */

    /* Total Products */

    $totalItems = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total
    FROM item
    "))['total'];


    /* Highest Rated Product */

    $highestRated = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT
    item.ItemName,
    ROUND(AVG(ratings.rating),1) averageRating

    FROM item

    LEFT JOIN ratings
    ON item.ItemID = ratings.ItemID

    GROUP BY item.ItemID

    HAVING COUNT(ratings.ratingID) > 0

    ORDER BY averageRating DESC

    LIMIT 1
    "));


    /* Lowest Rated Product */

    $lowestRated = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT
    item.ItemName,
    ROUND(AVG(ratings.rating),1) averageRating

    FROM item

    LEFT JOIN ratings
    ON item.ItemID = ratings.ItemID

    GROUP BY item.ItemID

    HAVING COUNT(ratings.ratingID) > 0

    ORDER BY averageRating ASC

    LIMIT 1
    "));
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
                            <li class="scroll-to-section"><a href="#search" class="active">Products</a></li>
                            <li class="scroll-to-section"><a href="#tools">Tools</a></li>
                            <li class="scroll-to-section"><a href="#trend">Trending</a></li>
                            <li class="scroll-to-section"><a href="#community">Community</a></li>
                            <li class="scroll-to-section"><a href="#why-us">About</a></li>

                            <form method="post">
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
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>


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

                        <span class="section-subtitle">

                            Smart Product Search

                        </span>

                        <h2>

                            Discover the Best <em>Products</em>

                        </h2>

                        <img src="../../assets/images/line-dec.png">

                        <p>
                             Search products, compare prices across stores, view community ratings, and make smarter shopping decisions.
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

                                <i class="fa fa-star"></i>

                                <h3>

                                    <?php echo number_format($highestRated['averageRating'],1); ?>

                                    ★

                                </h3>

                                <span>

                                    <?php echo $highestRated['ItemName']; ?>

                                </span>

                            </div>

                        </div>



                        <div class="col-lg-4 col-md-4">

                            <div class="dashboard-card">

                                <i class="fa fa-arrow-down"></i>

                                <h3>

                                    <?php echo number_format($lowestRated['averageRating'],1); ?>

                                    ★

                                </h3>

                                <span>

                                    <?php echo $lowestRated['ItemName']; ?>

                                </span>

                            </div>

                        </div>

                    </div>

                    <br>

                    <!-- Search Card -->
                    <div class="search-card">

                        <!-- Search Form -->
                        <form method="GET">

                            <div class="search-toolbar">

                                <div class="search-input">

                                    <i class="fa fa-search"></i>

                                    <input
                                        type="text"
                                        name="search"
                                        placeholder="Search product..."
                                        value="<?php echo $_GET['search'] ?? ""; ?>">

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

                                    <option value="">Newest</option>

                                    <option value="priceLow" <?php if($sort=="priceLow") echo "selected"; ?>>
                                        Lowest Price
                                    </option>

                                    <option value="priceHigh" <?php if($sort=="priceHigh") echo "selected"; ?>>
                                        Highest Price
                                    </option>

                                    <option value="rating" <?php if($sort=="rating") echo "selected"; ?>>
                                        Highest Rating
                                    </option>

                                    <option value="name" <?php if($sort=="name") echo "selected"; ?>>
                                        A-Z
                                    </option>

                                </select>


                                <button>

                                    Search

                                </button>

                            </div>

                            </form>


                        <br>


                        <?php

                        $sql = "

                            SELECT

                            item.*,

                            IFNULL(AVG(ratings.rating),0) AS averageRating,

                            COUNT(ratings.ratingID) AS totalRating

                            FROM item

                            LEFT JOIN ratings
                            ON item.ItemID = ratings.ItemID

                            WHERE 1

                            ";


                            /* SEARCH */

                            if($search != "")
                            {

                                $search = mysqli_real_escape_string($conn,$search);

                                $sql .= "

                                AND
                                (
                                    item.ItemName LIKE '%$search%'
                                    OR item.ItemCategory LIKE '%$search%'
                                    OR item.StoreName LIKE '%$search%'
                                )

                                ";

                            }


                            /* CATEGORY */

                            if($category != "")
                            {

                                $category = mysqli_real_escape_string($conn,$category);

                                $sql .= "

                                AND item.ItemCategory = '$category'

                                ";

                            }


                            /* STORE */

                            if($store != "")
                            {

                                $store = mysqli_real_escape_string($conn,$store);

                                $sql .= "

                                AND item.StoreName = '$store'

                                ";

                            }


                            /* GROUP */

                            $sql .= "

                            GROUP BY item.ItemID

                            ";


                            /* SORT */

                            switch($sort)
                            {

                                case "priceLow":

                                    $sql .= "

                                    ORDER BY item.ItemPrice ASC

                                    ";

                                    break;

                                case "priceHigh":

                                    $sql .= "

                                    ORDER BY item.ItemPrice DESC

                                    ";

                                    break;

                                case "rating":

                                    $sql .= "

                                    ORDER BY averageRating DESC

                                    ";

                                    break;

                                case "name":

                                    $sql .= "

                                    ORDER BY item.ItemName ASC

                                    ";

                                    break;

                                default:

                                    $sql .= "

                                    ORDER BY averageRating DESC,
                                    totalRating DESC,
                                    item.ItemName ASC

                                    ";

                            }


                            /* COUNT */

                            $countSql = $sql;

                            $countResult = mysqli_query($conn,$countSql);

                            $totalRows = mysqli_num_rows($countResult);

                            $totalPages = ceil($totalRows / $limit);


                            /* PAGINATION */

                            $sql .= "

                            LIMIT $offset,$limit

                            ";


                            /* FINAL QUERY */
                            $result = mysqli_query($conn,$sql);

                        if($result && mysqli_num_rows($result) > 0)
                        {


                        ?>

                        <h5 class="mb-4">

                            <?php echo mysqli_num_rows($result); ?> 
                            Items Found

                        </h5>

                        <div class="row">

                        <?php

                        while($row = mysqli_fetch_assoc($result))
                        {

                        ?>


                            <div class="col-lg-4 col-md-6 mb-4">

                                <div class="product-card">

                                    <div class="product-image">

                                        <img src="<?php echo $row['ItemImage'];?>">

                                    </div>

                                    <div class="product-content">

                                        <h4>

                                            <?php echo $row['ItemName'];?>

                                        </h4>

                                        <span class="category">

                                            <?php echo $row['ItemCategory'];?>

                                        </span>


                                        <div class="rating-summary">

                                            <span class="stars">

                                                ★★★★★

                                            </span>

                                            <strong>

                                                <?php echo number_format($row['averageRating'],1);?>

                                            </strong>

                                        </div>


                                        <h3>

                                            RM <?php echo number_format($row['ItemPrice'],2);?>

                                        </h3>

                                        <p>

                                            <i class="fa fa-shopping-cart"></i>

                                            <?php echo $row['StoreName'];?>

                                        </p>

                                        <p class="description">

                                            <?php echo $row['ItemDescription'];?>

                                        </p>

                                        <div class="product-actions">

                                            <a href="../student/filter.php" class="compare-link">

                                                Compare

                                            </a>

                                            <button 
                                                type="button"
                                                class="rate-btn"
                                                data-id="<?php echo $row['ItemID']; ?>"
                                                data-name="<?php echo htmlspecialchars($row['ItemName']); ?>">

                                                <i class="fa fa-star"></i>

                                                Rate

                                            </button>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        <?php

                        }

                        ?>


                        </div>



                        <?php

                        }

                        else
                        {

                        ?>


                        <div class="no-result">

                            <h5>
                                No Item Found
                            </h5>

                            <p>
                                Try searching another item, category, or store.
                            </p>

                        </div>


                        <?php

                        }

                        ?>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php

        $queryString = http_build_query([
            "search"   => $search,
            "store"    => $store,
            "category" => $category,
            "star"     => $star,
            "sort"     => $sort
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

    <br>


    <!-- Rating Modal -->
    <div id="ratingModal" class="student-modal">

        <div class="student-modal-content">

            <button class="close-modal">
                &times;
            </button>


            <div class="rating-box">

                <h2 id="ratingTitle">
                    Rate this Product
                </h2>

                <input type="hidden" id="itemID">


                <div class="star-rating">

                    <i class="fa fa-star" data-rate="1"></i>

                    <i class="fa fa-star" data-rate="2"></i>

                    <i class="fa fa-star" data-rate="3"></i>

                    <i class="fa fa-star" data-rate="4"></i>

                    <i class="fa fa-star" data-rate="5"></i>

                </div>


                <textarea id="comment"></textarea>


                <div class="rating-actions">

                    <button class="cancel-btn">
                        Cancel
                    </button>

                    <button class="submit-rating">
                        Submit Rating
                    </button>

                </div>


                <div class="reviews-container">

                    <h4>
                        Customer Reviews
                    </h4>

                <div id="reviews"></div>

            </div>
        
        </div>


        </div>

    </div>

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
    <script src="../../assets/js/searchStudent.js"></script>

</body>

</html>

