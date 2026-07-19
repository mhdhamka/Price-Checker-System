<?php
	session_start();
	include ("../config/db_cPCS.php");

	if (isset($_POST['submit'])) {
		$username_email = $_POST['username'];
		$password = $_POST['password'];

		// Check if the input is in email format
		if (filter_var($username_email, FILTER_VALIDATE_EMAIL)) {
			// Input is an email
			$sql = "SELECT * FROM admin WHERE adminEmail = '$username_email'";
		} else {
			// Input is a username
			$sql = "SELECT * FROM admin WHERE adminUsername = '$username_email'";
		}

		$result = mysqli_query($conn, $sql);

		if ($result && mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);

			// Verify the password
			if ($password == $row['adminPassword']) {
				// Set session variables
				$_SESSION['adminUsername'] = $row['adminUsername'];
				$_SESSION['adminID'] = $row['adminID'];

				// Update logStatus to 1
				$update_sql = "UPDATE admin SET logStatus = 1 WHERE adminID = '{$row['adminID']}'";
				$update_result = mysqli_query($conn, $update_sql);

				if ($update_result) {
					header("Location: indexAdmin.php");
					exit;
				} else {
					echo "<script>alert('Error updating logStatus');</script>";
				}
			} else {
				echo "<script>alert('Invalid Password');</script>";
			}
		} else {
			echo "<script>alert('Invalid Username/Email');</script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Price Checker System Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="top_link"><a href="../public/index.php"><img src="https://drive.google.com/u/0/uc?id=16U__U5dJdaTfNGobB_OpwAJ73vM50rPV&export=download" alt="">Return home</a></div>
                    <br>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="loginAdmin.php" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin</h3>
                            </a>
                            <h3>Log In</h3>
                        </div>
						<form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" name="username" placeholder="Username or Email" required>
								<label for="floatingInput">Username or Email</label>
							</div>
							<div class="form-floating mb-4">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
								<label for="floatingPassword">Password</label><br>
                                <span class="psw">Forgot <a href="resetPasswordAdmin.php" class="forgot-password-link">password?</a></span>
							</div>
							<button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Log In</button>
						</form>
                        <p class="text-center mb-0">Don't have an Account? <a href="signupAdmin.php">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="../../https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../../https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/chart/chart.min.js"></script>
    <script src="../../lib/easing/easing.min.js"></script>
    <script src="../../lib/waypoints/waypoints.min.js"></script>
    <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../js/main.js"></script>
</body>

</html>



