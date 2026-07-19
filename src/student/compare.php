
<?php
session_start();
include ("../config/db_cPCS.php");

if (isset($_POST['compare']) && count($_POST['compare']) > 0) {
    $compareID = $_POST['compare'];
    $ids = implode(",", array_map('intval', $compareID));

    global $conn;
    $sql = "SELECT * FROM item WHERE ItemID IN ($ids)";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
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
            <link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
            <link href="../../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

            <!-- Customized Bootstrap Stylesheet -->
            <link href="../../css/bootstrap.min.css" rel="stylesheet">

            <!-- Template Stylesheet -->
            <link href="../../css/style.css" rel="stylesheet">

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
            $sql = "SELECT * FROM student WHERE logStatus = 1;";
            $result_student = mysqli_query($conn, $sql);

            if ($result_student->num_rows > 0) {
                $row_student = $result_student->fetch_assoc();
                $username = $row_student["username"];
                $img = $row_student['studentIMG'];
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
                                        <li class="scroll-to-section"><a href="../student/Student.php" class="active">Filter & Compare </a></li>
                                        <li class="scroll-to-section"><a href="../student/dashboard.php">Search </a></li>
                                        <li class="scroll-to-section"><a href="../student/dashboard.php">About us</a></li>

                                        <form method="post">
                                            <div class="icons">
                                                <div class="dropdown">
                                                    <img src="<?php echo $img; ?>" width="40" height="40" class="rounded-circle">
                                                    <div class="dropdown-content">
                                                        <a href="profileStudent.php">My Profile</a>
                                                        <a href="logoutStudent.php" name="logout">Log Out</a>
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
                <!-- ***** Header Area End ***** -->
            </div>

            <br><br><br>

                    <div class="comparison-container">

                        <h2>
                            Compare <em>Selected Items</em>
                        </h2>

                        <p>
                            Review product details and choose the best option based on price and store.
                        </p>

                        <div class="row justify-content-center">

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="compare-item-card">
                                    <img src="<?php echo $row['ItemImage']; ?>"
                                    class="compare-image">

                                    <h4>
                                        <?php echo $row['ItemName']; ?>
                                    </h4>

                                    <div class="price">
                                        RM <?php echo number_format($row['ItemPrice'],2); ?>
                                    </div>

                                    <div class="compare-info">
                                        <p>
                                            <strong>Category:</strong>
                                            <?php echo $row['ItemCategory']; ?>
                                        </p>

                                        <p>
                                            <strong>Store:</strong>
                                            <?php echo $row['StoreName']; ?>
                                        </p>

                                        <p>
                                            <strong>Description:</strong>
                                            <br>
                                        <?php echo $row['ItemDescription']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <?php
                            }
                            ?>

                        </div>

                        <a href="../student/filter.php" class="custom-btn">
                            Back to Filter & Compare
                        </a>

                    </div>
                    
                    <center>
                

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
                                Home | Filter & Compare | Search | Why Us
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
<?php
    } else {
        echo 'No items selected for comparison.';
    }
} else {
    echo 'Please select at least one item to compare.';
}
?>
