<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

// Count Students

$studentCount =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total FROM student"
)
)['total'];



// Count Items

$itemCount =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total FROM item"
)
)['total'];



// Count Stores

$storeCount =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total FROM store"
)
)['total'];



// Count Categories

$categoryCount =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total FROM category"
)
)['total'];



// Count Ratings

$ratingCount =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total FROM ratings"
)
)['total'];

?>


<!DOCTYPE html>

<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Admin Dashboard - Price Checker System
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="../../assets/css/adminDashboard.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

</head>

<body>

    <div class="admin-container">

        <?php include("../admin/includes/sidebar.php"); ?>

        <div class="admin-main">

            <?php include("../admin/includes/header.php"); ?>

                <div class="dashboard-content">

                <h2>
                    Welcome Back!
                </h2>

                <p>
                    Manage your Price Checker System efficiently.
                </p>

                <!-- Cards -->
                <div class="dashboard-cards">

                    <div class="dashboard-card">
                        <i class="fa fa-user-graduate"></i>
                        <h3>
                            <?php echo $studentCount; ?>
                        </h3>

                        <p>
                            Students
                        </p>
                    </div>

                    <div class="dashboard-card">
                        <i class="fa fa-cart-shopping"></i>
                        <h3>
                            <?php echo $itemCount; ?>
                        </h3>

                        <p>
                            Items
                        </p>
                    </div>

                    <div class="dashboard-card">
                        <i class="fa fa-store"></i>

                        <h3>
                            <h3>
                                <?php echo $storeCount; ?>
                            </h3>
                        </h3>

                        <p>
                            Stores
                        </p>
                    </div>

                    <div class="dashboard-card">
                        <i class="fa fa-layer-group"></i>
                        <h3>
                            <?php echo $categoryCount; ?>
                        </h3>

                        <p>
                            Categories
                        </p>
                    </div>

                    <div class="dashboard-card">
                        <i class="fa fa-star"></i>

                        <h3>
                            <?php echo $ratingCount; ?>
                        </h3>

                        <p>
                            Ratings
                        </p>
                    </div>

                    <!-- Quick Actions -->
                    <div class="quick-section">
                        <h3>
                            Quick Actions
                        </h3>

                        <div class="quick-buttons">
                            <a href="addItem.php">
                                <i class="fa fa-plus"></i>
                                Add Item
                            </a>

                            <a href="addStore.php">
                                <i class="fa fa-store"></i>
                                Add Store
                            </a>

                            <a href="addCategory.php">
                                <i class="fa fa-layer-group"></i>
                                Add Category
                            </a>

                            <a href="students.php">
                                <i class="fa fa-user-graduate"></i>
                                Manage Students
                            </a>
                        </div>

                    </div>
                </div>

        <?php include("../admin/includes/footer.php"); ?>

        </div>

    </div>

</body>

</html>