<!---TMF 4935: Final Year Project--->
<!---Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->

<?php
if (isset($_POST['email'])) {
    $email = $_POST['email'];
  
    global $conn;
    // Connect to the database
    include "dbConnect_PCS.php";

    // Check if the email is associated with a valid account
    $query = "SELECT `studentID`, `password` FROM `student` WHERE `email`='$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
  
    if ($user) {
      // Echo the password using a JavaScript alert
      echo "<script>alert('Your password is: " . $user['password'] . "');</script>";
  
      // Redirect to the login page after 3 seconds
      header("Refresh: 1; url=loginStudent.php");
    } else {
      // Show an error message if the email is not associated with a valid account
      echo "<script>alert('Invalid email address');</script>";
    }
  }
  
?>


<head>

<!-- Additional CSS Files -->
<link rel="stylesheet" href="assets/css/styleindex.css">
<link rel="icon" href="assets/images/logo.png" type="image/x-icon">

<title>Price Checker System Student</title>

<style>
body {
  font-family: Arial, sans-serif;
  background-color: #eee;
  padding: 20px;
}

form {
  max-width: 400px;
  margin: 50px auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 8px;
  font-size: 18px;
  color: #444;
}

input[type="email"] {
  width: 100%;
  padding: 12px 20px;
  margin-bottom: 20px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

input[type="submit"] {
  width: 100%;
  background-color: #ED563B;
  color: #fff;
  padding: 14px 20px;
  margin-bottom: 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-family: Georgia, serif;
  font-size: 16px;
}

input[type="submit"]:hover {
  background-color: #4caf50;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

a {
  color: #452A5A;
  text-decoration: none;
}
  </style>
</head>

<body>
<form method="post">
<div class="top_link"><a href="loginStudent.php"><img src="https://drive.google.com/u/0/uc?id=16U__U5dJdaTfNGobB_OpwAJ73vM50rPV&export=download" alt="">Return to Login page<br><br></a></div>
  <label for="email">Email:</label>
  <p><small><i>Please fill in the the text box with email to retrieve your password.</i></small></p> 
  <input type="email" name="email" required><br>
  <input type="submit" value="Retrieve Password">
</form>

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

</body>

