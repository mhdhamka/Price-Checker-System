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
        Add Administrator
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/adminDashboard.css">
    <link rel="icon" href="../../assets/images/logo.png">

</head>


<body>


<div class="admin-container">

    <?php include("../admin/includes/sidebar.php"); ?>

        <div class="admin-main">

            <?php include("../admin/includes/header.php"); ?>

                <div class="dashboard-content">

                    <div class="page-title">

                        <h2>
                            Add Administrator
                        </h2>

                        <p>
                            Create a new administrator account.
                        </p>

                    </div>

                    <form action="../admin/processes/addAdminProcess.php"
                    method="POST" enctype="multipart/form-data">

                        <div class="profile-layout">

                    <!-- LEFT CARD -->

                    <div class="profile-card">

                        <h3>
                            Profile Image
                        </h3>

                        <img src="../../assets/images/no-image.png"
                        class="profile-image">

                        <div class="form-group">

                            <label>

                                <i class="fa fa-image"></i>

                                Upload Profile Picture

                            </label>

                            <input type="file" name="image"
                            accept="image/*" required>

                        </div>

                    </div>


                    <!-- RIGHT CARD -->
                    <div class="profile-card">

                        <h3>
                            Administrator Information
                        </h3>

                        <br>

                        <div class="form-group">

                            <label>

                                <i class="fa fa-user"></i>

                                Full Name

                            </label>

                            <input type="text" name="adminFullname" required>

                        </div>

                        <div class="form-group">

                            <label>

                                <i class="fa fa-user-tag"></i>

                                Username

                            </label>

                            <input type="text" name="adminUsername" required>

                        </div>


                        <div class="form-group">

                            <label>

                                <i class="fa fa-envelope"></i>

                                Email Address

                            </label>

                            <input type="email" name="adminEmail" required>


                        </div>

                        <div class="form-group">

                            <label>

                                <i class="fa fa-lock"></i>

                                Password

                            </label>

                            <input type="password" name="adminPassword" required>


                        </div>

                        <div class="form-buttons">

                            <button type="submit" class="save-btn">

                                <i class="fa fa-user-plus"></i>

                                Create Admin

                            </button>

                            <a href="../admin/admins.php" class="cancel-btn">

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