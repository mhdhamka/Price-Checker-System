<?php

session_start();
include("../config/db_cPCS.php");

// Check if user is logged in
if(!isset($_SESSION['studentID']))
{
    header("Location: ../public/loginStudent.php");
    exit();
}

$studentID = $_SESSION['studentID'];


/* ==========================================
SAVE COMPARISON HISTORY
========================================== */

if(isset($_POST['compare']) && count($_POST['compare']) >= 2)
{

    $compareGroup = uniqid("CMP");

    foreach($_POST['compare'] as $itemID)
    {

        $itemID=(int)$itemID;

        mysqli_query($conn,"

        INSERT INTO comparisonhistory

        (

            studentID,

            ItemID,

            comparedGroup

        )

        VALUES

        (

            '$studentID',

            '$itemID',

            '$compareGroup'

        )

        ");


        /* =====================================
        UPDATE COMPARISON STATS
        ===================================== */

        $exist=mysqli_query($conn,"

            SELECT *

            FROM comparisonstats

            WHERE ItemID='$itemID'

        ");

        if(mysqli_num_rows($exist)>0)
        {

            mysqli_query($conn,"

            UPDATE comparisonstats

            SET

            totalCompared=totalCompared+1,

            lastCompared=NOW()

            WHERE ItemID='$itemID'

            ");

        }
        else
        {

            mysqli_query($conn,"

            INSERT INTO comparisonstats

            (

                ItemID,

                totalCompared,

                lastCompared

            )

            VALUES

            (

            '$itemID',

            1,

            NOW()

            )

            ");

        }

    }


    /* ==========================================
    LOAD PRODUCTS TO COMPARE
    ========================================== */

    $ids = implode(",",array_map('intval',$_POST['compare']));

    $lowestPrice = mysqli_fetch_assoc(

    mysqli_query($conn,"

    SELECT MIN(ItemPrice) lowestPrice

    FROM item

    WHERE ItemID IN ($ids)

    ")

    )['lowestPrice'];

    $sql="

    SELECT item.*,

    COALESCE(cs.totalCompared,0) totalCompared,
    cs.lastCompared,

    COALESCE(ROUND(AVG(r.rating),1),0) averageRating,
    COUNT(r.ratingID) totalReviews

    FROM item

    LEFT JOIN comparisonstats cs
    ON item.ItemID=cs.ItemID

    LEFT JOIN ratings r
    ON item.ItemID=r.ItemID

    WHERE item.ItemID IN ($ids)
    GROUP BY item.ItemID

    ";

    $productResult = mysqli_query($conn,$sql);

}
else
{

    header("Location: ../student/filter.php");
    exit();

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
            <link rel="stylesheet" href="../../assets/css/compareStudent.css">
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

            $userSql = "
            SELECT username, studentIMG
            FROM student
            WHERE studentID = '$studentID'
            ";

            $userResult = mysqli_query($conn, $userSql);

            if(mysqli_num_rows($userResult) > 0)
            {
                $user = mysqli_fetch_assoc($userResult);

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

            <br><br><br>

            <section class="section bg-light" id="compare">

                <div class="comparison-container">

                    <h2>
                        Compare <em>Selected Items</em>
                    </h2>

                    <p>
                        Compare prices, ratings, popularity, and product information to find the best value.
                    </p>

                    <br>

                    <div class="row justify-content-center">

                        <?php
                        while($row=mysqli_fetch_assoc($productResult))
                        {
                        ?>

                        <div class="col-lg-4 col-md-6 mb-4">

                            <div class="compare-item-card">

                                <!-- Badge -->

                                <?php

                                if($row['ItemPrice']==$lowestPrice)
                                {

                                ?>

                                    <div class="compare-badge best-price">

                                        <i class="fa fa-check-circle"></i>

                                        Best Price

                                    </div>

                                <?php

                                }
                                elseif($row['averageRating']>=4.5)
                                {

                                ?>

                                    <div class="compare-badge top-rated">

                                        <i class="fa fa-star"></i>

                                        Top Rated

                                    </div>

                                <?php

                                }
                                elseif(($row['totalCompared'] ?? 0)>=10)
                                {

                                ?>

                                    <div class="compare-badge popular">

                                        <i class="fa fa-fire"></i>

                                        Popular Choice

                                    </div>

                                <?php

                                }

                                ?>


                                <!-- Image -->
                                <div class="compare-image-box">

                                    <img
                                    src="<?php echo $row['ItemImage']; ?>"
                                    class="compare-image"
                                    alt="<?php echo $row['ItemName']; ?>">

                                </div>


                                <!-- Name -->
                                <h4>

                                    <?php echo $row['ItemName']; ?>

                                </h4>


                                <!-- Rating -->

                                <div class="rating-box">

                                    <div class="rating-score">

                                        <i class="fa fa-star"></i>

                                        <?php

                                        echo ($row['averageRating'] > 0)
                                            ? number_format($row['averageRating'],1)
                                            : "0.0";

                                        ?>

                                    </div>

                                    <div class="rating-review">

                                        <?php

                                        if($row['totalReviews'] > 0)
                                        {

                                            echo $row['totalReviews'];

                                        }
                                        else
                                        {

                                            echo "No";

                                        }

                                        ?>

                                        Reviews

                                    </div>

                                </div>


                                <!-- Price -->

                                <div class="price">

                                    RM <?php echo number_format($row['ItemPrice'],2); ?>

                                </div>


                                <!-- Comparison Statistics -->
                                <div class="compare-stats">

                                    <div class="stat-card">

                                        <div class="stat-icon">

                                            <i class="fa fa-random"></i>

                                        </div>

                                        <div class="stat-content">

                                            <small>

                                                Compared

                                            </small>

                                            <h5>

                                                <?php echo $row['totalCompared'] ?? 0; ?>

                                            </h5>

                                            <span>

                                                Times

                                            </span>

                                        </div>

                                    </div>


                                    <div class="stat-card">

                                        <div class="stat-icon">

                                            <i class="fa fa-clock-o"></i>

                                        </div>

                                        <div class="stat-content">

                                            <small>

                                                Last Compared

                                            </small>

                                            <h6>

                                                <?php

                                                if(!empty($row['lastCompared']))
                                                {

                                                    echo date(
                                                    "d M Y",
                                                    strtotime($row['lastCompared'])
                                                    );

                                                }
                                                else
                                                {

                                                    echo "Never";

                                                }

                                                ?>

                                            </h6>

                                        </div>

                                    </div>

                                </div>


                                <!-- Product Information -->

                                <div class="compare-info">

                                    <div class="compare-row">

                                        <span class="compare-title">

                                            <i class="fa fa-tags"></i>

                                            Category

                                        </span>

                                        <span class="compare-value">

                                            <?php echo $row['ItemCategory']; ?>

                                        </span>

                                    </div>

                                    <div class="compare-row">

                                        <span class="compare-title">

                                            <i class="fa fa-shopping-cart"></i>

                                            Store

                                        </span>

                                        <span class="compare-value">

                                            <?php echo $row['StoreName']; ?>

                                        </span>

                                    </div>

                                    <div class="compare-description">

                                        <h6>

                                            <i class="fa fa-align-left"></i>

                                            Description

                                        </h6>

                                        <p>

                                            <?php echo $row['ItemDescription']; ?>

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php
                        }
                        ?>

                    </div>

                    <a href="../student/filter.php" class="custom-btn">

                        <i class="fa fa-arrow-left"></i>

                        Back to Compare

                    </a>

                </div>

            <section>
                                        
            <center>
                

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
            <script src="../../assets/js/studentTheme.js"></script>
            <script src="../../assets/js/header.js"></script>
            <script>
                // Ensure form submission with Enter key works
                document.getElementById("searchtextbox").addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        document.getElementById("search-btn").click();
                    }
                });
            </script>

            <script>
                document.querySelector('.custom-btn').style.marginRight = 'auto';
            </script>
        </body>

        </html>

