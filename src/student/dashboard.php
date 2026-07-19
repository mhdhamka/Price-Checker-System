<?php session_start();?>

<script type="text/javascript">
  window.onload = function() {
    alert("Welcome Back, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>");
  }
</script>

<?php 
include ("../config/db_cPCS.php");

// Assign session variables with checks for existence
$studentID = isset($_SESSION['studentID']) ? $_SESSION['studentID'] : '';
$fullName = isset($_SESSION['fullName']) ? $_SESSION['fullName'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$password = isset($_SESSION['password']) ? $_SESSION['password'] : '';

// Ensure session variables are set (if they are not, they will remain as empty strings)
$_SESSION['studentID'] = $studentID;
$_SESSION['fullName'] = $fullName;
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;

// Check if the username session variable is set and generate the appropriate alert message
if(isset($_SESSION['username']) && $_SESSION['username'] !== ''){
    echo '<script type="text/javascript">
      window.onload = function() {
        alert("Welcome Back, <?php echo "$username"; ?>");
      }
    </script>';
} else {
    echo '<script type="text/javascript">
      window.onload = function() {
        alert("You have not logged in successfully");
      }
    </script>'; 
}
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
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

</head>
    
<body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    

    <?php
			global $conn;
			$sql = "SELECT * FROM student WHERE logStatus = 1;";
			$result = mysqli_query($conn, $sql);
			
			if ($result -> num_rows > 0)
			{
				while ($row = $result -> fetch_assoc())
				{
					$username = $row["username"];
					$img = $row['studentIMG'];
				}
			}
		?>
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="indexStudent.php" class="logo"><img src="../../assets/images/logo.png"  width="90" height="90"></a>
                        

                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#compare">Filter & Compare </a></li>
                            <li class="scroll-to-section"><a href="#search">Search </a></li>
                            <li class="scroll-to-section"><a href="#why-us">Why Us</a></li>

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
    

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="../../assets/images/preview/groceryshop.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h2>Smart Shopping with</h2>
                <h2><em>PRICE CHECKER SYSTEM</em></h2>
                <p>Compare prices, discover affordable choices, and manage your budget easily.</p>
                <br><br><br>
                <h6>
                </h6>
                </div>
            </div>
        </div>
    </div>
  

    <!-- ***** Filter & Compare Start ***** -->
    <section class="section" id="compare">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">

                        <h2><em>Filter & Compare Items</em></h2>

                        <img src="../../assets/images/line-dec.png">

                        <p style="color:#000000;">
                            Compare item prices from different stores and find the best option within your budget.
                        </p>

                    </div>
                </div>
            </div>

            <!-- Hot Deals -->
            <div class="row mb-5">

                <div class="col-lg-10 offset-lg-1">

                    <h3 class="text-center mb-4">
                        <em>Hot Deals</em>
                    </h3>


                    <div class="row">

                    <?php

                    $sql = "SELECT * FROM item ORDER BY ItemPrice ASC LIMIT 3";

                    $result = mysqli_query($conn,$sql);


                    while($row = $result->fetch_assoc()){

                        echo "

                        <div class='col-lg-4 col-md-6 mb-4'>

                            <div class='deal-card'>

                                <img src='".$row['ItemImage']."'>

                                <div class='deal-content'>

                                    <h4>".$row['ItemName']."</h4>

                                    <span class='price'>
                                        RM ".$row['ItemPrice']."
                                    </span>

                                    <p>
                                        ".$row['StoreName']."
                                    </p>
                                </div>
                            </div>
                        </div>

                        ";

                    }

                    ?>


                    </div>
                </div>
            </div>

            <!-- Preview Table -->
            <div class="row">

                <div class="col-lg-10 offset-lg-1">


                <h3 class="text-center mb-4">
                    Item Preview
                </h3>

                <div class="table-responsive">

                <table class="preview-table">

                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Category</th>
                            <th>Store</th>
                            <th>Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $sql = "SELECT * FROM item LIMIT 5";

                        $result = mysqli_query($conn,$sql);


                        while($row=$result->fetch_assoc()){


                            echo "

                            <tr>

                                <td class='item-name'>
                                    <img src='".$row['ItemImage']."'>
                                    <span>".$row['ItemName']."</span>
                                </td>

                                <td>".$row['ItemCategory']."</td>


                                <td>".$row['StoreName']."</td>

                                <td>
                                    RM ".$row['ItemPrice']."
                                </td>

                            </tr>

                            ";

                        }


                        ?>


                    </tbody>


                </table>

                </div>

                <br>


                <div class="main-button">

                    <center>
                    <a href="../student/filter.php">
                        Filter & Compare
                    </a>
                    </center>

                </div>

                </div>
            </div>
        </div>

    </section>
    

    <hr>
    <!-- ***** Search Starts ***** -->
    <section class="section" id="search">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="section-heading">
                    <h2>Explore <em>Categories</em></h2>
                    <img src="../../assets/images/line-dec.png" alt="">
                    <p>Explore items from Beverages, Biscuits, and Noodles categories. Find products that match your preferences and budget.</p>
                </div>
            </div>
        </div>
        <div class="category-slider">

            <button class="slide-btn prev-btn" onclick="slideCategory(-1)">
                &#10094;
            </button>

            <div class="category-container">

                <?php
                $sql = "SELECT * FROM category";

                $result = mysqli_query($conn, $sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {

                        echo "
                        <div class='category-card'>

                            <img src='".$row['categoryIMG']."'>

                            <div class='category-content'>
                                <h4>".$row['categoryName']."</h4>
                                <p>Explore available ".$row['categoryName']." items.</p>
                            </div>

                        </div>";

                    }
                }
                ?>

            </div>

            <button class="slide-btn next-btn" onclick="slideCategory(1)">
                &#10095;
            </button>
        <br>
        </div>
        <br>
        <div class="main-button scroll-to-section">
            <center><a href="../student/search.php">Search Item</a></center>
        </div>
        <br>
    </div>
   </section>
   


   <!-- ***** Why Us Starts ***** -->
    <section class="section" id="why-us">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 offset-lg-3">

                    <div class="section-heading">

                    <h2>Why <em>Use Us</em></h2>

                    <img src="../../assets/images/line-dec.png">

                    <p>
                    Price Checker System helps students manage their spending by providing easy price comparison and affordable shopping choices.
                    </p>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">

                    <div class="why-card">

                        <i class="fa fa-search"></i>

                        <h4>Easy Price Search</h4>

                        <p>
                        Quickly search available items and discover prices from different stores.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="why-card">

                        <i class="fa fa-bar-chart"></i>

                        <h4>Smart Comparison</h4>

                        <p>
                        Compare item prices and select the best option based on your budget.
                        </p>


                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="why-card">
                        <i class="fa fa-money"></i>

                        <h4>Budget Friendly</h4>

                        <p>
                        Find affordable products and make smarter purchasing decisions.
                        </p>

                    </div>
                </div>
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
                        <a href="#top">
                            Home
                        </a>
                        |
                        <a href="#compare">
                            Filter & Compare
                        </a>
                        |
                        <a href="#search">
                            Search
                        </a>
                        |
                        <a href="#why-us">
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

    <script>
        function slideCategory(direction){

            const container = document.querySelector(".category-container");
            container.scrollLeft += direction * 350;

        }
    </script>

  </body>
</html>