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
        Manage Categories
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

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

                <h2>
                    Add New Category
                </h2>

                <p>
                    Create a new product category for the system.
                </p>

            </div>



            <form action="../admin/processes/addCategoryProcess.php" method="POST" enctype="multipart/form-data">


                <div class="item-form-layout">


                    <!-- LEFT CARD -->

                    <div class="profile-card">


                        <h3>
                            Category Image
                        </h3>


                        <img
                            src="../../assets/images/no-image.png"
                            class="profile-image item-preview">


                        <div class="form-group">


                            <label>

                                <i class="fa fa-image"></i>

                                Upload Category Image

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


                    <div class="profile-card">


                        <h3>
                            Category Information
                        </h3>


                        <br>



                        <div class="form-group">


                            <label>

                                <i class="fa fa-layer-group"></i>

                                Category Name

                            </label>


                            <input
                                type="text"
                                name="categoryName"
                                required>


                        </div>



                        <div class="form-buttons">


                            <button class="save-btn" type="submit">


                                <i class="fa fa-floppy-disk"></i>


                                Save Category


                            </button>



                            <a href="../admin/categories.php" class="cancel-btn">


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