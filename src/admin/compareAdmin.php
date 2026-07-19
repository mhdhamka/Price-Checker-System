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
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Price Checker System Admin Dashboard</title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta content="" name="keywords">
            <meta content="" name="description">
            <link rel="icon" href="assets/images/logo.png" type="image/x-icon">

            <link href="img/favicon.ico" rel="icon">
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
            <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
            <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
            <link href="css/bootstrap.min.css" rel="stylesheet">
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
                .comparison-table {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 20px;
                }
                .comparison-table .table-responsive {
                    max-height: 500px;
                    overflow-y: auto;
                }
            </style>
        </head>
        <body>

        <div class="container-fluid position-relative d-flex p-0">
            <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>';

        $adminSql = "SELECT * FROM admin WHERE logStatus = 1;";
        $adminResult = mysqli_query($conn, $adminSql);

        if ($adminResult && mysqli_num_rows($adminResult) > 0) {
            $admin = mysqli_fetch_assoc($adminResult);
            $username = $admin["adminUsername"];
            $img = $admin['adminIMG'];
        }

        echo '<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="indexAdmin.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="' . $img . '" alt="" style="width: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">
                            <span class="d-none d-lg-inline-flex">' . $username . '</span>
                        </h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="adminProfile.php" class="nav-item nav-link"><i class="fa fa-user-cog me-2"></i>My Profile</a>
                    <a href="indexAdmin.php" class="nav-item nav-link"><i class="fa fa-shop me-2"></i>Manage Item</a>
                    <a href="filterAdmin.php" class="nav-item nav-link active"><i class="fa fa-filter me-2"></i>Filter & Compare</a>
                    <a href="searchAdmin.php" class="nav-item nav-link"><i class="fa fa-search me-2"></i>Search Item</a>
                    <a href="store.php?editID=1" class="nav-item nav-link"><i class="fa fa-store me-2"></i>Store</a>
                    <a href="category.php?editID=1" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Category</a>
                    <a href="aboutus.php?editID=1" class="nav-item nav-link"><i class="fa fa-user me-2"></i>About Us</a>
                    <a href="logoutAdmin.php" class="nav-item nav-link"><i class="fa fa-sign-out me-2"></i> Log Out</a>
                </div>
            </nav>
        </div>
        <div class="content">
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
                            <img class="rounded-circle me-lg-2" src="' . $img . '" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">' . $username . '</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="adminProfile.php" class="dropdown-item">My Profile</a>
                            <a href="logoutAdmin.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h6 class="mb-4">Item Comparison</h6>
                    <div class="comparison-table">';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-white">
                                            <th scope="col" colspan="2">Item ID: ' . $row['ItemID'] . '</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Item Name</th>
                                            <td>' . $row['ItemName'] . '</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Price</th>
                                            <td>' . $row['ItemPrice'] . '</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Category</th>
                                            <td>' . $row['ItemCategory'] . '</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Description</th>
                                            <td>' . $row['ItemDescription'] . '</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Store Name</th>
                                            <td>' . $row['StoreName'] . '</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Item Image</th>
                                            <td><img src="' . $row['ItemImage'] . '" style="width: 75%"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>';
                        }
                    echo '</div>
                    <br>
                    <center><button type="button" style="background-color: white; color: #ed563b;" class="btn btn-primary"><a href="filterAdmin.php">Return to Filter & Compare</a></button>
                </div>
                
            </div>
           <!-- Footer Start -->
           <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">2024 Price Checker System</a>, All Right Reserved. 
                    </div>
                </div>
            </div>
            </div>
            <!-- Footer End -->

        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <script src="js/main.js"></script>


        </body>
        </html>';
    } else {
        echo 'No items selected for comparison.';
    }
} else {
    echo 'Please select at least one item to compare.';
}
?>
