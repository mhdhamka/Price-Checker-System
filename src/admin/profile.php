<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

$adminID = $_SESSION['adminID'];

$sql = "SELECT * FROM admin WHERE adminID='$adminID'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==0)
{
    die("Admin not found.");
}

$admin = mysqli_fetch_assoc($result);

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

            <!-- PAGE TITLE -->
            <div class="page-title">

                <h2>Admin Profile</h2>

                <p>
                    Manage your account information, profile picture and login credentials.
                </p>

            </div>

            <br>

            <form action="../admin/processes/updateProfile.php"
                method="POST"
                enctype="multipart/form-data">

                <input type="hidden"
                    name="adminID"
                    value="<?php echo $admin['adminID']; ?>">

                <input type="hidden"
                    name="oldImage"
                    value="<?php echo $admin['adminIMG']; ?>">


                <div class="profile-layout">

                    <!-- ==========================
                        PROFILE CARD
                    ========================== -->

                    <div class="profile-card">

                        <img
                            src="<?php echo $admin['adminIMG']; ?>"
                            class="profile-image">

                        <h3>

                            <?php echo $admin['adminFullname']; ?>

                        </h3>

                        <span>

                            Administrator

                        </span>

                        <div class="form-group">

                            <label>

                                Change Profile Picture

                            </label>

                            <input
                                type="file"
                                name="image"
                                accept="image/*">

                        </div>

                    </div>



                    <!-- ==========================
                        ACCOUNT INFORMATION
                    ========================== -->

                    <div class="profile-card">

                        <h3>

                            Account Information

                        </h3>

                        <br>

                        <div class="form-group">

                            <label>

                                <i class="fa fa-user"></i>

                                Full Name

                            </label>

                            <input
                                type="text"
                                name="adminFullname"
                                value="<?php echo $admin['adminFullname']; ?>">

                        </div>


                        <div class="form-group">

                            <label>

                                <i class="fa fa-user-tag"></i>

                                Username

                            </label>

                            <input
                                type="text"
                                name="adminUsername"
                                value="<?php echo $admin['adminUsername']; ?>">

                        </div>


                        <div class="form-group">

                            <label>

                                <i class="fa fa-envelope"></i>

                                Email Address

                            </label>

                            <input
                                type="email"
                                name="adminEmail"
                                value="<?php echo $admin['adminEmail']; ?>">

                        </div>


                        <div class="form-group">

                            <label>

                                <i class="fa fa-lock"></i>

                                New Password

                            </label>

                            <input
                                type="password"
                                name="adminPassword"
                                placeholder="Leave blank to keep current password">

                        </div>


                        <div class="form-buttons">

                            <button
                                type="submit"
                                class="save-btn">

                                <i class="fa fa-floppy-disk"></i>

                                Save Changes

                            </button>

                            <a
                                href="../admin/dashboard.php"
                                class="cancel-btn">

                                <i class="fa fa-arrow-left"></i>

                                Back to Dashboard

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