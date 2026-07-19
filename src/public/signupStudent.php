<?php 
include ("../config/db_cPCS.php");

if(isset($_POST['register'])){
  $fullName = $_POST['fullName'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['pswd2'];

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<script type="text/javascript"> window.onload = function () { alert("Invalid email format!"); } </script>';
  } 
  // Validate password match
  elseif ($password !== $confirmPassword) {
    echo '<script type="text/javascript"> window.onload = function () { alert("Passwords do not match!"); } </script>';
  } else {
    // Handle file upload
    $targetDir = "../../assets/images/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
      // Upload file to server
      if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
        $image = $targetFilePath;
      } else {
        echo "Sorry, there was an error uploading your file.";
        $image = "../../assets/images/default.png"; // Default image if upload fails
      }
    } else {
      echo 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
      $image = "../../assets/images/default.png"; // Default image if invalid file type
    }

    global $conn;
    $select = mysqli_query($conn, "SELECT * FROM `student` WHERE username = '$username'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
      echo '<script type="text/javascript"> window.onload = function () { alert("Username already exists! Please choose another username."); } </script>'; 
    }else{
      // Insert new student record with logstatus set to 0
      $query = "INSERT INTO `student`(`fullName`, `username`, `email`, `password`, `studentIMG`, `logstatus`)
                VALUES('$fullName', '$username', '$email', '$password', '$image', '0')";
      
      if(mysqli_query($conn, $query)) {
        echo '<script type="text/javascript"> window.onload = function () { alert("You have successfully registered!"); } </script>'; 
      } else {
        echo '<script type="text/javascript"> window.onload = function () { alert("Failed to register. Please try again later."); } </script>'; 
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Price Checker System Student</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<link rel="stylesheet" href="../../assets/css/styleindex.css">
<link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

<script>
    function validate(){
        const password = document.getElementById("pswd1").value;
        const confirmPassword = document.getElementById("pswd2").value;
        const email = document.getElementById("email").value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return false;
        }

        if (!emailPattern.test(email)) {
            alert("Invalid email format!");
            return false;
        }

        return true;
    }
</script>

<script type="text/javascript" src="formValidation.js"></script>

<style>
.message{
  position: sticky;
  top:0; left:0; right:0;
  padding:15px 10px;
  background-color: var(--white);
  text-align: center;
  z-index: 1000;
  box-shadow: var(--box-shadow);
}

body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
  display:flex;
  align-items:center;
  justify-content:center;
}

* {
   padding:0;
  margin:0;
  box-sizing: border-box;
}


/* Add padding to containers */
.signupcontainer {
  background: linear-gradient(-45deg, #dcd7e0, #fff);
  display:flex;
  flex-direction: column;
  justify-content:space-evenly;
  padding: 38px;
  background-color: white;
  font-family: 'Poppins', sans-serif;
  margin-top: 50px;
  width: 780px;
}

input[type=text], input[type=password], input[type=email], select[id="state"], input[id="gender"]{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: white;
}

input[type=text]:focus, input[type=password]:focus, input[type=email]:focus {
  background-color:white;
  outline: none;
}

hr {
  border: 1px solid #ffffff;
  margin-bottom: 25px;
}

.option{
  display: inline-flex;
  align-items: center;
  justify-content: space-evenly;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  box-shadow:0 7px 15px rgba(22,5,107,.3)
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.clear {
  padding: 14px 20px;
  background-color: #f44336;
}

.register {
  background-color: #16056b;
  padding: 14px 20px;
}

.clear, .register {
  float: left;
  width: 50%;
}

a {
  color: dodgerblue;
}
</style>
</head>
<body>
<form method="post" name="reg_form" onsubmit="return validate();" enctype="multipart/form-data"> 
  <div class="signupcontainer">
    <div class="top_link"><a href="index.php"><img src="https://drive.google.com/u/0/uc?id=16U__U5dJdaTfNGobB_OpwAJ73vM50rPV&export=download" alt="">Return home</a></div>
    <h1>Sign Up</h1>
    <br>
    <p>Already have an account? <a href="loginStudent.php">Login</a></p><br>
    <hr>

    <input type="text" placeholder="Enter Full Name" name="fullName" id="fullName" style="text-transform: capitalize;" required>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>
    <p><small><i>Email format: qiu_unimas@gmail.com </i></small></p> 
    <input type="email" placeholder="Enter Email Address" name="email" id="email" required>
    <p><small><i>Password: Minimum 6 characters, 1 uppercase, 1 lowercase, 1 special character, 1 number, & no spaces.</i></small></p>
    <input type="password" placeholder="Password" name="password" id="pswd1" required> 
    <input type="password" placeholder="Confirm Password" name="pswd2" id="pswd2" required>
    <input type="file" name="image" id="image" required> 
    <br>
    <hr>
    <div class="check-box">
      <button type="reset" class="clear">Clear</button>
      <button type="submit" name="register" class="register">Sign Up</button>
    </div>
  </div>
  <!-- ***** Footer Start ***** -->
  <footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <p>Copyright &copy; 2024 Price Checker System - Distributed by Faculty of Computer Science & Information Technology (FCSIT), UNIMAS</p>
      </div>
    </div>
  </div>
  </footer>
<!-- ***** Footer End ***** -->
</form>

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


