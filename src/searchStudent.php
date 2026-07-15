<!---TMF 4935: Final Year Project--->
<!---Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->

<?php session_start(); ?>
<?php include "dbConnect_PCS.php"; ?>

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
            padding: 10px 20px;
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
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-container input[type="text"] {
            margin-right: 10px;
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
                        <a href="indexStudent.php" class="logo"><img src="assets/images/logo.png" width="90" height="90"></a>
                        <!-- ***** Logo End ***** -->

                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="indexStudent.php">Home</a></li>
                            <li class="scroll-to-section"><a href="indexStudent.php">Filter & Compare </a></li>
                            <li class="scroll-to-section"><a href="searchStudent.php" class="active">Search </a></li>
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

    <!-- ***** Search Starts ***** -->
    <section class="section bg-light" id="search">
        <div class="container-fluid" style="background-color:f5f3f6;">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="section-heading">
                        <a href="indexStudent.php" class="custom-btn" style="margin-bottom: 20px;">Return to Home</a><br><br>
                        <h2>Search <em>Item</em></h2>

                        <!-- Item details Start -->
                        <div class="container-fluid pt-4 px-4">
                            <div class="bg-secondary text-center rounded p-4">
                                <div class="table-responsive">
                                    <form method="post" onsubmit="return validateSearch()">
                                        <div class="search-container">
                                            <input type="text" id="searchtextbox" class="form-control" placeholder="Search for Items..." name="search">
                                            <button type="submit" id="search-btn" class="btn btn-primary" style="background-color: #ED563B; border-color: #ED563B;">Search</button>
                                        </div>
                                    </form>
                                    <br>
                                    <?php
                                    $sql = "SELECT * FROM item";
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $search = isset($_POST['search']) ? $_POST['search'] : '';
                                        if (empty($search)) {
                                            echo '<h6>Please fill in the search field.</h6><br>';
                                        } else {
                                            $sql .= " WHERE ItemID LIKE '%$search%' OR ItemName LIKE '%$search%' OR ItemCategory LIKE '%$search%' OR StoreName LIKE '%$search%'";
                                        }
                                    }
                                    $result = mysqli_query($conn, $sql);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        echo '<table class="table text-start align-middle table-bordered table-hover mb-0 table-striped">
                                                <thead style="background-color: #ffffff;">
                                                    <tr style="background-color: #ffffff; border-color: #000000; color: #000000;">
                                                        <th scope="col" style="border-color: #000000; color: #000000;">Item ID</th>
                                                        <th scope="col" style="border-color: #000000; color: #000000;">Item Name</th>
                                                        <th scope="col" style="border-color: #000000; color: #000000;">Item Price</th>
                                                        <th scope="col" style="border-color: #000000; color: #000000;">Item Category</th>
                                                        <th scope="col" style="border-color: #000000; color: #000000;">Item Description</th>
                                                        <th scope="col" style="border-color: #000000; color: #000000;">Store Name</th>
                                                        <th scope="col" style="border-color: #000000; color: #000000;">Item Image</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr style="background-color: #ffffff; border-color: #000000; color: #000000;">
                                                    <td style="border-color: #000000; color: #000000;"><center>' . $row['ItemID'] . '</td>
                                                    <td style="border-color: #000000; color: #000000;"><center>' . $row['ItemName'] . '</td>
                                                    <td style="border-color: #000000; color

: #000000;"><center>' . $row['ItemPrice'] . '</td>
                                                    <td style="border-color: #000000; color: #000000;"><center>' . $row['ItemCategory'] . '</td>
                                                    <td style="border-color: #000000; color: #000000;">' . $row['ItemDescription'] . '</td>
                                                    <td style="border-color: #000000; color: #000000;">' . $row['StoreName'] . '</td>
                                                    <td style="border-color: #000000; color: #000000;"><center><img src="' . $row['ItemImage'] . '" style="max-width: 100px;" class="img-fluid"></td>
                                                </tr>';
                                        }
                                        echo '</tbody></table>';
                                    } else {
                                        echo '<h6>Data not found</h6>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Item details End -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Search Ends ***** -->

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

        // Validate search form
        function validateSearch() {
            const searchInput = document.getElementById('searchtextbox').value.trim();
            if (searchInput === "") {
                alert("Please enter a search term.");
                return false;
            }
            return true;
        }
    </script>

</body>

</html>
```

In this code, the search button is placed next to the search bar using a flexbox layout. Additionally, the `validateSearch` function is integrated into the form's `onsubmit` attribute to ensure the search field is not empty before submitting the form.
