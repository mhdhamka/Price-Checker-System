<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

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

                <h2>Add New Item</h2>

                <p>Add a new product into the system.</p>

            </div>


            <form action="../admin/processes/addItemProcess.php" method="POST" enctype="multipart/form-data">

                <div class="item-form-layout">

                    <!-- LEFT CARD -->

                    <div class="profile-card">

                        <!-- image preview -->
                        <h3>

                            Product Image

                        </h3>

                        <img
                            src="../../assets/images/no-image.png"
                            class="profile-image item-preview">

                        <div class="form-group">

                            <label>

                                <i class="fa fa-image"></i>

                                Upload Item Image

                            </label>

                            <input
                                type="file"
                                name="image"
                                id="itemImage"
                                accept="image/*"
                                required>

                        </div>

                    </div>

                    <!-- RIGHT CARD -->

                        <!-- all inputs -->
                         <div class="profile-card">

                            <h3>

                                Product Information

                            </h3>

                            <br>

                            <div class="form-group">

                                <label>

                                <i class="fa fa-box"></i>

                                    Item Name

                                </label>

                                <input
                                type="text"
                                name="itemName">

                            </div>

                            <div class="form-group">

                                <label>

                                <i class="fa fa-money-bill-wave"></i>

                                    Price (RM)

                                </label>

                                <input
                                type="number"
                                step="0.01"
                                name="price">

                            </div>

                            <div class="form-row">

                                <div class="form-group">

                                    <label>

                                        <i class="fa fa-layer-group"></i>

                                        Category

                                    </label>

                                    <select name="category">

                                        <?php

                                        $cat=mysqli_query($conn,"SELECT * FROM category");

                                        while($c=mysqli_fetch_assoc($cat))

                                        {

                                        ?>

                                        <option>

                                            <?php echo $c['categoryName']; ?>

                                        </option>

                                        <?php

                                        }

                                        ?>

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label>

                                        <i class="fa fa-store"></i>

                                        Store

                                    </label>

                                    <select name="store">

                                        <?php

                                        $store=mysqli_query($conn,"SELECT * FROM store");

                                        while($s=mysqli_fetch_assoc($store))

                                        {

                                        ?>

                                        <option>

                                            <?php echo $s['StoreName']; ?>

                                        </option>

                                        <?php

                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <div class="form-group">

                                <label>

                                    <i class="fa fa-align-left"></i>

                                    Description

                                </label>

                                <textarea rows="6" name="description"></textarea>

                            </div>

                            <div class="form-buttons">

                                <button class="save-btn">

                                <i class="fa fa-floppy-disk"></i>

                                Save Item

                                </button>

                                <a href="../admin/items.php" class="cancel-btn">

                                <i class="fa fa-arrow-left"></i>

                                    Cancel

                                </a>

                            </div>

                        </div>

                </div>

            </form>

        </div>


        <?php include("../admin/includes/footer.php"); ?>

    </div>

</div>

</body>


</html>