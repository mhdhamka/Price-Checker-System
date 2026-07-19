
<?php session_start(); ?>
<?php include ("../config/db_cPCS.php"); ?>

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
    $sql = "SELECT * FROM student WHERE logStatus = 1;";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $username = $row["username"];
            $img = $row['studentIMG'];
        }
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
                            <li class="scroll-to-section"><a href="../student/dashboard.php">Home</a></li>
                            <li class="scroll-to-section"><a href="../student/dashboard.php">Filter & Compare </a></li>
                            <li class="scroll-to-section"><a href="../student/searchStudent.php" class="active">Search </a></li>
                            <li class="scroll-to-section"><a href="../student/dashboard.php">About us</a></li>

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
                            Return to Home
                        </a>

                        <br><br>

                        <h2>
                            Search <em>Items</em>
                        </h2>

                        <img src="../../assets/images/line-dec.png">

                        <p>
                            Find products, check prices, and discover affordable choices.
                        </p>

                    </div>

                    <!-- Search Card -->
                    <div class="search-card">

                        <!-- Search Form -->
                        <form method="post" onsubmit="return validateSearch()">

                            <div class="search-box">

                                <input 
                                type="text"
                                id="searchtextbox"
                                name="search"
                                placeholder="Search item name, category or store..."
                                value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">


                                <button type="submit">

                                    <i class="fa fa-search"></i>
                                    Search

                                </button>

                            </div>

                        </form>


                        <br>


                        <?php

                        $sql = "SELECT * FROM item";


                        if(isset($_POST['search']) && !empty($_POST['search']))
                        {

                            $search = mysqli_real_escape_string($conn,$_POST['search']);


                            $sql .= " WHERE 
                            ItemName LIKE '%$search%'
                            OR ItemCategory LIKE '%$search%'
                            OR StoreName LIKE '%$search%'";

                        }


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
                                        <img src="<?php echo $row['ItemImage']; ?>">
                                    </div>

                                    <div class="product-content">

                                        <h4>
                                            <?php echo $row['ItemName']; ?>
                                        </h4>

                                        <span class="category">
                                            <?php echo $row['ItemCategory']; ?>
                                        </span>

                                        <h3>

                                            RM <?php echo $row['ItemPrice']; ?>

                                        </h3>

                                        <p>
                                            <i class="fa fa-shopping-cart"></i>

                                            <?php echo $row['StoreName']; ?>
                                        </p>

                                        <p class="description">

                                            <?php echo $row['ItemDescription']; ?>

                                        </p>

                                        <a href="../student/filter.php" class="compare-link">
                                            Compare Price
                                        </a>

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
                        <a href="dashboard.php">
                            Home
                        </a>
                        |
                        <a href="filter.php">
                            Filter & Compare
                        </a>
                        |
                        <a href="search.php">
                            Search
                        </a>
                        |
                        <a href="dashboard.php#why-us">
                            Why Us
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

    <!-- Global Init -->
    <script src="../../assets/js/custom.js"></script>
    <script src="../../assets/js/searchStudent.js"></script>

</body>

</html>

