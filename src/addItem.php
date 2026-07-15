<!---TMF 4935: Final Year Project--->
<!---Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->

<?php
session_start();
include "dbConnect_PCS.php";

if (isset($_POST['submit'])) {
    global $conn;
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $desc = $_POST['desc'];
    $storename = $_POST['storename'];

    // Validate price format
    if (!preg_match('/^\d+(\.\d{1,2})?$/', $price)) {
        die("Invalid price format. Please enter a valid price.");
    }

    // Retrieve the latest ItemID
    $sql_latest_id = "SELECT MAX(ItemID) AS max_id FROM item";
    $result = mysqli_query($conn, $sql_latest_id);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $latest_id = $row['max_id'];
    $new_id = $latest_id + 1;

    // File upload handling
    $targetDir = "assets/images/";
    $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $image = $targetFilePath;

            // Use prepared statements to prevent SQL injection
            $sql = $conn->prepare("INSERT INTO item (ItemID, ItemName, ItemPrice, ItemCategory, ItemDescription, StoreName, ItemImage) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $sql->bind_param("issssss", $new_id, $name, $price, $category, $desc, $storename, $image);

            if ($sql->execute()) {
                $_SESSION['message'] = "Item added successfully!";
                header('location: indexAdmin.php');
                exit;
            } else {
                echo "Error: " . $sql->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
    }
}
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
        .container {
          position: relative;
          width: 100%;
        }

        .image {
          display: block;
          width: 100%;
          height: auto;
        }

        .overlay {
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          height: 100%;
          width: 100%;
          opacity: 0;
          transition: .5s ease;
          background-color: grey;
        }

        .container:hover .overlay {
          opacity: 0.5;
        }

        .text {
          color: white;
          font-size: 20px;
          position: absolute;
          top: 50%;
          left: 50%;
          -webkit-transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
          text-align: center;
        }
    </style>
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
            
            if ($result -> num_rows > 0)
            {
                while ($row = $result -> fetch_assoc())
                {
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
                        <h6 class="mb-0">
                            <span class="d-none d-lg-inline-flex">
                                <?php echo $username ?>
                            </span></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="adminProfile.php" class="nav-item nav-link"><i class="fa fa-user-cog me-2"></i>My Profile</a>
                    <a href="indexAdmin.php" class="nav-item nav-link active"><i class="fa fa-shop me-2"></i>Manage Item</a>
                    <a href="filterAdmin.php" class="nav-item nav-link"><i class="fa fa-filter me-2"></i>Filter & Compare</a>
                    <a href="searchAdmin.php" class="nav-item nav-link"><i class="fa fa-search me-2"></i>Search Item</a>
                    <a href="store.php?editID=1" class="nav-item nav-link"><i class="fa fa-store me-2"></i>Store</a>
                    <a href="category.php?editID=1" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Category</a>
                    <a href="aboutus.php?editID=1" class="nav-item nav-link"><i class="fa fa-user me-2"></i>About Us</a>
                    <a href="logoutAdmin.php" class="nav-item nav-link"><i class="fa fa-sign-out me-2"></i>Log Out</a>
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
                            <span class="d-none d-lg-inline-flex">
                                <?php echo $username ?>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="adminProfile.php" class="dropdown-item">My Profile</a>
                            <a href="logoutAdmin.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

           <!-- Form Start -->
           <div class="container-fluid pt-4 px-4">
            <div class="center">
            <div class="col-sm-12 col-xl-6">
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Add Item</h6>
                    <form method="POST" action="addItem.php" enctype="multipart/form-data">
                        <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="eg: Coffee, Crackers, and Maggi" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="eg: RM 19.99"  required>
                            </div>
                        </div>
                        <div class="row mb-3">
                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                            <select class="form-select mb-3" id="category" name="category">
                            <!-- PHP code to fetch categories -->
                            <?php
                                $sql_category = "SELECT * FROM category";
                                $result_category = mysqli_query($conn, $sql_category);
                                if ($result_category->num_rows > 0) {
                                    while ($row_category = $result_category->fetch_assoc()) {
                                    echo "<option value='" . $row_category['categoryName'] . "'>" . $row_category['categoryName'] . "</option>";
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <label for="desc" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="A detailed explanation or summary that provides essential information about its purpose, objectives, scope, and key components." required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                          <label for="storename" class="col-sm-2 col-form-label">Store Name</label>
                           <div class="col-sm-10">
                                <select class="form-select mb-3" id="storename" name="storename">
                                <!-- PHP code to fetch store names -->
                                <?php
                                $sql_store = "SELECT * FROM store";
                                $result_store = mysqli_query($conn, $sql_store);
                                if ($result_store->num_rows > 0) {
                                    while ($row_store = $result_store->fetch_assoc()) {
                                    echo "<option value='" . $row_store['StoreName'] . "'>" . $row_store['StoreName'] . "</option>";
                                 }
                                 }
                                 ?>
                                 </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="image" name="image" required>
                            </div>
                        </div>
                           <br>
                           <center>
                                <button type="button" class="btn btn-primary" style="background-color: white;"><a href="indexAdmin.php">Cancel</a></button>
                                <button type="submit" class="btn btn-primary" name="submit">Add</button>
                           </center>
                           </form>
                      </div>
                    </div>
                </div>
            </div>
            <!-- Form End -->

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
    <script src="https://kit.fontawesome.com/626fa0fc8f.js" crossorigin="anonymous"></script>
</body>
</html>
