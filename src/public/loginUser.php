<?php

session_start();

include __DIR__ . "/../config/db_cPCS.php";

?>


<!DOCTYPE html>

<html>

<head>

<title>
PriceWise - Login
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

      Welcome Back <span>PriceWise</span>

    </h2>

    <p class="login-subtitle">

      Sign in to compare prices and save money.

    </p>

    <form action="authenticationUser.php" method="POST">
      <div class="login-group">
        <label>
          Username
        </label>


        <input 
        type="text"
        name="username"
        placeholder="Enter username"
        required>

      </div>

      <div class="login-group">
        <label>
          Password
        </label>


        <input 
        type="password"
        name="password"
        placeholder="Enter password"
        required>

      </div>

      <button 
      class="login-btn"
      type="submit">

        Login

      </button>

    </form>



    <div class="register-link">

      Don't have an account?

      <a href="register.php">
      Register
      </a>


      </div>

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
