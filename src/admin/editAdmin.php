<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}



$id = $_GET['id'];


$query = mysqli_query(
$conn,
"SELECT * FROM admin WHERE adminID='$id'"
);


if(mysqli_num_rows($query)==0)
{
    die("Admin not found.");
}


$editAdmin = mysqli_fetch_assoc($query);

?>


<!DOCTYPE html>

<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Edit Administrator
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
Edit Administrator
</h2>


<p>
Update administrator account information.
</p>


</div>





<form action="../admin/processes/editAdminProcess.php"
method="POST"
enctype="multipart/form-data">


<input
type="hidden"
name="adminID"
value="<?php echo $editAdmin['adminID']; ?>">



<input
type="hidden"
name="oldImage"
value="<?php echo $editAdmin['adminIMG']; ?>">





<div class="profile-layout">



<div class="profile-card">


<h3>
Profile Image
</h3>



<img
src="<?php echo $editAdmin['adminIMG']; ?>"
class="profile-image">



<div class="form-group">


<label>

<i class="fa fa-image"></i>

Change Image

</label>


<input
type="file"
name="image"
accept="image/*">


</div>


</div>






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


<input
type="text"
name="adminFullname"
value="<?php echo $editAdmin['adminFullname']; ?>">


</div>





<div class="form-group">


<label>

<i class="fa fa-user-tag"></i>

Username

</label>


<input
type="text"
name="adminUsername"
value="<?php echo $editAdmin['adminUsername']; ?>">


</div>





<div class="form-group">


<label>

<i class="fa fa-envelope"></i>

Email

</label>


<input
type="email"
name="adminEmail"
value="<?php echo $editAdmin['adminEmail']; ?>">


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
class="save-btn">


<i class="fa fa-save"></i>

Save Changes


</button>



<a
href="../admin/admins.php"
class="cancel-btn">


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