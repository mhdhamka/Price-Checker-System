
<?php include ("../config/db_cPCS.php");?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>HOME - Price Checker System</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/indexPublic.css">
    <link rel="stylesheet" href="../../assets/css/sliders.css">
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
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="index.php" class="logo">

                            <img src="../../assets/images/logo.png" 
                                width="90" 
                                height="90">
                        </a>

                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">

                            <li>
                                <a href="#top" class="active">

                                    Home

                                </a>
                            </li>

                            <li>
                                <a href="#features">

                                    Features

                                </a>
                            </li>

                            <li>
                                <a href="#store">

                                    Stores

                                </a>
                            </li>

                            <li>
                                <a href="#preview">

                                    Preview

                                </a>
                            </li>

                            <!-- Get Started Button -->
                            <li class="login-dropdown">

                                <a href="loginSelection.php" class="login-btn">

                                    <img src="../../assets/images/icon.png">

                                    <span>
                                        Get Started
                                    </span>

                                </a>

                            </li>

                        </ul>

                        <a class="menu-trigger">

                            <span>
                                Menu
                            </span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

    </header>

   

    <!-- ***** Hero Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="../../assets/images/preview/groceryshop.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>
                    STUDENT BUDGET MANAGEMENT SYSTEM
                </h6>
                <h2>Smart shopping with</h2>
                <h2><em>PRICE CHECKER SYSTEM</em></h2>
                <p>
                    Compare prices, discover affordable products,
                    and make smarter purchasing decisions.
                </p>
                <div class="hero-buttons">

                    <a href="#features" class="outline-btn">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

    </div>
   
    <!-- ***** Features ***** -->
    <section class="section" id="features">

        <div class="container">

            <div class="section-heading">
                <h2>
                    Why Use <em>Price Checker</em>
                </h2>

                <img src="../../assets/images/line-dec.png">

                <p>
                    A simple platform designed to help students compare prices
                    and manage their daily spending.
                </p>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="feature-card">

                        <i class="fa fa-search"></i>

                        <h4>
                            Easy Search
                        </h4>

                        <p>
                            Search products by name, category,
                            or store to quickly find available items.
                        </p>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-card">

                        <i class="fa fa-bar-chart"></i> 

                        <h4>
                            Smart Comparison
                        </h4>

                        <p>
                            Compare prices from different stores
                            and choose the best deal.
                        </p>

                    </div>


                </div>

                <div class="col-lg-4">
                    <div class="feature-card">

                        <i class="fa fa-money"></i>

                        <h4>
                            Student Friendly
                        </h4>

                        <p>
                            Find affordable products suitable
                            for your student budget.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** How it works ***** -->
    <section class="section how-section">
        <div class="container">
            <div class="section-heading">

                <h2>
                    How It <em>Works</em>
                </h2>

                <img src="../../assets/images/line-dec.png">


                <p>
                    Three simple steps to make smarter purchases.
                </p>


            </div>



            <div class="row">
                <div class="col-lg-4">
                    <div class="step-card">
                        <div class="step-number">
                            01
                        </div>


                        <h4>
                            Search Item
                        </h4>


                        <p>
                            Find products available
                            in the system.
                        </p>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="step-card">
                        <div class="step-number">
                            02
                        </div>

                        <h4>
                            Compare Prices
                        </h4>

                        <p>
                            View different prices
                            from available stores.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="step-card">
                        <div class="step-number">
                            03
                        </div>

                        <h4>
                            Choose Best Deal
                        </h4>

                        <p>
                            Select affordable products
                            that match your budget.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!-- ***** Store Start ***** -->
    <section class="section" id="store">
        <div class="container">
            <div class="section-heading">

                <h2>
                    Available <em>Stores</em>
                </h2>

                <img src="../../assets/images/line-dec.png">


                <p>
                    Compare products from trusted stores available in our system.
                </p>

            </div>

            <div class="slider-wrapper">

                <button class="slider-btn prev">
                    <i class="fa fa-chevron-left"></i>
                </button>

                <div class="card-slider" id="storeSlider">

                <?php

                // Get store information
                $storeQuery = "SELECT * FROM store ORDER BY storeID ASC";

                $storeResult = mysqli_query($conn, $storeQuery);


                if($storeResult && mysqli_num_rows($storeResult) > 0)
                {


                    while($store = mysqli_fetch_assoc($storeResult))

                    {

                ?>

                <div class="slider-card">

                    <div class="store-card">

                        <img src="<?php echo $store['storeIMG']; ?>">

                        <div class="store-content">

                            <h4>
                                <?php echo $store['StoreName']; ?>
                            </h4>

                            <p>
                                <?php echo $store['desc1']; ?>
                            </p>

                        </div>
                    </div>
                </div>

            <?php

                }

            }

            else

            {

                echo "

                <div class='text-center w-100'>
                    <h5>
                        No store available.
                    </h5>

                </div>

                ";

            }


            ?>


            </div>

                <button class="slider-btn next">
                    <i class="fa fa-chevron-right"></i>
                </button>

            </div>

        </div>
    </section>



    <!-- ***** Item Preview Start ***** -->
    <section class="section" id="preview">

        <div class="container">

            <div class="section-heading">
                <h2>
                    Popular <em>Items</em>
                </h2>

                <img src="../../assets/images/line-dec.png">

                <p>
                    Some affordable items available in our system.
                </p>
            </div>

            <div class="row">

                <?php

                // Get popular items
                $itemQuery = "SELECT * FROM item ORDER BY ItemPrice ASC LIMIT 6";
                $itemResult = mysqli_query($conn, $itemQuery);

                if($itemResult && mysqli_num_rows($itemResult) > 0)

                {

                while($item = mysqli_fetch_assoc($itemResult))

                {


                ?>


                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="item-card">

                        <img src="<?php echo $item['ItemImage']; ?>">

                        <h4>
                            <?php echo $item['ItemName']; ?>
                        </h4>

                        <h5>
                            RM <?php echo number_format($item['ItemPrice'],2); ?>
                        </h5>

                        <p>
                            <?php echo $item['StoreName']; ?>
                        </p>
                    </div>
                </div>

                <?php

                }


                }

                else

                {


                echo "

                <div class='col-12 text-center'>

                    <h5>
                        No items available.
                    </h5>

                </div>

                ";


                }


                ?>


            </div>

            <br>

            <div class="text-center">
                <a href="loginSelection.php"
                class="main-btn">
                    Register To Compare
                </a>
            </div>

        </div>
    </section>

    <!-- ***** Category Start ***** -->
    <section class="section category-section">

        <div class="container">

            <div class="section-heading">

            <h2>
                Explore <em>Categories</em>
            </h2>

            <img src="../../assets/images/line-dec.png">

            <p>
                Discover products from different categories available in our system.
            </p>

        </div>

        <div class="slider-wrapper">

            <button class="slider-btn prev">
                <i class="fa fa-chevron-left"></i>
            </button>

            <div class="card-slider" id="categorySlider">

                <?php

                // Get categories
                $categoryQuery = "SELECT * FROM category ORDER BY categoryID ASC";

                $categoryResult = mysqli_query($conn, $categoryQuery);

                if($categoryResult && mysqli_num_rows($categoryResult) > 0)

                {

                while($category = mysqli_fetch_assoc($categoryResult))

                {

                ?>

                <div class="slider-card">

                    <div class="category-card">

                        <img src="<?php echo $category['categoryIMG']; ?>">

                        <div class="category-content">
                            <h4>

                                <?php echo $category['categoryName']; ?>

                            </h4>

                            <p>
                                Explore available 
                                <?php echo $category['categoryName']; ?>
                                items.
                            </p>

                        </div>

                    </div>

                </div>

            <?php
            }
                }
                    else
                {

                echo "

                <div class='col-12 text-center'>

                    <h5>
                        No categories available.
                    </h5>

                </div>

                ";


                }

            ?>

        </div>

            <button class="slider-btn next">
                <i class="fa fa-chevron-right"></i>
            </button>

        </div>

        </div>
    </section>
    
    
    <!-- ***** Footer Start ***** -->
    <footer>

        <div class="container">
            <div class="row">
                <div class="col-lg-4">

                <h4>
                    Price Checker System
                </h4>

                <p>
                    Helping students compare prices and make smarter shopping decisions.
                </p>

                </div>

                <div class="col-lg-4">

                    <h4>
                        Quick Links
                    </h4>

                    <p>
                        <a href="#top">
                            Home
                        </a>
                        |
                        <a href="#features">
                            Features
                        </a>
                        |
                        <a href="#store">
                            Stores
                        </a>
                        |
                        <a href="#preview">
                            Preview
                        </a>
                    </p>

                </div>

                <div class="col-lg-4">
                    <h4>
                        Developed By
                    </h4>

                    <p>
                        Mohd Hamka
                    <br>
                        Universiti Malaysia Sarawak (UNIMAS)
                    </p>
                </div>

                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>
                        Copyright &copy; 2024 Price Checker System. All Rights Reserved.
                        </p>
                    </div>
                </div>
        </div>
    </footer>

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

    <script src="../../assets/js/sliders.js"></script>

  </body>
</html>

