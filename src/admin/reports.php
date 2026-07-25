<?php

session_start();

include("../config/db_cPCS.php");


/* ==========================================
KPI CARDS
========================================== */

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


/* ==========================================
QUICK INSIGHTS
========================================== */

$topItem = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT item.ItemName,
AVG(ratings.rating) avgRating

FROM ratings

JOIN item
ON ratings.ItemID=item.ItemID

GROUP BY ratings.ItemID

ORDER BY avgRating DESC

LIMIT 1
"));

$activeStores = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT

StoreName,

COUNT(*) total

FROM item

GROUP BY StoreName

ORDER BY total DESC

LIMIT 1
"));

$largeCategories = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT

ItemCategory,

COUNT(*) total

FROM item

GROUP BY ItemCategory

ORDER BY total DESC

LIMIT 1
"));

$activeStudents = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM student
WHERE logStatus='1'
"))['total'];


$averageRating = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT ROUND(AVG(rating),2) avgRate
FROM ratings
"))['avgRate'];


/* ==========================================
SYSTEM ACTIVITY TIMELINE
========================================== */
$activityQuery=mysqli_query($conn,"

(
    SELECT

    fullName AS title,

    'New student registered' AS activity,

    created_at AS activityDate,

    'student' AS type


    FROM student


    ORDER BY created_at DESC

    LIMIT 3
)

UNION ALL

(
    SELECT

    ItemName AS title,

    'New item added' AS activity,

    created_at AS activityDate,

    'item' AS type

    FROM item

    ORDER BY created_at DESC

    LIMIT 3
)


UNION ALL


(
    SELECT

    item.ItemName AS title,

    'New rating received' AS activity,

    ratings.dateCreated AS activityDate,

    'rating' AS type


    FROM ratings


    JOIN item

    ON ratings.ItemID=item.ItemID


    ORDER BY ratings.dateCreated DESC

    LIMIT 3
)

ORDER BY activityDate DESC

");


/* ==========================================
ANALYTICS
========================================== */
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

/* Monthly Registrations*/

$registrationMonth = [];

$registrationTotal = [];

$sql = mysqli_query(

$conn,

"

SELECT

MONTHNAME(created_at) AS month,

COUNT(*) AS total

FROM student

GROUP BY MONTH(created_at)

ORDER BY MONTH(created_at)

"

);

while($row = mysqli_fetch_assoc($sql))
{

    $registrationMonth[] = $row['month'];

    $registrationTotal[] = $row['total'];

}

/* Rating Distribution */

$ratingLabel = [];

$ratingTotal = [];

$sql = mysqli_query(

$conn,

"

SELECT

FLOOR(rating) AS star,

COUNT(*) AS total

FROM ratings

GROUP BY FLOOR(rating)

ORDER BY star ASC

"

);

while($row = mysqli_fetch_assoc($sql))
{

    $ratingLabel[] = $row['star']." ★";

    $ratingTotal[] = $row['total'];

}


/* ==========================================
EXPORT HISTORY PAGINATION
========================================== */

$limit = 10;

$page = isset($_GET['page']) 
? (int)$_GET['page'] 
: 1;


if($page < 1)
{
    $page = 1;
}


$offset = ($page - 1) * $limit;



/* TOTAL EXPORT LOGS */
$totalQuery=mysqli_query(
$conn,
"
SELECT COUNT(*) AS total
FROM report_logs
"
);


$total=mysqli_fetch_assoc($totalQuery)['total'];


$totalPages=ceil($total/$limit);


/* EXPORT HISTORY DATA */
$reportQuery=mysqli_query(
$conn,
"

SELECT *

FROM report_logs

ORDER BY generatedAt DESC

LIMIT $limit

OFFSET $offset

"

);

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
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

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

                        <span class="page-badge">

                            <i class="fa-solid fa-chart-line"></i>

                            Analytics Dashboard

                        </span>

                        <h2>

                            System Reports & Analytics

                        </h2>

                        <p>

                            Monitor system performance, visualize key metrics, analyze user activities, and export reports for further business intelligence analysis.

                        </p>

                    </div>


                    <!-- STATISTICS -->
                    <div class="section-card">

                            <h3>
                                KPI Cards
                            </h3>

                            <br>
                    

                        <div class="quick-grid">

                            <div class="dashboard-card">

                                <i class="fa fa-users"></i>

                                <h3>
                                    <?php echo $students; ?>
                                </h3>

                                <p>
                                    Registered Students
                                </p>

                            </div>

                            <div class="dashboard-card">

                                <i class="fa fa-box"></i>

                                <h3>
                                    <?php echo $items; ?>
                                </h3>

                                <p>
                                    Products Listed
                                </p>

                            </div>

                            <div class="dashboard-card">

                                <i class="fa fa-store"></i>

                                <h3>
                                    <?php echo $stores; ?>
                                </h3>

                                <p>
                                    Partner Stores
                                </p>

                            </div>

                            <div class="dashboard-card">

                                <i class="fa fa-layer-group"></i>

                                <h3>
                                    <?php echo $categories; ?>
                                </h3>

                                <p>
                                    Product Categories
                                </p>

                            </div>

                            <div class="dashboard-card">

                                <i class="fa fa-star"></i>

                                <h3>
                                    <?php echo $ratings; ?>
                                </h3>

                                <p>
                                    Customer Ratings
                                </p>

                            </div>
                        
                        </div>

                    </div>

                    <!-- Analytics -->
                    <div class="section-header">

                        <div>

                            <h2>
                                Analytics Overview
                            </h2>

                            <p>
                                Visual representation of system performance, inventory trends, and user engagement.
                            </p>

                        </div>

                    </div>


                    <div class="analytics-section">
                        <div class="chart-card">

                            <span class="chart-badge blue">
                                Distribution
                            </span>

                            <h3>
                                Product Category Distribution
                            </h3>

                            <p>
                                Visualizes how products are distributed across all available categories.
                            </p>

                            <div class="chart-body">
                                <canvas id="categoryChart"></canvas>
                            </div>

                        </div>

                        <div class="chart-card">

                            <span class="chart-badge orange">

                                Inventory

                            </span>

                            <h3>

                                Store Inventory Comparison

                            </h3>

                            <p>

                                Compare the total number of products managed by each participating store.

                            </p>

                            <div class="chart-body">
                                <canvas id="storeChart"></canvas>
                            </div>

                        </div>

                        <div class="chart-card">

                            <span class="chart-badge green">

                                Growth

                            </span>

                            <h3>

                                Monthly Student Registrations

                            </h3>

                            <p>

                                Displays student registration trends over time to monitor platform growth.

                            </p>

                            <div class="chart-body">
                                <canvas id="registrationChart"></canvas>
                            </div>

                        </div>

                        <div class="chart-card">

                            <span class="chart-badge purple">

                                Feedback

                            </span>

                            <h3>

                                Rating Distribution

                            </h3>

                            <p>

                                Shows the distribution of product ratings submitted by students.

                            </p>

                            <div class="chart-body">
                                <canvas id="ratingChart"></canvas>
                            </div>

                        </div>


                    </div>


                    <!-- STATISTICS -->
                    <div class="section-card">

                            <h3>
                                Quick Insights
                            </h3>

                            <br>
                        
                        <div class="quick-grid">

                            <div class="dashboard-card">

                                <i class="fa-solid fa-star-half-stroke"></i>

                                <h4>
                                    <?php echo $topItem['ItemName']; ?>
                                </h4>

                                <p>
                                    Highest Rated Product
                                </p>

                            </div>

                            <div class="dashboard-card">

                                <i class="fa-solid fa-shop"></i>

                                <h4>
                                    <?php echo $activeStores['StoreName']; ?>
                                </h4>

                                <p>
                                    Most Active Store
                                </p>

                            </div>

                            <div class="dashboard-card">

                                <i class="fa-solid fa-boxes-stacked"></i>

                                <h4>
                                    <?php echo $largeCategories['ItemCategory']; ?>
                                </h4>

                                <p>
                                    Largest Category
                                </p>

                            </div>

                            <div class="dashboard-card">

                                <i class="fa-solid fa-users"></i>

                                <h4>
                                    <?php echo $activeStudents; ?>
                                </h4>

                                <p>
                                    Active Students
                                </p>

                            </div>

                            <div class="dashboard-card">

                                <i class="fa-solid fa-chart-line"></i>

                                <h4>
                                    <?php echo $averageRating; ?>
                                </h4>

                                <p>
                                    Average Ratings
                                </p>

                            </div>
                        
                        </div>

                    </div>


                    <!-- SYSTEM ACTIVITY TIMELINE -->
                    <div class="section-card">
                        <div class="section-header">

                            <h3>
                                System Activities Timeline
                            </h3>

                        </div>

                        <div class="activity-timeline">

                            <?php


                            while($activity=mysqli_fetch_assoc($activityQuery))

                            {


                            ?>


                            <div class="timeline-item">

                                <div class="timeline-icon">


                                    <?php


                                    if($activity['type']=="student")
                                    {

                                    echo '<i class="fa fa-user-plus"></i>';

                                    }


                                    else if($activity['type']=="item")
                                    {

                                    echo '<i class="fa fa-box"></i>';

                                    }


                                    else if($activity['type']=="rating")
                                    {

                                    echo '<i class="fa fa-star"></i>';

                                    }


                                    ?>


                                </div>

                                <div class="timeline-content">

                                    <h5>

                                        <?php echo $activity['title']; ?>

                                    </h5>

                                    <p>

                                        <?php echo $activity['activity']; ?>

                                    </p>

                                    <span>

                                        <?php echo date(
                                        "d M Y",
                                        strtotime($activity['activityDate'])
                                        ); ?>

                                    </span>

                                </div>

                            </div>

                            <?php

                            }

                            ?>


                        </div>
                    </div>


                    <!-- EXPORT SECTION -->
                    <div class="report-card">

                        <h3>
                            Export Centre
                        </h3>

                        <p>
                            Choose the preferred format for analysis or documentation.
                        </p>

                        <div class="report-buttons">

                            <a href="exportPDF.php?type=item" class="pdf-btn">

                                <i class="fa-solid fa-file-pdf"></i>

                                PDF Report

                            </a>

                            <a href="exportExcel.php?type=item" class="excel-btn">

                                <i class="fa-solid fa-file-excel"></i>

                                Excel Report

                            </a>

                            <a href="exportCSV.php?type=item" class="csv-btn">

                                <i class="fa-solid fa-file-csv"></i>

                                CSV (Power BI)

                            </a>

                            <a href="exportJSON.php?type=item" class="json-btn">

                                <i class="fa-solid fa-file-code"></i>

                                JSON Data

                            </a>


                        </div>

                        <br>


                        <!-- REPORT GENERATOR -->
                        <h3>
                            Generate Custom Report
                        </h3>

                        <form action="../admin/exportPDF.php" method="GET" class="report-form">

                            <!-- REPORT TYPE -->
                            <select name="type">

                                <option value="item">
                                    Products
                                </option>


                                <option value="student">
                                    Students
                                </option>


                                <option value="rating">
                                    Ratings
                                </option>

                            </select>

                            <!-- STORE FILTER -->
                            <select name="store">

                                <option value="">
                                    All Stores
                                </option>

                                <?php


                                $storeQuery=mysqli_query($conn,"
                                SELECT * 
                                FROM store
                                ");


                                while($store=mysqli_fetch_assoc($storeQuery))

                                {


                                ?>

                                <option value="<?php echo $store['StoreName']; ?>">
                                    <?php echo $store['StoreName']; ?>
                                </option>


                                <?php

                                }

                                ?>

                            </select>

                            <!-- CATEGORY FILTER -->
                            <select name="category">

                                <option value="">

                                    All Categories

                                </option>

                                <?php


                                $categoryQuery=mysqli_query($conn,"
                                SELECT *
                                FROM category
                                ");



                                while($category=mysqli_fetch_assoc($categoryQuery))

                                {


                                ?>


                                <option value="<?php echo $category['categoryName']; ?>">
                                    <?php echo $category['categoryName']; ?>
                                </option>

                                <?php

                                }

                                ?>

                            </select>

                            <input type="date" name="from">


                            <input type="date" name="to">


                            <button type="submit" class="report-btn">

                                Generate PDF

                            </button>

                        </form>

                    </div>


                    <!-- ANALYTICS SUMMARY -->
                    <div class="summary-card">

                        <h3>

                            Analytics Summary

                        </h3>

                        <p>

                            The Price Checker System currently manages

                            <strong>

                                <?php echo $items; ?>

                            </strong>

                            products across

                            <strong>

                                <?php echo $categories; ?>

                            </strong>

                            categories from

                            <strong>

                                <?php echo $stores; ?>

                            </strong>

                            partner stores.

                            Students have submitted

                            <strong>

                                <?php echo $ratings; ?>

                            </strong>

                            ratings to assist other shoppers in making informed purchasing decisions.

                        </p>

                    </div>


                    <br>

                    <div class="report-table-card">

                        <h3>
                            Recent Export History
                        </h3>

                        <br>

                        <table class="report-table">

                            <thead>

                                <tr>

                                    <th>
                                        No
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Report
                                    </th>

                                    <th>
                                        Format
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                <?php

                                if(mysqli_num_rows($reportQuery)==0)

                                {

                                ?>

                                <tr>

                                    <td colspan="4">


                                        <div class="empty-state">


                                            <i class="fa-solid fa-chart-column"></i>


                                            <h3>

                                                No Reports Available

                                            </h3>


                                            <p>

                                                Generate your first report to begin tracking system analytics.

                                            </p>


                                        </div>


                                    </td>

                                </tr>


                                <?php

                                }

                                else
                                {


                                $no = $offset + 1;


                                while($row=mysqli_fetch_assoc($reportQuery))

                                {


                                ?>

                                <tr>


                                    <td>

                                        <?php echo $no++; ?>

                                    </td>


                                    <td>

                                        <?php echo $row['generatedAt']; ?>

                                    </td>


                                    <td>

                                        <?php echo ucfirst($row['reportType']); ?>

                                    </td>


                                    <td>

                                        <?php echo strtoupper($row['format']); ?>

                                    </td>


                                </tr>


                                <?php


                                }


                                }


                                ?>

                            </tbody>

                        </table>

                        <!-- ==========================================
                            PAGINATION
                        ========================================== -->
                        <div class="pagination">

                            <?php if($page > 1){ ?>

                            <a href="?page=<?php echo $page-1; ?>">

                                <i class="fa fa-angle-left"></i>

                            </a>

                            <?php } ?>

                            <?php


                            for($i=1; $i <= $totalPages; $i++)

                            {

                            ?>


                            <a 

                                href="?page=<?php echo $i; ?>"

                                class="<?php echo ($page==$i) ? 'active' : ''; ?>">

                                <?php echo $i; ?>

                            </a>


                            <?php

                            }

                            ?>



                            <?php if($page < $totalPages){ ?>


                            <a href="?page=<?php echo $page+1; ?>">

                                <i class="fa fa-angle-right"></i>

                            </a>


                            <?php } ?>


                        </div>


                        <div class="pagination-info">

                            Showing

                            <strong>
                                <?php echo ($total > 0) ? $offset + 1 : 0; ?>
                            </strong>

                            to

                            <strong>
                                <?php echo min($offset + $limit, $total); ?>
                            </strong>

                            of

                            <strong>
                                <?php echo $total; ?>
                            </strong>

                            exports

                        </div>


                    </div>


                    <!-- REPORT FOOTER -->
                    <div class="report-footer">

                        <p>

                            Price Checker System • Reports & Analytics

                        </p>

                        <p>

                            Generated

                            <?php echo date("d F Y h:i A"); ?>

                        </p>

                        <p>

                            Powered by Chart.js • DomPDF • PhpSpreadsheet

                        </p>

                    </div>


                </div>

            <?php include("includes/footer.php"); ?>

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


let registrationLabels =
<?php echo json_encode($registrationMonth); ?>;

let registrationData =
<?php echo json_encode($registrationTotal); ?>;


let ratingLabels =
<?php echo json_encode($ratingLabel); ?>;

let ratingData =
<?php echo json_encode($ratingTotal); ?>;

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="../../assets/js/reports.js"></script>

</body>


</html>