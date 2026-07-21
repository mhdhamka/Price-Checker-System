<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

/* ----- STATISTICS ----- */
$totalItems = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(*) total FROM item")
)['total'];

$totalCategories = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(DISTINCT ItemCategory) total FROM item")
)['total'];

$totalStores = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT COUNT(DISTINCT StoreName) total FROM item")
)['total'];

$avgPrice = mysqli_fetch_assoc(
mysqli_query($conn,"SELECT AVG(ItemPrice) avgPrice FROM item")
)['avgPrice'];


/* ==========================================
   SEARCH / FILTER / SORT / PAGINATION
========================================== */

$search = $_GET['search'] ?? "";
$categoryFilter = $_GET['category'] ?? "";
$storeFilter = $_GET['store'] ?? "";
$sort = $_GET['sort'] ?? "";

$sql = "SELECT * FROM item WHERE 1";

/* SEARCH */

if($search != "")
{
    $search = mysqli_real_escape_string($conn,$search);

    $sql .= " AND (
        ItemName LIKE '%$search%'
        OR ItemCategory LIKE '%$search%'
        OR StoreName LIKE '%$search%'
    )";
}

/* CATEGORY FILTER */

if($categoryFilter != "")
{
    $categoryFilter = mysqli_real_escape_string($conn,$categoryFilter);

    $sql .= " AND ItemCategory='$categoryFilter'";
}

/* STORE FILTER */

if($storeFilter != "")
{
    $storeFilter = mysqli_real_escape_string($conn,$storeFilter);

    $sql .= " AND StoreName='$storeFilter'";
}

/* SORTING */

switch($sort)
{
    case "old":
        $sql .= " ORDER BY ItemID ASC";
        break;

    case "high":
        $sql .= " ORDER BY ItemPrice DESC";
        break;

    case "low":
        $sql .= " ORDER BY ItemPrice ASC";
        break;

    case "az":
        $sql .= " ORDER BY ItemName ASC";
        break;

    case "za":
        $sql .= " ORDER BY ItemName DESC";
        break;

    default:
        $sql .= " ORDER BY ItemID DESC";
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
$itemQuery = mysqli_query($conn,$sql);
$totalPages = ceil($total/$limit);
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Manage Items
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
                    Manage Items
                </h2>

                <p>
                    View, search, edit and delete items.
                </p>

            </div>

            <div class="dashboard-cards">

                <div class="dashboard-card">
                    <i class="fa fa-cart-shopping"></i>
                    <h4>
                        <?php echo $totalItems; ?>
                    </h4>

                    <p>
                        Total Items
                    </p>
                </div>

                <div class="dashboard-card">
                    <i class="fa fa-layer-group"></i>
                    <h4>
                        <?php echo $totalCategories; ?>
                    </h4>

                    <p>
                        Categories
                    </p>
                </div>

                <div class="dashboard-card">
                    <i class="fa fa-store"></i>
                    <h4>
                        <?php echo $totalStores; ?>
                    </h4>

                    <p>
                        Stores
                    </p>
                </div>

                <div class="dashboard-card">
                    <i class="fa-solid fa-money-bill"></i>
                    <h4>
                        RM <?php echo number_format($avgPrice,2); ?>
                    </h4>
                    <p>
                        Average Price
                    </p>
                </div>

            </div>

            <!-- Top Bar -->

            <div class="manage-top">

                <form method="GET" class="search-box">

                    <input type="text" name="search" placeholder="Search item..." value="<?php echo htmlspecialchars($search); ?>">

                    <select name="category">

                        <option value="">All Categories</option>

                        <?php

                        $categoryQuery = mysqli_query($conn,"SELECT * FROM category");

                        while($category = mysqli_fetch_assoc($categoryQuery))
                        {

                        ?>

                        <option
                        value="<?php echo $category['categoryName']; ?>"

                        <?php

                        if($categoryFilter == $category['categoryName'])
                        echo "selected";

                        ?>>

                        <?php echo $category['categoryName']; ?>

                        </option>

                        <?php

                        }

                        ?>

                    </select>

                    <select name="store">

                        <option value="">All Stores</option>

                        <?php

                        $storeQuery = mysqli_query($conn,"SELECT * FROM store");

                        while($store = mysqli_fetch_assoc($storeQuery))
                        {

                        ?>

                        <option
                        value="<?php echo $store['StoreName']; ?>"

                        <?php

                        if($storeFilter == $store['StoreName'])
                        echo "selected";

                        ?>>

                        <?php echo $store['StoreName']; ?>

                        </option>

                        <?php

                        }

                        ?>

                    </select>

                    <select name="sort">

                        <option value="">Newest</option>

                        <option value="old" <?php if($sort=="old") echo "selected"; ?>>Oldest</option>

                        <option value="high" <?php if($sort=="high") echo "selected"; ?>>Highest Price</option>

                        <option value="low" <?php if($sort=="low") echo "selected"; ?>>Lowest Price</option>

                        <option value="az" <?php if($sort=="az") echo "selected"; ?>>A-Z</option>

                        <option value="za" <?php if($sort=="za") echo "selected"; ?>>Z-A</option>

                    </select>

                    <button>

                        <i class="fa fa-search"></i>

                    </button>

                </form>

                <a href="../admin/addItem.php" class="add-btn">

                    <i class="fa fa-plus"></i>

                    Add Item

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
                            <th>Category</th>
                            <th>Store</th>
                            <th>Price</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    if(mysqli_num_rows($itemQuery)==0)
                    {

                    ?>

                    <tr>

                        <td colspan="7" style="text-align:center;">

                            No item found.

                        </td>

                    </tr>

                    <?php

                    }
                    else
                    {

                    $no = $offset + 1;

                    while($item=mysqli_fetch_assoc($itemQuery))
                    {

                    ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
                        </td>

                        <td>

                            <img src="<?php echo $item['ItemImage']; ?>" class="table-image">

                        </td>

                        <td>

                            <?php echo $item['ItemName']; ?>

                        </td>

                        <td>

                            <?php echo $item['ItemCategory']; ?>

                        </td>

                        <td>

                            <?php echo $item['StoreName']; ?>

                        </td>

                        <td>

                            RM <?php echo number_format($item['ItemPrice'],2); ?>

                        </td>

                        <td>

                            <a href="../admin/editItem.php?id=<?php echo $item['ItemID'];?>" class="edit-btn">

                                <i class="fa fa-pen"></i>

                            </a>

                            <a href="#" class="delete-btn" data-id="<?php echo $item['ItemID']; ?>">

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

                        <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo urlencode($categoryFilter); ?>&store=<?php echo urlencode($storeFilter); ?>&sort=<?php echo urlencode($sort); ?>"
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
                    <h3>Delete Item</h3>
                    <button class="delete-close" id="closeDelete">&times;</button>
                </div>

                <div class="delete-modal-body">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <p>Are you sure you want to delete this item?<br>This action cannot be undone.</p>
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
<script src="../../assets/js/items.js"></script>

</body>


</html>