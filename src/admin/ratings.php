<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

/* ==========================================================
   RATING STATISTICS
========================================================== */

$totalRatings = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM ratings
"))['total'];

$averageRating = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT ROUND(AVG(rating),2) avgRate
FROM ratings
"))['avgRate'];

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

$lowItem = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT item.ItemName,
AVG(ratings.rating) avgRating

FROM ratings

JOIN item
ON ratings.ItemID=item.ItemID

GROUP BY ratings.ItemID

ORDER BY avgRating ASC

LIMIT 1
"));



/* ==========================================================
SEARCH / FILTER / SORT
========================================================== */

$search=$_GET['search'] ?? "";

$store=$_GET['store'] ?? "";

$category=$_GET['category'] ?? "";

$star=$_GET['star'] ?? "";

$sort=$_GET['sort'] ?? "";



$sql="

SELECT

ratings.*,

student.fullName,
student.studentIMG,

item.ItemName,
item.ItemImage,
item.StoreName,
item.ItemCategory

FROM ratings

JOIN student
ON ratings.studentID=student.studentID

JOIN item
ON ratings.ItemID=item.ItemID

WHERE 1

";


/* SEARCH */

if($search!="")
{

$search=mysqli_real_escape_string($conn,$search);

$sql.="

AND(

student.fullName LIKE '%$search%'

OR item.ItemName LIKE '%$search%'

)

";

}



/* STORE */

if($store!="")
{

$store=mysqli_real_escape_string($conn,$store);

$sql.="

AND item.StoreName='$store'

";

}



/* CATEGORY */
if($category!="")
{

$category=mysqli_real_escape_string($conn,$category);

$sql.="

AND item.ItemCategory='$category'

";

}


/* STAR FILTER */
if($star!="")
{

    $star = intval($star);

    if($star == 5)
    {
        $sql .= "
        AND ratings.rating = 5.0
        ";
    }
    else
    {
        $sql .= "
        AND ratings.rating >= $star
        AND ratings.rating < ".($star + 1)."
        ";
    }

}


/* SORT */
switch($sort)
{

case "old":

$sql.=" ORDER BY ratingID ASC";

break;

case "highest":

$sql.=" ORDER BY ratings.rating DESC";

break;

case "lowest":

$sql.=" ORDER BY ratings.rating ASC";

break;

default:

$sql.=" ORDER BY ratingID ASC";

}


/* ==========================================================
PAGINATION
========================================================== */

$countSQL="SELECT COUNT(*) total FROM ($sql) temp";

$total=mysqli_fetch_assoc(
mysqli_query($conn,$countSQL)
)['total'];

$limit=10;

$page=isset($_GET['page'])?(int)$_GET['page']:1;

if($page<1)
$page=1;

$offset=($page-1)*$limit;

$sql.=" LIMIT $limit OFFSET $offset";

$ratingQuery=mysqli_query($conn,$sql);

