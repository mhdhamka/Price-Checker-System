<?php

session_start();

include("../config/db_cPCS.php");


if(isset($_POST['reset']))
{
    
    $email=$_POST['email'];
    $type=$_POST['type'];
    $newPassword=$_POST['password'];

    if($type=="student")
    {

    $sql="
    UPDATE student 
    SET password='$newPassword'
    WHERE email='$email'
    ";

    }
    else
    {

    $sql="
    UPDATE admin 
    SET adminPassword='$newPassword'
    WHERE adminEmail='$email'
    ";

    }

    $result=mysqli_query($conn,$sql);

    if(mysqli_affected_rows($conn)>0)
    {

    $message="Password updated successfully.";

    }

    else
    {

    $message="Email not found.";

    }

}

?>


<!DOCTYPE html>

<html>

<head>
    <title>
        Forgot Password
    </title>

    <link rel="stylesheet" href="../../assets/css/login.css">

</head>



<body>

    <div class="login-box">

        <img src="../../assets/images/logo.png">


        <h2>
        Reset Password
        </h2>



        <?php

        if(isset($message))
        {

        echo "<p class='error'>
        $message
        </p>";

        }

        ?>

        <form method="POST">

            <input type="email" name="email" placeholder="Email Address" required>

            <select name="type" class="form-control" required>
                <option value="student">
                    Student Account
                </option>

                <option value="admin">
                    Admin Account
                </option>
            </select>

            <input type="password" name="password" placeholder="New Password" required>

            <button name="reset">
                Reset Password
            </button>

        </form>

        <div class="login-links">
            <a href="loginSelection.php">
                ← Back to Login
            </a>
        </div>

    </div>

</body>


</html>