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

            <div class="page-title">
                <h2>Admin Profile</h2>
                <p>Manage your account information, profile picture, and login credentials.</p>
            </div>

            <div class="form-card">

                <form action="../admin/processes/updateProfile.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="adminID" value="<?php echo $admin['adminID']; ?>">
                    <input type="hidden" name="oldImage" value="<?php echo $admin['adminIMG']; ?>">

                    <img src="<?php echo $admin['adminIMG']; ?>" width="150">

                    <div class="form-group">

                        <label>Full Name</label>

                        <input type="text" name="adminFullname" value="<?php echo $admin['adminFullname']; ?>">

                    </div>

                    <div class="form-group">

                        <label>Username</label>

                        <input type="text" name="adminUsername" value="<?php echo $admin['adminUsername']; ?>">

                    </div>

                    <div class="form-group">

                        <label>Email</label>

                        <input type="email" name="adminEmail" value="<?php echo $admin['adminEmail']; ?>">

                    </div>

                    <div class="form-group">

                        <label>New Password</label>

                        <input type="password" name="adminPassword" placeholder="Leave blank to keep current password">

                    </div>

                    <div class="form-group">

                        <label>Image Upload (Optional)</label>

                        <input type="file" name="image" accept="image/*">

                    </div>

                    <div class="form-buttons">

                        <button class="save-btn" type="submit">
                            Save Changes
                        </button>

                        <a href="../admin/dashboard.php" class="cancel-btn">
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