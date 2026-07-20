<?php

session_start();

include("../config/db_cPCS.php");


// =======================
// SYSTEM STATISTICS
// =======================


$students = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM student"
    )
)['total'];



$items = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM item"
    )
)['total'];



$stores = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM store"
    )
)['total'];



$categories = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM category"
    )
)['total'];



$ratings = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM ratings"
    )
)['total'];



?>



<!DOCTYPE html>

<html lang="en">


<head>

    <meta charset="UTF-8">

    <title>
        Admin Reports
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


    <link rel="stylesheet" href="../../assets/css/adminDashboard.css">


    <link rel="stylesheet" href="../../assets/css/font-awesome.css">

</head>

<body>

<div class="admin-container">

    <!-- SIDEBAR -->
    <?php include("includes/sidebar.php"); ?>

        <div class="admin-main">

            <!-- HEADER -->
            <?php include("includes/header.php"); ?>

                <div class="dashboard-content">

                    <div class="report-header">

                        <h2>
                            System Reports
                        </h2>


                        <p>
                            Overview of Price Checker System performance and statistics.
                        </p>

                    </div>


                    <!-- STATISTICS -->
                    <div class="dashboard-cards">

                        <div class="dashboard-card">

                        <i class="fa fa-users"></i>

                        <h3>
                            <?php echo $students; ?>
                        </h3>

                        <p>
                            Total Students
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa fa-box"></i>

                        <h3>
                            <?php echo $items; ?>
                        </h3>

                        <p>
                            Total Items
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa fa-store"></i>

                        <h3>
                            <?php echo $stores; ?>
                        </h3>

                        <p>
                            Total Stores
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa fa-layer-group"></i>

                        <h3>
                            <?php echo $categories; ?>
                        </h3>

                        <p>
                            Categories
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa fa-star"></i>

                        <h3>
                            <?php echo $ratings; ?>
                        </h3>

                        <p>
                            Ratings
                        </p>

                    </div>

                </div>


                <!-- EXPORT SECTION -->
                <div class="report-card">

                    <h3>
                        Export Reports
                    </h3>

                    <p>
                     Download system statistics for documentation and analysis.
                    </p>

                    <div class="report-buttons">

                        <a href="../admin/exportPDF.php" class="pdf-btn">
                            <i class="fa fa-file-pdf"></i>
                            Export PDF
                        </a>

                        <a href="../admin/exportExcel.php" class="excel-btn">
                            <i class="fa fa-file-excel"></i>
                            Export Excel
                        </a>

                    </div>
                </div>
            </div>

            <?php include("includes/footer.php"); ?>

        </div>

</div>

</body>


</html>