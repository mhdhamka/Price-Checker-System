<?php

session_start();

include "../config/db_cPCS.php";


// Check login

if(!isset($_SESSION['userID'])){

    header("Location: ../loginUser.php");

    exit();

}


$username=$_SESSION['username'];

?>


<!DOCTYPE html>

<html>

<head>
    <title>
        PriceWise Dashboard
    </title>

    <link rel="stylesheet" href="../../assets/css/user-dashboard.css">
    <link rel="stylesheet" href="../../assets/css/user-header.css">
    <link rel="stylesheet" href="../../assets/css/user-footer.css">
</head>


<body>

<header class="user-header">
    <div class="container">
        <nav class="user-navbar">
            <a href="dashboard.php" class="user-logo">
                <img src="../../assets/images/logo.png">

                <span>
                    PriceWise
                </span>
            </a>

            <ul class="user-nav">
                <li>
                    <a href="dashboard.php">
                        Dashboard
                    </a>
                </li>


                <li>
                    <a href="products.php">
                        Products
                    </a>
                </li>


                <li>
                    <a href="compare.php">
                        Compare
                    </a>
                </li>


                <li>
                    <a href="wishlist.php">
                        Wishlist
                    </a>
                </li>


                <li>
                    <a href="profile.php">
                        Profile
                    </a>
                </li>
            </ul>

            <div class="user-account">
                <span>
                    <?php echo $_SESSION['username'] ?? "User"; ?>
                </span>

                <a href="../logout.php">
                    Logout
                </a>
            </div>
        </nav>
    </div>
</header>