<!---TMF 4935: Final Year Project--->
<!---Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->

<?php
session_start();
include "dbConnect_PCS.php";

// Sanitize input to avoid SQL injection
function sanitize($data, $conn) {
    return htmlspecialchars(mysqli_real_escape_string($conn, $data));
}

$search = isset($_POST['search']) ? sanitize($_POST['search'], $conn) : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Price Checker System Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">

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

    <style>
    #searchtextbox {
        background-position: 10px 12px;
        background-repeat: no-repeat;
        width: 92%;
        font-size: 15px;
        padding: 10px 10px 10px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }
    </style>

    <script>
        function limitCheckboxes(max) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var checkedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
                    if (checkedCount >= max) {
                        checkboxes.forEach(function(box) {
                            if (!box.checked) {
                                box.disabled = true;
                            }
                        });
                    } else {
                        checkboxes.forEach(function(box) {
                            box.disabled = false;
                        });
                    }
                });
            });
        }

        function validateSearch() {
            const searchInput = document.getElementById('searchtextbox').value.trim();
            if (searchInput === "") {
                alert("Please enter a search term.");
                return false;
            }
            return true;
        }

        function validateCompare() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            if (checkboxes.length < 2 || checkboxes.length > 3) {
                alert("Please select 2 or 3 items to compare.");
                return false;
            }
            return true;
        }

        window.onload = function() {
            limitCheckboxes(3); // Set the limit to 3
        }
    </script>

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <?php
        global $conn;
        $sql = "SELECT * FROM admin WHERE logStatus = 1;";
        $result = mysqli_query($conn, $sql);

        if ($result -> num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
                $username = $row["adminUsername"];
                $img = $row['adminIMG'];
            }
        }
        ?>

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="indexAdmin.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo $img ?>" alt="" style="width: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><span class="d-none d-lg-inline-flex"><?php echo $username ?></span></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <div class="navbar-nav w-100">
                    <a href="adminProfile.php" class="nav-item nav-link"><i class="fa fa-user-cog me-2"></i>My Profile</a>
                    <a href="indexAdmin.php" class="nav-item nav-link"><i class="fa fa-shop me-2"></i>Manage Item</a>
                    <a href="filterAdmin.php" class="nav-item nav-link active"><i class="fa fa-filter me-2"></i>Filter & Compare</a>
                    <a href="searchAdmin.php" class="nav-item nav-link"><i class="fa fa-search me-2"></i>Search Item</a>
                    <a href="store.php?editID=1" class="nav-item nav-link"><i class="fa fa-store me-2"></i>Store</a>
                    <a href="category.php?editID=1" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Category</a>
                    <a href="aboutus.php?editID=1" class="nav-item nav-link"><i class="fa fa-user me-2"></i>About Us</a>
                    <a href="logoutAdmin.php" class="nav-item nav-link"><i class="fa fa-sign-out me-2"></i>Log Out</a>
                </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="indexAdmin.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo $img ?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $username ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="adminProfile.php" class="dropdown-item">My Profile</a>
                            <a href="logoutAdmin.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Filter & Compare Item details Start -->
           <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Filter & Compare Item</h6>
                    </div>
            <div class="table-responsive">
                <form method="post" onsubmit="return validateSearch()">
                    <input type="text" id="searchtextbox" placeholder="Search for Items..." name="search">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                    <p><small><i>Please input only Item ID, Item Name, Item Category or Store Name before clicking the search button, and select only 2 or 3 items before clicking the compare button. The table below shows only the first 5 items available in the database. Please refer to the list of items in the table below the comparison table before searching the item.</i></small></p>
                <form action="compareAdmin.php" method="post" onsubmit="return validateCompare()">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Item Image</th>
                            <th scope="col">Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        global $conn;
                        $search = isset($_POST['search']) ? sanitize($_POST['search'], $conn) : '';
                        $sql = "SELECT * FROM item WHERE ItemID LIKE '%$search%' OR ItemName LIKE '%$search%'OR ItemCategory LIKE '%$search%' OR StoreName LIKE '%$search%' LIMIT 5";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><center>" . $row['ItemID'] . "</td>";
                                echo "<td>" . $row['ItemName'] . "</td>";
                                echo "<td><center>" . $row['ItemCategory'] . "</td>";
                                echo '<td><center><img src="' . $row['ItemImage'] . '" alt="Image" width= "150" height= "150";"></center></td>';
                                echo '<td><center><input type="checkbox" name="compare[]" value="' . $row['ItemID'] . '"></td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No results found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Compare</button>
            </form>
        </div>
    </div>
</div>
<!-- Filter & Compare Item details End -->

            <!-- List of items table start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">List of Items</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">Item ID</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Item Category</th>
                                    <th scope="col">Store Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM item;";
                                $result = mysqli_query($conn, $sql);
                                if ($result -> num_rows > 0) {
                                    while ($row = $result -> fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td><center>" . $row['ItemID'] . "</td>";
                                        echo "<td>" . $row['ItemName'] . "</td>";
                                        echo "<td><center>" . $row['ItemCategory'] . "</td>";
                                        echo "<td><center>" . $row['StoreName'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No results found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- List of items table end -->

        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
