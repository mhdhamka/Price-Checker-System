<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

/* ==========================================
   SEARCH / PAGINATION
========================================== */

$search = $_GET['search'] ?? "";

$sql = "SELECT * FROM store WHERE 1";

/* SEARCH */
if($search != "")
{
    $search = mysqli_real_escape_string($conn,$search);

    $sql .= " AND (
        StoreName LIKE '%$search%'
    )";
}

/* TOTAL RECORDS */
$countSQL = str_replace(
    "SELECT *",
    "SELECT COUNT(*) total",
    $sql
);

$total = mysqli_fetch_assoc(
    mysqli_query($conn,$countSQL)
)['total'];

/* PAGINATION */
$limit = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1)
{
    $page = 1;
}

$offset = ($page-1)*$limit;
$sql .= " LIMIT $limit OFFSET $offset";
$storeQuery = mysqli_query($conn,$sql);
$totalPages = ceil($total/$limit);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Manage stores
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

                    Manage stores

                </h2>

                <p>

                    View, search, add, edit, and delete store records.

                </p>

            </div>

            <!-- Top Bar -->

            <div class="manage-top">

                <form method="GET" class="search-box">

                    <input type="text" name="search" placeholder="Search store..." value="<?php echo $search; ?>">

                    <button>

                        <i class="fa fa-search"></i>

                    </button>

                </form>

                <a href="../admin/addstore.php" class="add-btn">

                    <i class="fa fa-plus"></i>

                    Add Store

                </a>

            </div>

            <!-- Table -->

            <div class="table-card">

                <table>

                    <thead>

                        <tr>

                            <th>No.</th>
                            <th>Image</th>
                            <th>Store Name</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    if(mysqli_num_rows($storeQuery)==0)
                    {

                    ?>

                    <tr>

                        <td colspan="7" style="text-align:center;">

                            No store found.

                        </td>

                    </tr>

                    <?php

                    }
                    else
                    {

                    $no = $offset + 1;

                    while($store=mysqli_fetch_assoc($storeQuery))
                    {

                    ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
                        </td>

                        <td>

                            <img src="<?php echo $store['storeIMG']; ?>" class="table-image">

                        </td>

                        <td>

                            <?php echo $store['StoreName']; ?>

                        </td>

                        <td>

                            <a href="../admin/editStore.php?id=<?php echo $store['storeID'];?>" class="edit-btn">

                                <i class="fa fa-pen"></i>

                            </a>

                            <a href="#" class="delete-btn" data-id="<?php echo $store['storeID']; ?>">

                                <i class="fa fa-trash"></i>

                            </a>

                        </td>

                    </tr>

                    <?php

                    }

                    }

                    ?>

                    </tbody>

                </table>

                <div class="pagination">

                    <?php

                    // Previous button
                    if($page > 1)
                    {
                    ?>

                    <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>">

                        <i class="fa fa-angle-left"></i>

                    </a>

                    <?php
                    }


                    // First page
                    if($page > 3)
                    {
                    ?>

                    <a href="?page=1&search=<?php echo urlencode($search); ?>">

                        1

                    </a>


                    <?php if($page > 4)
                    {
                    ?>

                    <span class="dots">
                        ...
                    </span>

                    <?php
                    }

                    }


                    // Current page range

                    $start = max(1, $page - 2);

                    $end = min($totalPages, $page + 2);


                    for($i=$start; $i<=$end; $i++)
                    {

                    ?>

                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"
                    class="<?php if($page == $i) echo 'active'; ?>">

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


                    <a href="?page=<?php echo $totalPages; ?>&search=<?php echo urlencode($search); ?>">

                        <?php echo $totalPages; ?>

                    </a>


                    <?php

                    }


                    // Next button

                    if($page < $totalPages)
                    {

                    ?>

                    <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>">

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

                    stores

                </div>

            </div>

        </div>

        <!-- DELETE MODAL -->
        <div id="deleteModal" class="delete-modal">

            <div class="delete-modal-content">

                <div class="delete-modal-header">
                    <h3>Delete Store</h3>
                    <button class="delete-close" id="closeDelete">&times;</button>
                </div>

                <div class="delete-modal-body">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <p>Are you sure you want to delete this store?<br>This action cannot be undone.</p>
                </div>

                <div class="delete-modal-footer">
                    <button id="cancelDelete">Cancel</button>
                    <a id="confirmDelete">Delete</a>
                </div>

            </div>

        </div>

        <?php include("../admin/includes/footer.php"); ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/stores.js"></script>

</body>


</html>