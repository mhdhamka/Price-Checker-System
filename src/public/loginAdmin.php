<?php

session_start();

?>


<!DOCTYPE html>

<html>

<head>


<title>
PriceWise Admin Login
</title>


<link rel="stylesheet" href="../../assets/css/login.css">
<link rel="icon" href="../../assets/images/logo.png">


</head>



<body>


<div class="login-wrapper">
    <div class="login-card">

        <img 
        src="../../assets/images/logo.png"
        class="login-logo">

        <h2>

            Admin <span>Portal</span>

        </h2>

        <p class="login-subtitle">
            Manage products, stores and pricing data.
        </p>

        <form action="authenticationAdmin.php" method="POST">
            <div class="login-group">
                <label>
                    Admin Username
                </label>

                <input 
                type="text"
                name="adminUsername"
                placeholder="Enter admin username"
                required>

            </div>

            <div class="login-group">
                <label>
                    Password
                </label>

                <input 
                type="password"
                name="adminPassword"
                placeholder="Enter password"
                required>

            </div>

            <button 
            class="login-btn">

            Login

            </button>

        </form>

        <a href="loginSelection.php"
        class="back-home">

        ← Change Account Type

        </a>

        <a href="index.php"
        class="back-home">

        ← Back Homepage

        </a>
    </div>
</div>

</body>

</html>