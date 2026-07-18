<?php

include __DIR__ . "/../config/db_cPCS.php";

?>

<!DOCTYPE html>

<html>

<head>
    <title>
        PriceWise - Create Account
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
            Join <span>PriceWise</span>
        </h2>

        <p class="login-subtitle">
            Create your account and start saving smarter.
        </p>

        <form action="registerProcess.php" method="POST">
            <div class="login-group">

                <label>
                Full Name
                </label>

                <input 
                type="text"
                name="fullName"
                placeholder="Enter your full name"
                required>

            </div>

            <div class="login-group">
                <label>
                Username
                </label>

                <input 
                type="text"
                name="username"
                placeholder="Create username"
                required>

            </div>

            <div class="login-group">

                <label>
                Email Address
                </label>

                <input 
                type="email"
                name="email"
                placeholder="Enter email address"
                required>

            </div>

            <div class="login-group">

                <label>
                Password
                </label>

                <input 
                type="password"
                name="password"
                placeholder="Create password"
                required>

            </div>

            <div class="login-group">
                <label>
                Confirm Password
                </label>

                <input 
                type="password"
                name="confirmPassword"
                placeholder="Confirm password"
                required>

            </div>

            <button 
            type="submit"
            class="login-btn">

                Create Account

            </button>

        </form>

        <div class="register-link">
            Already have an account?

            <a href="loginUser.php">
                Login
            </a>
        </div>

        <a href="index.php"
        class="back-home">
            ← Back Homepage
        </a>
    </div>
</div>



</body>


</html>