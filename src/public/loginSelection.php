<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Selection</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 100px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-body {
            padding: 2rem;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .btn-primary {
            background-color: #ED563B;
            border-color: #ED563B;
        }
        .btn-primary:hover {
            background-color: #ED563B;
            border-color: #ED563B;
        }
        .btn-secondary {
            background-color: #ED563B;
            border-color: #ED563B;
        }
        .btn-secondary:hover {
            background-color: #ED563B;
            border-color: #ED563B;
        }
        .btn {
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 5px;
            margin-top: 1rem;
        }
        .return-button {
            display: inline-block;
            background-color: white;
            color: #ED563B; /* Text color */
            border: 2px solid #ED563B; /* Border color */
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .return-button:hover {
            background-color: #ED563B;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Student Login</h5>
                        <p class="card-text">Access the Price Checker System as a student.</p>
                        <a href="loginStudent.php" class="btn btn-primary">Student Login</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Admin Login</h5>
                        <p class="card-text">Access the Price Checker System as an admin.</p>
                        <a href="loginAdmin.php" class="btn btn-secondary">Admin Login</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="index.php" class="return-button">Return to Home</a>
        </div>
    </div>
</body>
</html>

