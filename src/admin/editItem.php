<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

$id=$_GET['id'];
$item=mysqli_fetch_assoc(

mysqli_query(

$conn,

"SELECT * FROM item
WHERE ItemID='$id'"

)

);

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

            <div class="page-title">
                <h2>Edit Item</h2>
                <p>Update product information.</p>
            </div>

            <div class="form-card">

                <form action="../admin/processes/editItemProcess.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $item['ItemID']; ?>">
                    <input type="hidden" name="oldImage" value="<?php echo $item['ItemImage']; ?>">

                    <div class="form-group">

                        <label>Item Name</label>

                        <input type="text" name="itemName" value="<?php echo $item['ItemName']; ?>" required>

                    </div>

                    <div class="form-group">

                        <label>Price (RM)</label>

                        <input type="number" step="0.01" name="price" value="<?php echo $item['ItemPrice']; ?>" required>

                    </div>

                    <div class="form-row">

                        <div class="form-group">

                            <label>Category</label>

                            <select name="category">

                                <?php

                                $cat = mysqli_query($conn,"SELECT * FROM category");

                                while($c = mysqli_fetch_assoc($cat))
                                {
                                ?>

                                <option
                                    value="<?php echo $c['categoryName']; ?>"
                                    <?php if($c['categoryName']==$item['ItemCategory']) echo "selected"; ?>>

                                    <?php echo $c['categoryName']; ?>

                                </option>

                                <?php
                                }
                                ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Store</label>

                            <select name="store">

                                <?php

                                $store = mysqli_query($conn,"SELECT * FROM store");

                                while($s = mysqli_fetch_assoc($store))
                                {
                                ?>

                                <option
                                    value="<?php echo $s['StoreName']; ?>"
                                    <?php if($s['StoreName']==$item['StoreName']) echo "selected"; ?>>

                                    <?php echo $s['StoreName']; ?>

                                </option>

                                <?php
                                }
                                ?>

                            </select>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Description</label>

                        <textarea name="description"><?php echo $item['ItemDescription']; ?></textarea>

                    </div>

                    <div class="form-group">

                        <label>Current Image</label><br>

                        <img src="<?php echo $item['ItemImage']; ?>" width="150">

                    </div>

                    <div class="form-group">

                        <label>New Image (Optional)</label>

                        <input type="file" name="image" accept="image/*">

                    </div>

                    <div class="form-buttons">

                        <button class="save-btn" type="submit">
                            Update Item
                        </button>

                        <a href="../admin/items.php" class="cancel-btn">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

        <?php include("../admin/includes/footer.php"); ?>

    </div>

</div>

</body>


</html>