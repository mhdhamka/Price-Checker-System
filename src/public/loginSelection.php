<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Selection - Price Checker System</title>

    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/loginSelection.css">

</head>


<body>

<div class="login-page">
    <div class="login-container">
        <img src="../../assets/images/logo.png"
        class="login-logo">


        <h1>
            Welcome to
            <span>Price Checker System</span>
        </h1>

        <p class="subtitle">

            Compare prices, manage your budget,
            and make smarter shopping decisions.

        </p>

        <div class="login-options">

            <!-- Student -->
            <div class="login-card student-card">

                <div class="icon-box">
                    <i class="fas fa-user-graduate"></i>
                </div>

                <h2>
                    Student
                </h2>

                <p>
                    Access item comparison,
                    search products,
                    and manage your profile.
                </p>

                <a href="loginStudent.php" class="login-btn student-btn">
                    Student Login
                </a>
            </div>

            <!-- Admin -->
            <div class="login-card admin-card">
                <div class="icon-box">
                    <i class="fas fa-lock"></i>
                </div>

                <h2>
                    Admin
                </h2>

                <p>
                    Manage items,
                    stores,
                    categories,
                    and system data.
                </p>

                <a href="loginAdmin.php" class="login-btn admin-btn">
                    Admin Login
                </a>

            </div>
        </div>

        <a href="index.php" class="home-btn">
            ← Return to Home
        </a>
    </div>
</div>

</body>

</html>
