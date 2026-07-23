<?php
session_start();
include("../config/db_cPCS.php");

// Check if user is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: ../public/loginStudent.php"); 
    exit();
}

$studentID = $_SESSION['studentID'];

// Get logged-in student's information
$sql = "SELECT * FROM student WHERE studentID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $studentID);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Student record not found.");
}

$row = mysqli_fetch_assoc($result);

// Store commonly used values
$username = $row['username'];
$img = $row['studentIMG'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Price Checker System Student</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/styleStudent.css">
    <link rel="stylesheet" href="../../assets/css/profileStudent.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

</head>
    
<body>

    <?php
    global $conn;

    $sql = "
    SELECT username, studentIMG
    FROM student
    WHERE studentID = '$studentID'
    ";

    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        $username = $user['username'];
        $img = $user['studentIMG'];
    }
    else
    {
        $username = "Student";
        $img = "../../assets/images/profile/default.png";
    }
    ?>
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="../student/dashboard.php" class="logo"><img src="../../assets/images/logo.png"  width="90" height="90"></a>
                        

                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="../student/dashboard.php#top">Home</a></li>
                            <li class="scroll-to-section"><a href="../student/dashboard.php#compare">Compare </a></li>
                            <li class="scroll-to-section"><a href="../student/dashboard.php#search">Products</a></li>
                            <li class="scroll-to-section"><a href="../student/dashboard.php#tools">Tools</a></li>
                            <li class="scroll-to-section"><a href="../student/dashboard.php#trend">Trending</a></li>
                            <li class="scroll-to-section"><a href="../student/dashboard.php#community">Community</a></li>
                            <li class="scroll-to-section"><a href="../student/dashboard.php#why-us">About</a></li>

                            <form method="post">
                                <div class="icons">
                                    <div class="dropdown">
                                    <img src="<?php echo $img; ?>" width="40" height="40" class="rounded-circle">
                                      <div class="dropdown-content">
                                        <a href="../student/profile.php">My Profile</a>
                                        <a href="../public/logout.php" name="logout">Log Out</a>
                                      </div>
                                    </div>
                                </form>
                                </div>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        
                    </nav>
                </div>
            </div>
        </div>
    </header>
  

    <!-- ***** Update Profile Start ***** -->
    <section class="section" id="compare">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">

                        <h2>
                            Update <em>Profile</em>
                        </h2>

                        <img src="../../assets/images/line-dec.png">

                        <p>
                            Keep your personal information up to date.
                        </p>

                    </div>
                </div>
            </div>

            <div class="profile-card">

                <form action="../student/updateProfile.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="studentID" value="<?php echo $row['studentID']; ?>">

                    <div class="profile-image">

                        <img src="<?php echo $row['studentIMG']; ?>" id="previewImage">

                    </div>

                    <div class="text-center">

                        <input type="file" name="studentIMG" onchange="preview(this)">

                    </div>

                    <div class="form-group">

                        <label>

                            Full Name

                        </label>

                        <input type="text" name="fullName" class="form-control" value="<?php echo $row['fullName']; ?>">

                    </div>

                    <div class="form-group">
                        <label>
                            Username
                        </label>

                        <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">
                    </div>

                    <div class="form-group">
                        <label>
                            Email
                        </label>

                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                    </div>

                    <div class="form-group">

                        <label>New Password</label>

                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            minlength="8"
                            placeholder="Leave blank to keep your current password">

                        <small class="text-muted">
                            Password must contain at least 8 characters.
                        </small>

                    </div>

                    <div class="text-center mt-4">
                        <button class="save-btn">
                            Save Changes
                        </button>

                        <a href="dashboard.php" class="cancel-btn">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
            
        </div>

    </section>
    
    
    <br>

    <!-- ***** Footer Start ***** -->
    <footer>

        <div class="container">
            <div class="row">
                <div class="col-lg-4">

                <h4>
                    Price Checker System
                </h4>

                <p>
                    Helping students compare prices and make smarter shopping decisions.
                </p>

                </div>

                <div class="col-lg-4">

                    <h4>
                        Quick Links
                    </h4>

                    <p>
                        <a href="dashboard.php">
                            Home
                        </a>
                        |
                        <a href="filter.php">
                            Filter & Compare
                        </a>
                        |
                        <a href="search.php">
                            Search
                        </a>
                        |
                        <a href="dashboard.php#why-us">
                            Why Us
                        </a>
                    </p>

                </div>

                <div class="col-lg-4">
                    <h4>
                        Developed By
                    </h4>

                    <p>
                        Mohd Hamka
                    <br>
                        Universiti Malaysia Sarawak (UNIMAS)
                    </p>
                </div>

                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>
                        Copyright &copy; 2024 Price Checker System. All Rights Reserved.
                        </p>
                    </div>
                </div>
        </div>
    </footer>

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
    <script src="../../assets/js/profileStudent.js"></script>

  </body>
</html>

