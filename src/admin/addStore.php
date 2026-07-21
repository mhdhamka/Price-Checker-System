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

            <div class="page-title">

                <h2>Add New Store</h2>

                <p>Add a new store to the system.</p>

            </div>

            <div class="form-card">

                <form action="../admin/processes/addStoreProcess.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group">

                        <label>Store Name</label>

                        <input type="text" name="StoreName" required>

                    </div>

                    <div class="form-group">

                        <label>Description</label>

                        <textarea name="desc1" rows="5"></textarea>

                    </div>

                    <div class="form-group">

                        <label>Store Image</label>

                        <input type="file" name="image" accept="image/*" required>

                    </div>

                    <div class="form-buttons">

                        <button class="save-btn" type="submit">

                            Save Store

                        </button>

                        <a href="../admin/stores.php" class="cancel-btn">

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