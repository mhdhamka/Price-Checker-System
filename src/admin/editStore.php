<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

$id=$_GET['id'];

$store=mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "SELECT * FROM store
        WHERE storeID='$id'"

    )

);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Manage Stores
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
                    Edit Store
                </h2>

                <p>
                    Update store information.
                </p>

            </div>


            <form action="../admin/processes/editStoreProcess.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $store['storeID']; ?>">

                <input type="hidden" name="oldImage" value="<?php echo $store['storeIMG']; ?>">


                <div class="item-form-layout">


                    <div class="profile-card">

                        <h3>
                            Store Image
                        </h3>


                        <img
                            src="<?php echo $store['storeIMG']; ?>"
                            class="profile-image item-preview">


                        <div class="form-group">

                            <label>

                                <i class="fa fa-image"></i>

                                Upload New Image

                            </label>


                            <input
                                type="file"
                                name="image"
                                id="itemImage"
                                accept="image/*">

                        </div>

                    </div>



                    <div class="profile-card">

                        <h3>
                            Store Information
                        </h3>

                        <br>


                        <div class="form-group">

                            <label>

                                <i class="fa fa-store"></i>

                                Store Name

                            </label>


                            <input
                                type="text"
                                name="StoreName"
                                value="<?php echo $store['StoreName']; ?>"
                                required>

                        </div>



                        <div class="form-group">

                            <label>

                                <i class="fa fa-align-left"></i>

                                Description

                            </label>


                            <textarea
                                rows="6"
                                name="desc1"><?php echo $store['desc1']; ?></textarea>

                        </div>



                        <div class="form-buttons">

                            <button class="save-btn" type="submit">

                                <i class="fa fa-pen"></i>

                                Update Store

                            </button>


                            <a href="../admin/stores.php" class="cancel-btn">

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