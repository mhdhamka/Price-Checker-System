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


/* Category Chart */
$categoryName = [];
$categoryTotal = [];

$sql = mysqli_query(
$conn,
"SELECT ItemCategory,
COUNT(*) AS total
FROM item
GROUP BY ItemCategory"
);

while($row = mysqli_fetch_assoc($sql))
{
    $categoryName[] = $row['ItemCategory'];
    $categoryTotal[] = $row['total'];
}


/* Store Chart */
$storeName = [];
$storeTotal = [];

$sql = mysqli_query(
$conn,
"SELECT StoreName,
COUNT(*) AS total
FROM item
GROUP BY StoreName"
);

while($row = mysqli_fetch_assoc($sql))
{
    $storeName[] = $row['StoreName'];
    $storeTotal[] = $row['total'];
}

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

            <div class="page-title">
                <h2>Welcome Back, Admin </h2>
                <p>Manage your Price Checker System from one dashboard.</p>
            </div>

            <!-- Dashboard Cards -->
            <div class="dashboard-cards">

                <div class="dashboard-card">
                    <i class="fa fa-user-graduate"></i>
                    <h3><?php echo $studentCount; ?></h3>
                    <p>Total Students</p>
                </div>

                <div class="dashboard-card">
                    <i class="fa fa-cart-shopping"></i>
                    <h3><?php echo $itemCount; ?></h3>
                    <p>Total Items</p>
                </div>

                <div class="dashboard-card">
                    <i class="fa fa-store"></i>
                    <h3><?php echo $storeCount; ?></h3>
                    <p>Total Stores</p>
                </div>

                <div class="dashboard-card">
                    <i class="fa fa-layer-group"></i>
                    <h3><?php echo $categoryCount; ?></h3>
                    <p>Total Categories</p>
                </div>

                <div class="dashboard-card">
                    <i class="fa fa-star"></i>
                    <h3><?php echo $ratingCount; ?></h3>
                    <p>Total Ratings</p>
                </div>

            </div>


            <!-- Quick Action Cards -->
            <div class="section-card">

                <div class="section-header">
                    <h3>Quick Actions</h3>
                </div>

                <div class="quick-grid">

                    <a href="addItem.php" class="quick-card">
                        <i class="fa fa-plus-circle"></i>
                        <span>Add Item</span>
                    </a>

                    <a href="addStore.php" class="quick-card">
                        <i class="fa fa-store"></i>
                        <span>Add Store</span>
                    </a>

                    <a href="addCategory.php" class="quick-card">
                        <i class="fa fa-layer-group"></i>
                        <span>Add Category</span>
                    </a>

                    <a href="students.php" class="quick-card">
                        <i class="fa fa-users"></i>
                        <span>Students</span>
                    </a>

                </div>

            </div>


            <!-- Latest Items -->
            <div class="section-card">

                <div class="section-header">

                    <h3>Recently Added Items</h3>

                </div>

                <div class="recent-grid">

                    <?php

                    $itemQuery=mysqli_query($conn,"
                    SELECT *
                    FROM item
                    ORDER BY ItemID DESC
                    LIMIT 5");

                    while($item=mysqli_fetch_assoc($itemQuery))
                    {

                    ?>

                    <div class="recent-card">

                        <img src="<?php echo $item['ItemImage'];?>">

                        <h4><?php echo $item['ItemName'];?></h4>

                        <p><?php echo $item['ItemCategory'];?></p>

                        <small><?php echo $item['StoreName'];?></small>

                        <h5>
                            RM <?php echo number_format($item['ItemPrice'],2);?>
                        </h5>

                    </div>

                    <?php

                    }

                    ?>

                </div>

            </div>


            <!-- Recent Activities -->
            <div class="section-card">
                <div class="section-header">

                    <h3>
                        Recent Activities
                    </h3>

                </div>

                <div class="activity-list">

                    <!-- Latest Students -->
                    <?php

                    $studentQuery = mysqli_query(
                    $conn,
                    "SELECT fullName
                    FROM student
                    ORDER BY studentID DESC
                    LIMIT 3");

                    while($student = mysqli_fetch_assoc($studentQuery))
                    {

                    ?>

                    <div class="activity-card">
                        <div class="activity-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>

                        <div class="activity-info">

                            <h5>

                                <?php echo $student['fullName']; ?>

                            </h5>

                            <p>
                                New student registered.
                            </p>

                        </div>

                    </div>

                    <?php

                    }

                    ?>

                    <!-- Latest Items -->
                    <?php

                    $itemQuery = mysqli_query(
                    $conn,
                    "SELECT ItemName
                    FROM item
                    ORDER BY ItemID DESC
                    LIMIT 3");

                    while($item = mysqli_fetch_assoc($itemQuery))
                    {

                    ?>

                    <div class="activity-card">

                        <div class="activity-icon">

                            <i class="fa fa-box"></i>

                        </div>

                        <div class="activity-info">

                            <h5>

                                <?php echo $item['ItemName']; ?>

                            </h5>

                            <p>
                                New item added.
                            </p>

                        </div>

                    </div>

                    <?php

                    }

                    ?>

                </div>

            </div>   


            <!-- Chart -->
            <div class="analytics-section">
                <div class="chart-card">

                    <span class="chart-badge">
                        Analytics
                    </span>

                    <h3>
                        Item Category Distribution
                    </h3>

                    <p>
                        Percentage of products available in each category.
                    </p>

                    <canvas id="categoryChart"></canvas>

                </div>

                <div class="chart-card">

                    <h3>
                        Store Product Comparison
                    </h3>

                    <p>
                        Number of products available in each store.
                    </p>

                    <canvas id="storeChart"></canvas>

                </div>
            </div>


            <!-- Report -->
            <div class="report-card">
                <h3>
                    System Reports
                </h3>

                <p>
                    Generate and export system statistics.
                </p>

                <div class="report-buttons">
                    <a href="../admin/reports.php">
                        <i class="fa fa-chart-line"></i>
                        View Report
                    </a>

                    <a href="../admin/exportPDF.php">
                        <i class="fa fa-file-pdf"></i>
                        Export PDF
                    </a>

                    <a href="../admin/exportExcel.php">
                        <i class="fa fa-file-excel"></i>
                        Export Excel
                    </a>
                </div>
            </div>

        </div>

        <?php include("../admin/includes/footer.php"); ?>

    </div>

</div>

<script>
    let categoryLabels =
    <?php echo json_encode($categoryName); ?>;

    let categoryData =
    <?php echo json_encode($categoryTotal); ?>;


    let storeLabels =
    <?php echo json_encode($storeName); ?>;

    let storeData =
    <?php echo json_encode($storeTotal); ?>;
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../assets/js/adminDashboard.js"></script>

</body>

</html>