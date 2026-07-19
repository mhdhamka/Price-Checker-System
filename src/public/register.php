<?php

session_start();

include("../config/db_cPCS.php");


if(isset($_POST['register']))
{

    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Check duplicate username/email

    $check = "
    SELECT * FROM student 
    WHERE username='$username'
    OR email='$email'
    ";


    $result = mysqli_query($conn,$check);


    if(mysqli_num_rows($result)>0)
    {

        $error = "Username or Email already exists.";

    }

    else
    {


        // Default profile image

        $image = "../../assets/images/profile/default.png";


        $sql = "
        INSERT INTO student
        (
            fullName,
            username,
            email,
            password,
            studentIMG,
            logStatus
        )

        VALUES
        (
            '$fullName',
            '$username',
            '$email',
            '$password',
            '$image',
            0
        )
        ";


        if(mysqli_query($conn,$sql))
        {

            $success="Registration successful. Please login.";

        }

        else
        {

            $error="Registration failed.";

        }


    }


}


?>


<!DOCTYPE html>

<html lang="en">


<head>
    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        Register - Price Checker System
    </title>

    <link rel="icon" href="../../assets/images/logo.png">
    <link rel="stylesheet" href="../../assets/css/register.css">

</head>

<body>

    <div class="register-box">

        <img src="../../assets/images/logo.png"
        class="register-logo">

        <h2>
        Create Account
        </h2>

        <p class="subtitle">
            Join Price Checker System
        </p>

        <?php

        if(isset($error))
        {

        echo "

        <div class='message error'>
        $error
        </div>

        ";

        }

        if(isset($success))
        {

        echo "

        <div class='message success'>
        $success
        </div>

        ";

        }


        ?>





        <form method="POST">

            <div class="input-group">

                <label>
                Full Name
                </label>

                <input type="text" name="fullName" placeholder="Enter your full name" required>

            </div>

            <div class="input-group">
                <label>
                    Username
                </label>

                <input type="text" name="username" placeholder="Enter username" required>

            </div>

            <div class="input-group">
                <label>
                    Email
                </label>

                <input type="email" name="email" placeholder="Enter email" required>

            </div>

            <div class="input-group">

                <label>
                    Password
                </label>

                <input type="password" name="password" placeholder="Enter password"required>

            </div>

            <button name="register">
                Register
            </button>

        </form>


        <div class="register-links">

            <p>
                Already have an account?

                <a href="loginStudent.php">
                    Login Here
                </a>
            </p>

            <a href="loginSelection.php">
                ← Back
            </a>

        </div>




    </div>



</body>


</html>