$totalPages=ceil($total/$limit);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Manage Students
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

            <!-- Page Title -->

            <div class="page-title">

                <h2>

                    Ratings Management

                </h2>

                <p>

                    Manage all student ratings.

                </p>

            </div>

            <div class="dashboard-cards">

                <div class="dashboard-card">
                    <i class="fa-solid fa-star"></i>
                    <h4>
                        <?php echo $totalRatings; ?>
                    </h4>

                    <p>
                        Total Ratings
                    </p>
                </div>

                <div class="dashboard-card">
                    <i class="fa-solid fa-chart-line"></i>
                    <h4>
                        <?php echo $averageRating; ?>
                    </h4>

                    <p>
                        Average Rating
                    </p>
                </div>

                <div class="dashboard-card">
                    <i class="fa-solid fa-trophy"></i>
                    <h4>
                        <?php echo $topItem['ItemName']; ?>
                    </h4>

                    <p>
                        Top Rated Item 
                    </p>
                </div>

                <div class="dashboard-card">
                    <i class="fa-solid fa-face-frown"></i>
                    <h4>
                        <?php echo $lowItem['ItemName']; ?>
                    </h4>

                    <p>
                        Lowest Rated
                    </p>
                </div>

            </div>

            <!-- Report -->
            <div class="report-card">
                <h3>
                    Rating Reports
                </h3>

                <p>
                    Generate and export rating statistics.
                </p>

                <div class="report-buttons">
                    <a href="../admin/exportPDF.php?type=rating">
                        <i class="fa fa-file-pdf"></i>
                        Export Rating PDF
                    </a>

                    <a href="../admin/exportExcel.php?type=rating">
                        <i class="fa fa-file-excel"></i>
                        Export Rating Excel
                    </a>
                </div>
            </div>

            <!-- Top Bar -->

            <div class="manage-top">

                <form method="GET" class="search-box">

                    <input type="text" name="search" placeholder="Search item or student..." value="<?php echo htmlspecialchars($search); ?>">


                    <select name="store">

                        <option value="">
                            All Store
                        </option>

                        <?php

                        $storeQuery=mysqli_query($conn,"
                        SELECT DISTINCT StoreName
                        FROM item
                        ORDER BY StoreName
                        ");

                        while($row=mysqli_fetch_assoc($storeQuery))
                        {

                        ?>

                        <option value="<?php echo $row['StoreName'];?>"
                            <?php if($store==$row['StoreName']) echo "selected";?>>

                            <?php echo $row['StoreName'];?>

                        </option>

                        <?php } ?>

                    </select>



                    <select name="category">

                        <option value="">
                            All Category
                        </option>

                        <?php

                        $catQuery=mysqli_query($conn,"
                        SELECT DISTINCT ItemCategory
                        FROM item
                        ORDER BY ItemCategory
                        ");

                        while($row=mysqli_fetch_assoc($catQuery))
                        {

                        ?>

                        <option value="<?php echo $row['ItemCategory'];?>"
                            <?php if($category==$row['ItemCategory']) echo "selected";?>>

                            <?php echo $row['ItemCategory'];?>

                        </option>

                        <?php } ?>

                    </select>

                    <select name="star">

                        <option value="">
                            All Ratings
                        </option>

                        <option value="5" <?php if($star=="5") echo "selected"; ?>>
                            ★★★★★
                        </option>

                        <option value="4" <?php if($star=="4") echo "selected"; ?>>
                            ★★★★☆
                        </option>

                        <option value="3" <?php if($star=="3") echo "selected"; ?>>
                            ★★★☆☆
                        </option>

                        <option value="2" <?php if($star=="2") echo "selected"; ?>>
                            ★★☆☆☆
                        </option>

                        <option value="1" <?php if($star=="1") echo "selected"; ?>>
                            ☆☆☆☆☆
                        </option>

                    </select>

                    <select name="sort">

                        <option value="">
                            Newest
                        </option>

                        <option value="old">
                            Oldest
                        </option>

                        <option value="highest">
                            Highest Rating
                        </option>

                        <option value="lowest">
                            Lowest Rating
                        </option>

                    </select>

                    <button type="submit">

                        <i class="fa fa-search"></i>

                    </button>

                </form>

            </div>

            <!-- Table -->

            <div class="table-card">

                <table>

                    <thead>

                        <tr>

                            <th>No.</th>
                            <th>Image</th>
                            <th>Item</th>
                            <th>Student</th>
                            <th>Rating</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    if(mysqli_num_rows($ratingQuery)==0)
                    {

                    ?>

                    <tr>

                        <td colspan="7" style="text-align:center;">

                            No record found.

                        </td>

                    </tr>

                    <?php

                    }
                    else
                    {

                    $no = $offset + 1;

                    while($rating=mysqli_fetch_assoc($ratingQuery))
                    {

                    ?>

                    <tr>

                        <td>

                            <?php echo $no++; ?>

                        </td>

                        <td>

                            <img src="<?php echo $rating['ItemImage'];?>" class="table-image">

                        </td>

                        <td>

                            <?php echo $rating['ItemName']; ?>

                        </td>


                        <td>

                           <?php echo $rating['fullName']; ?>

                        </td>

                        <td>

                            ⭐ <?php echo $rating['rating']; ?>

                        </td>

                        <td class="action-buttons">

                            <button type="button" class="action-btn view-btn" data-id="<?php echo $rating['ratingID']; ?>" title="View Rating">

                                <i class="fa-solid fa-eye"></i>

                            </button>

                            <button type="button" class="action-btn delete-btn" data-id="<?php echo $rating['ratingID']; ?>" data-item="<?php echo htmlspecialchars($rating['ItemName']); ?>" 
                            data-student="<?php echo htmlspecialchars($rating['fullName']); ?>" title="Delete Rating">

                                <i class="fa-solid fa-trash"></i>

                            </button>

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

                    <?php

                    // Previous button
                    if($page > 1)
                    {
                    ?>

                        <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>&store=<?php echo urlencode($store); ?>&category=<?php echo urlencode($category); ?>&star=<?php echo urlencode($star); ?>&sort=<?php echo urlencode($sort); ?>">

                            <i class="fa fa-angle-left"></i>

                        </a>

                    <?php
                    }


                    // First page
                    if($page > 3)
                    {
                    ?>

                        <a href="?page=1&search=<?php echo urlencode($search); ?>&store=<?php echo urlencode($store); ?>&category=<?php echo urlencode($category); ?>&star=<?php echo urlencode($star); ?>&sort=<?php echo urlencode($sort); ?>">

                            1

                        </a>


                        <?php

                        if($page > 4)
                        {

                        ?>

                            <span class="dots">
                                ...
                            </span>

                        <?php

                        }

                        ?>

                    <?php
                    }


                    // Current page range
                    $start = max(1, $page - 2);
                    $end = min($totalPages, $page + 2);

                    for($i = $start; $i <= $end; $i++)
                    {

                    ?>

                        <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&store=<?php echo urlencode($store); ?>&category=<?php echo urlencode($category); ?>&star=<?php echo urlencode($star); ?>&sort=<?php echo urlencode($sort); ?>"
                        class="<?php if($i == $page) echo 'active'; ?>">

                            <?php echo $i; ?>

                        </a>

                    <?php

                    }


                    // Last page
                    if($page < $totalPages - 2)
                    {

                        if($page < $totalPages - 3)
                        {

                    ?>
                            <span class="dots">
                                ...
                            </span>

                    <?php

                        }

                    ?>

                        <a href="?page=<?php echo $totalPages; ?>&search=<?php echo urlencode($search); ?>&store=<?php echo urlencode($store); ?>&category=<?php echo urlencode($category); ?>&star=<?php echo urlencode($star); ?>&sort=<?php echo urlencode($sort); ?>">

                            <?php echo $totalPages; ?>

                        </a>


                    <?php

                    }


                    // Next button
                    if($page < $totalPages)
                    {

                    ?>

                        <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>&store=<?php echo urlencode($store); ?>&category=<?php echo urlencode($category); ?>&star=<?php echo urlencode($star); ?>&sort=<?php echo urlencode($sort); ?>">

                            <i class="fa fa-angle-right"></i>

                        </a>


                    <?php

                    }

                    ?>

                </div>

                <div class="pagination-info">

                    Showing

                    <strong>
                        <?php echo $offset + 1; ?>
                    </strong>

                    to

                    <strong>
                        <?php echo min($offset + $limit, $total); ?>
                    </strong>

                    of

                    <strong>
                        <?php echo $total; ?>
                    </strong>

                    ratings

                </div>

            </div>

        </div>


        <div class="pagination">

            <?php

            if($page>1)
            {

            ?>

            <a href="?page=<?php echo $page-1; ?>">

            <i class="fa fa-angle-left"></i>

            </a>

            <?php

            }

            for($i=1;$i<=$totalPages;$i++)
            {

            ?>

            <a

            href="?page=<?php echo $i; ?>"

            class="<?php if($page==$i) echo "active"; ?>">

            <?php echo $i; ?>

            </a>

            <?php

            }

            if($page<$totalPages)
            {

            ?>

            <a href="?page=<?php echo $page+1; ?>">

            <i class="fa fa-angle-right"></i>

            </a>

            <?php

            }

            ?>

        </div>


        <!-- ==========================================
        VIEW RATING MODAL
        ========================================== -->

        <div id="ratingModal" class="student-modal">

            <div class="student-modal-content">

                <button
                    type="button"
                    class="close-modal">

                    &times;

                </button>

                <div id="ratingDetails">

                </div>

            </div>

        </div>

        <!-- ==========================================
            CONFIRM ACTION MODAL
        ========================================== -->

        <div id="confirmModal" class="student-modal">

            <div class="student-modal-content confirm-modal">

                <!-- Close Button -->
                <button type="button" class="close-modal">
                    &times;
                </button>

                <!-- Icon -->
                <div id="confirmIcon" class="confirm-icon">

                    <i class="fa-solid fa-key"></i>

                </div>

                <!-- Title -->
                <h2 id="confirmTitle">

                    Confirmation

                </h2>

                <!-- Message -->
                <p id="confirmMessage">

                    Are you sure you want to continue?

                </p>

                <!-- Student Name -->
                <div class="confirm-name">

                    <span id="confirmStudent">

                        Student Name

                    </span>

                </div>

                <!-- Information -->
                <div class="confirm-note">

                    <i class="fa-solid fa-circle-info"></i>

                    <span id="confirmNote">

                        Action description goes here.

                    </span>

                </div>

                <!-- Form -->
                <form id="confirmForm" method="POST">

                    <input
                        type="hidden"
                        id="confirmRatingID"
                        name="ratingID">

                    <div class="confirm-actions">

                        <button
                            type="button"
                            class="cancel-btn">

                            <i class="fa-solid fa-xmark"></i>
                            Cancel

                        </button>

                        <button
                            type="submit"
                            id="confirmBtn"
                            class="confirm-btn">

                            Confirm

                        </button>

                    </div>

                </form>

            </div>

        </div>


        <?php include("../admin/includes/footer.php"); ?>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/ratings.js"></script>

</body>


</html>