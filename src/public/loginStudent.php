<?php 
session_start();

include "../config/db_cPCS.php";

if(isset($_POST['login'])){
    $username_email = $_POST['username'];
    $password = $_POST['password'];

    global $conn;

    // Check if the input is in email format
    if (filter_var($username_email, FILTER_VALIDATE_EMAIL)) {
        // Input is an email
        $sql = mysqli_query($conn, "SELECT * FROM `student` WHERE email = '$username_email' AND password = '$password'") or die('query failed');
    } else {
        // Input is a username
        $sql = mysqli_query($conn, "SELECT * FROM `student` WHERE username = '$username_email' AND password = '$password'") or die('query failed');
    }

    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);

        // Update logstatus to 1 for the logged-in user
        $studentID = $row['studentID'];
        mysqli_query($conn, "UPDATE `student` SET logstatus = '1' WHERE studentID = '$studentID'") or die('update query failed');

        // Store user details in session
        $_SESSION['studentID'] = $row['studentID'];
        $_SESSION['fullName'] = $row['fullName'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['mobileNo'] = $row['mobileNo'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['address'] = $row['address'];

        header("Location: ../student/dashboard.php");
        exit();
    } else {
        echo '<script>alert("INVALID USERNAME OR PASSWORD!");</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/styleindex.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">
    
    <title>Price Checker Systems Student</title>

<style>
img{
  width: 100%;
}
.login {
    height: 650px;
    width: 100%;
    background-image: url('assets/images/background.png');
  
}
.login_box {
    width: 1050px;
    height: 600px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background: #fff;
    border-radius: 10px;
    box-shadow: 1px 4px 22px -8px #0004;
    display: flex;
    overflow: hidden;
}
.login_box .left{
  width: 41%;
  height: 100%;
  padding: 25px 25px;
  
}
.login_box .right{
  width: 59%;
  height: 100%  
}
.left .top_link a {
    color: #452A5A;
    font-weight: 400;
}
.left .top_link{
  height: 20px
}
.left .contact{
  display: flex;
    align-items: center;
    justify-content: center;
    align-self: center;
    height: 100%;
    width: 73%;
    margin: auto;
}
.left h3{
  text-align: center;
  margin-bottom: 40px;
}
.left input {
    border: none;
    width: 80%;
    margin: 15px 0px;
    border-bottom: 1px solid #4f30677d;
    padding: 7px 9px;
    width: 100%;
    overflow: hidden;
    background: transparent;
    font-weight: 600;
    font-size: 14px;
}
.left{
  background: linear-gradient(-45deg, #dcd7e0, #fff);
}
.submit {
    border: none;
    padding: 15px 90px;
    border-radius: 8px;
    display: block;
    margin: auto;
    margin-top: 45px;
    background: #ED563B;
    color: #fff;
    font-weight: bold;
    -webkit-box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
    -moz-box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
    box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
}

.right {
  background-color: #fff ;
  color: #fff;
  position: relative;
  margin: 15px;
}

.right .right-text{
  height: 100%;
  position: relative;
  transform: translate(0%, 45%);
}
.right-text h2{
  display: block;
  width: 100%;
  text-align: center;
  font-size: 50px;
  font-weight: 500;
}
.right-text h5{
  display: block;
  width: 100%;
  text-align: center;
  font-size: 19px;
  font-weight: 400;
}

.right .right-inductor{
  position: absolute;
  width: 70px;
  height: 7px;
  background: #fff0;
  left: 50%;
  bottom: 70px;
  transform: translate(-50%, 0%);
}
.top_link img {
    width: 28px;
    padding-right: 7px;
    margin-top: -3px;
}




</style>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body>
  <section class="login">
    <div class="login_box">
      <div class="left">
        <div class="top_link"><a href="../public/index.php">Return home</a></div>
        <div class="contact">
          <form method="post">
            <h3>Log In</h3>
            <input type="text" placeholder="USERNAME OR EMAIL" name="username" required>
            <input type="password" placeholder="PASSWORD" name="password" required>
            <br>
            <span class="psw">Forgot <a href="resetPasswordStudent.php">password?</a></span>

            <button class="submit" name="login" id="login">LOG IN</button><br><br>
            
            <hr>
            <span class="psw">No account yet? Sign up <a href="signupStudent.php">here</a></span>
          </form>
        </div>
      </div>
      <div class="right">
        <img src="../../assets/images/logo.png" alt="">
        <div class="right-text">

          <img src="../../assets/images/logo.png" alt="">

        </div>
      </div>
    </div>
  </section>
 


     <!-- jQuery -->
    <script src="../../assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="../../assets/js/popper.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="../../assets/js/scrollreveal.min.js"></script>
    <script src="../../assets/js/waypoints.min.js"></script>
    <script src="../../assets/js/jquery.counterup.min.js"></script>
    <script src="../../assets/js/imgfix.min.js"></script> 
    <script src="../../assets/js/mixitup.js"></script> 
    <script src="../../assets/js/accordions.js"></script>
    <script src="../../assets/js/slideshow.js"></script>
    <!-- Global Init -->
    <script src="../../assets/js/custom.js"></script>
</body>
</html>
