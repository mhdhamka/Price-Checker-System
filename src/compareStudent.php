<!---TMF 4935: Final Year Project--->
<!---Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->

<?php
session_start();
include "dbConnect_PCS.php";

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
            <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
            <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

            <!-- Customized Bootstrap Stylesheet -->
            <link href="css/bootstrap.min.css" rel="stylesheet">

            <!-- Template Stylesheet -->
            <link href="css/style.css" rel="stylesheet">

            <!-- Additional CSS Files -->
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
            <link rel="stylesheet" href="assets/css/styleindex.css">
            <link rel="icon" href="assets/images/logo.png" type="image/x-icon">

            <!-- Custom Styles -->
            <style>
                .custom-btn {
                    display: inline-block;
                    margin-bottom: 20px;
                    padding: 10px 10px;
                    border: 2px solid #ff0000;
                    background-color: #ffffff;
                    color: #ff0000;
                    border-radius: 10px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                    transition: background-color 0.3s, color 0.3s;
                }

                .custom-btn:hover {
                    background-color: #ff0000;
                    color: #ffffff;
                }

                .container-fluid {
                    background-color: #F5F3F6;
                    padding: 20px; /* Adjust the padding */
                    max-width: 80%; /* Adjust the maximum width */
                    margin: 0 auto; /* Center the container */
                }

                .comparison-table {
                    display: flex;
                    justify-content: space-between;
                    flex-wrap: wrap;
                }

                .comparison-item {
                    width: 48%;
                    margin-bottom: 20px;
                    background-color: #ffffff;
                    border: 1px solid #dee2e6;
                    border-radius: 5px;
                    padding: 10px;
                }

                .comparison-item img {
                    max-width: 100%;
                    height: auto;
                }

                .comparison-item table {
                    width: 100%;
                    margin-bottom: 0;
                }

                .comparison-item table th {
                    background-color: #f8f9fa;
                    color: #212529;
                }
            </style>
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
                                    <a href="indexStudent.php" class="logo"><img src="assets/images/logo.png" width="90" height="90"></a>
                                    <!-- ***** Logo End ***** -->

                                    <!-- ***** Menu Start ***** -->
                                    <ul class="nav">
                                        <li class="scroll-to-section"><a href="indexStudent.php">Home</a></li>
                                        <li class="scroll-to-section"><a href="filterStudent.php" class="active">Filter & Compare </a></li>
                                        <li class="scroll-to-section"><a href="indexStudent.php">Search </a></li>
                                        <li class="scroll-to-section"><a href="indexStudent.php">About us</a></li>

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
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="comparison-table">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <div class="comparison-item">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-white">
                                            <th scope="col" colspan="2">Item ID: <?php echo $row['ItemID']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Item Name</th>
                                            <td><?php echo $row['ItemName']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Price</th>
                                            <td><?php echo $row['ItemPrice']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Category</th>
                                            <td><?php echo $row['ItemCategory']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Description</th>
                                            <td><?php echo $row['ItemDescription']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Store Name</th>
                                            <td><?php echo $row['StoreName']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Image</th>
                                            <td><img src="<?php echo $row['ItemImage']; ?>" style="max-width: 30%; height: auto;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <br>
                    <center>
                    <a href="filterStudent.php" class="custom-btn" style="margin-bottom: 20px;">Return to Filter & Compare</a><br><br>
                </div>
            </div>

            <!-- ***** Footer Start ***** -->
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; 2024 Price Checker System - Distributed by Faculty of Computer Science & Information Technology (FCSIT), UNIMAS</p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- ***** Footer End ***** -->

            <!-- jQuery -->
            <script src="assets/js/jquery-2.1.0.min.js"></script>

            <!-- Bootstrap -->
            <script src="assets/js/popper.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>

            <!-- Plugins -->
            <script src="assets/js/scrollreveal.min.js"></script>
            <script src="assets/js/waypoints.min.js"></script>
            <script src="assets/js/jquery.counterup.min.js"></script>
            <script src="assets/js/imgfix.min.js"></script>
            <script src="assets/js/mixitup.js"></script>
            <script src="assets/js/accordions.js"></script>

            <!-- Global Init -->
            <script src="assets/js/custom.js"></script>
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
