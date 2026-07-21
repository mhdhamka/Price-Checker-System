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

$sql = "SELECT * FROM category WHERE 1";

/* SEARCH */

if($search != "")
{
    $search = mysqli_real_escape_string($conn,$search);

    $sql .= " AND (
        categoryName LIKE '%$search%'
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
$categoryQuery = mysqli_query($conn,$sql);
$totalPages = ceil($total/$limit);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Manage Categories
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

                    Manage Categories

                </h2>

                <p>

                    View, search, add, edit, and delete categories.

                </p>

            </div>

            <!-- Top Bar -->

            <div class="manage-top">

                <form method="GET" class="search-box">

                    <input type="text" name="search" placeholder="Search category..." value="<?php echo $search; ?>">

                    <button>

                        <i class="fa fa-search"></i>

                    </button>

                </form>

                <a href="../admin/addCategory.php" class="add-btn">

                    <i class="fa fa-plus"></i>

                    Add Category

                </a>

            </div>

            <!-- Table -->

            <div class="table-card">

                <table>

                    <thead>

                        <tr>

                            <th>No.</th>
                            <th>Image</th>
                            <th>Name</th>
                            
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    if(mysqli_num_rows($categoryQuery)==0)
                    {

                    ?>

                    <tr>

                        <td colspan="7" style="text-align:center;">

                            No category found.

                        </td>

                    </tr>

                    <?php

                    }
                    else
                    {

                    $no = $offset + 1;

                    while($category=mysqli_fetch_assoc($categoryQuery))
                    {

                    ?>

                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>

                        <td>

                            <img src="<?php echo $category['categoryIMG']; ?>" class="table-image">

                        </td>

                        <td>

                            <?php echo $category['categoryName']; ?>

                        </td>

                        <td>

                            <a href="../admin/editCategory.php?id=<?php echo $category['categoryID'];?>" class="edit-btn">

                                <i class="fa fa-pen"></i>

                            </a>

                            <a href="#" class="delete-btn" data-id="<?php echo $category['categoryID']; ?>">

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

                    for($i=1;$i<=$totalPages;$i++)

                    {

                    ?>

                        <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"
                        class="<?php if($page==$i) echo 'active'; ?>">

                            <?php echo $i; ?>

                        </a>

                    <?php

                    }

                    ?>

                </div>

            </div>

        </div>

        <!-- DELETE MODAL -->
        <div id="deleteModal" class="delete-modal">

            <div class="delete-modal-content">

                <div class="delete-modal-header">
                    <h3>Delete Category</h3>
                    <button class="delete-close" id="closeDelete">&times;</button>
                </div>

                <div class="delete-modal-body">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <p>Are you sure you want to delete this category?<br>This action cannot be undone.</p>
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
<script src="../../assets/js/categories.js"></script>

</body>


</html>