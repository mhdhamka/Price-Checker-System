<?php

session_start();

include("../config/db_cPCS.php");


if(isset($_POST['login']))
{


$username = $_POST['username'];
$password = $_POST['password'];



$sql = "SELECT * FROM student 
WHERE username=? AND password=?";


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



$_SESSION['studentID']=$row['studentID'];
$_SESSION['fullName']=$row['fullName'];
$_SESSION['username']=$row['username'];
$_SESSION['email']=$row['email'];
$_SESSION['studentIMG']=$row['studentIMG'];



mysqli_query(
$conn,
"UPDATE student SET logStatus=1 
WHERE studentID=".$row['studentID']
);



header("Location: ../student/dashboard.php");

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
  <title>Student Login</title>

  <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../../assets/css/login.css">
</head>


<body>

  <div class="login-box">

  <img src="../../assets/images/logo.png">


  <h2>
    Student Login
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


    <p>
        Don't have an account?
        <a href="register.php">
            Register Here
        </a>
    </p>


    <a href="loginSelection.php">
        ← Back 
    </a>

  </div>

</body>

</html>