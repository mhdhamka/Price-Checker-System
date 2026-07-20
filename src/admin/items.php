<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

/* ----- SEARCH ----- */

$search = "";

$sql = "SELECT * FROM item";

if(isset($_GET['search']) && $_GET['search'] != "")
{
    $search = mysqli_real_escape_string($conn,$_GET['search']);

    $sql .= " WHERE
            ItemName LIKE '%$search%'
            OR ItemCategory LIKE '%$search%'
            OR StoreName LIKE '%$search%'";
}

$sql .= " ORDER BY ItemID DESC";

$itemQuery = mysqli_query($conn,$sql);

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

            <!-- Top Bar -->

            <div class="manage-top">

                <form method="GET" class="search-box">

                    <input type="text" name="search" placeholder="Search item..." value="<?php echo $search; ?>">

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

                    while($item=mysqli_fetch_assoc($itemQuery))

                    {

                    ?>

                    <tr>

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

                            <a href="../admin/processes/deleteItemProcess.php?id=<?php echo $item['ItemID'];?>" class="delete-btn" onclick="return confirm('Delete this item?')">

                                <i class="fa fa-trash"></i>

                            </a>

                        </td>

                    </tr>

                    <?php

                    }

                    ?>

                    </tbody>

                </table>

            </div>

        </div>

        <?php include("../admin/includes/footer.php"); ?>

    </div>

</div>

</body>


</html>