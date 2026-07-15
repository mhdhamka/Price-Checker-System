<!---TMF 4935: Final Year Project--->
<!---Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->

<?php
session_start();
include "dbConnect_PCS.php";

global $conn;

// Check for errors
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$studentID = $_SESSION['studentID'];
$fullName = $_SESSION['fullName'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Check if the form was submitted
if (isset($_POST['update'])) {
    // Escape special characters to prevent SQL injection
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Handle image upload
    $target_dir = "assets/images/"; // Directory where images will be stored
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // Use original file name

    $uploadOk = 1;

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo '<script>alert("File is not an image.");</script>';
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo '<script>alert("Sorry, your file is too large.");</script>';
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script>alert("Sorry, your file was not uploaded.");</script>';
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $imagePath = $target_file;

            // Build the update query
            $query = "UPDATE `student` SET `fullName` = '$fullName', `email` = '$email', `studentIMG` = '$imagePath' WHERE `studentID` = '$studentID'";

            // Execute the query
            if (mysqli_query($conn, $query)) {
                // Update the session variables with the new user information
                $_SESSION['fullName'] = $fullName;
                $_SESSION['email'] = $email;
                $_SESSION['studentIMG'] = $imagePath; // Update session with new image path

                echo '<script>alert("Record updated successfully!");</script>';
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file.");</script>';
        }
    }
}

// Get the student's information from the database
$query = "SELECT * FROM student WHERE studentID = '{$_SESSION['studentID']}'";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Price Checker System Student</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styleindex.css">
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">

    <script type="text/javascript" src="formValidation.js"></script>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            background: linear-gradient(-45deg, #dcd7e0, #fff);
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            padding: 35px;
            background-color: white;
            font-family: 'Poppins', sans-serif;
            margin-top: 50px;
            width: 600px;
        }

        input[type=text],
        input[type=password],
        input[type=email],
        select[id="state"],
        input[id="gender"] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: white;
        }

        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus {
            background-color: white;
            outline: none;
        }

        hr {
            border: 1px solid #ffffff;
            margin-bottom: 25px;
        }

        .option {
            display: inline-flex;
            margin-top: 10px;
            justify-content: space-evenly;
        }

        button {
            background-color: #04AA6D;
            color: white;
            padding: 20px 24px; /* Increased padding for bigger buttons */
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            box-shadow: 0 7px 15px rgba(22, 5, 107, .3);
            font-size: 18px; /* Increased font size */
        }

        button:hover {
            opacity: 1;
        }

        /* Extra styles for the cancel button */
        .clear {
            padding: 20px 24px; /* Increased padding */
            background-color: #f44336;
        }

        .saveprofile {
            background-color: #16056b;
            padding: 20px 24px; /* Increased padding */
        }

        .clear,
        .saveprofile {
            width: 45%; /* Adjust the width as needed */
            float: left;
            margin-right: 10px; /* Add some space between buttons */
        }

        .saveprofile {
            float: right;
        }

        .avatar {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 150px; /* Adjust size as needed */
            height: 150px; /* Maintain aspect ratio */
            border-radius: 50%;
        }

        a {
            color: dodgerblue;
        }
    </style>
</head>

<body>
    <form method="post" name="update" enctype="multipart/form-data" onsubmit="return validate();">
        <div class="container">
            <div class="top_link">
                <a href="indexStudent.php" style=" color: #452A5A; font-weight: 350;">
                    Return home
                </a>
            </div>
            <h3 style="text-align:center"> Student Profile </h3><br>
            <div class="row mb-3">
                <center><img class="avatar" src="<?php echo $student['studentIMG']; ?>" alt="Profile Picture"></center>
            </div><br>

            <h5>Full Name: <?php echo $student['fullName']; ?></h5>
            <input type="text" placeholder="Click Here To Edit" name="fullName" id="fullName" value="<?php echo $student['fullName']; ?>">

            <h5>Username: <?php echo $student['username']; ?></h5>
            <input type="text" placeholder="Click Here To Edit" name="username" id="username" value="<?php echo $student['username']; ?>">

            <h5>Email: <?php echo $student['email']; ?></h5>
            <input type="email" placeholder="Click Here To Edit" name="email" id="email" value="<?php echo $student['email']; ?>">

            <h5>Password: <?php echo $student['password']; ?></h5>
            <input type="password" placeholder="Click Here To Edit" name="password" id="password" value="<?php echo $student['password']; ?>">

            <h5>Image:</h5>
            <input type="file" placeholder="Click Here To Edit" name="image" id="image" accept="image/*">

            <br>

            <div style="overflow: auto;">
                <button type="reset" class="clear">Cancel</button>
                <button type="submit" name="update" value="update" class="saveprofile">Update</button>
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
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/mixitup.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/slideshow.js"></script>
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

</body>
</html>

