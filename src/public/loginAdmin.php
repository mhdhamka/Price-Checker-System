<?php

session_start();

include("../config/db_cPCS.php");
include("../config/auditLog.php");

if(isset($_POST['login']))
{

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM admin 
WHERE adminUsername=? AND adminPassword=?";

$stmt=mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param(
$stmt,
"ss",
$username,
$password
);


mysqli_stmt_execute($stmt);

$result=mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)>0)
{

$row=mysqli_fetch_assoc($result);

$_SESSION['adminID']=$row['adminID'];
$_SESSION['adminFullname']=$row['adminFullname'];
$_SESSION['adminUsername']=$row['adminUsername'];
$_SESSION['adminEmail']=$row['adminEmail'];
$_SESSION['adminIMG']=$row['adminIMG'];

mysqli_query(
$conn,
"UPDATE admin SET logStatus=1 
WHERE adminID=".$row['adminID']
);

// ================================
// AUDIT LOG - ADMIN LOGIN
// ================================

$adminID = $row['adminID'];


createAuditLog(
$conn,
$adminID,
"Admin",
"LOGIN",
"Admin Account",
"Admin logged into the system"
);


header("Location: ../admin/dashboard.php");

exit();

}
else
{

$error="Invalid username or password";

}

}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Login</title>
  
  <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../../assets/css/login.css">
</head>


<body>

  <div class="login-box">

  <img src="../../assets/images/logo.png">


  <h2>
    Admin Login
  </h2>



  <?php

  if(isset($error))
  {

  echo "<p class='error'>$error</p>";

  }

  ?>

  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <button name="login">
      Login
    </button>
  </form>

  <div class="login-links">


    <a href="forgotPassword.php">
        Forgot Password?
    </a>

    <br><br>

    <a href="loginSelection.php">
        ← Back 
    </a>

  </div>

</body>

</html>