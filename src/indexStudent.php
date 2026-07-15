<!---TMF 4935: Final Year Project--->
<!---Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->

<?php session_start();?>

<script type="text/javascript">
  window.onload = function() {
    alert("Welcome Back, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>");
  }
</script>

<?php 
include "dbConnect_PCS.php";

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
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/styleindex.css">
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">
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
    <!-- ***** Preloader End ***** -->

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
                        <a href="indexStudent.php" class="logo"><img src="assets/images/logo.png"  width="90" height="90"></a>
                        <!-- ***** Logo End ***** -->

                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#compare">Filter & Compare </a></li>
                            <li class="scroll-to-section"><a href="#search">Search </a></li>
                            <li class="scroll-to-section"><a href="#trainers">About us</a></li>

                            <form method="post">
                                <div class="icons">
                                    <div class="dropdown">
                                    <img src="<?php echo $img; ?>" width="40" height="40" class="rounded-circle">
                                      <div class="dropdown-content">
                                        <a href="profileStudent.php">My Profile</a>
                                        <a href="logoutStudent.php" name="logout">Log Out</a>
                                      </div>
                                    </div>
                                </form>
                                </div>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/groceryshop.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h2>Welcome to the</h2>
                <h2><em>PRICE CHECKER SYSTEM</em></h2>
                <br><br><br>
                <h6>
                </h6>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Why Us Start ***** -->
    <section class="section" id="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading">
                    <h2>This is <em>Price Checker System</em></h2>
                    <img src="assets/images/line-dec.png" alt="waves">
                    <p>The Price Checker System offers excellent reasons why you need to use this website.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="features-items">
                    <li class="feature-item">
                        <div class="left-icon">
                            <img src="assets/images/features-first-icon.png" alt="Wide Range">
                        </div>
                        <div class="right-content">
                            <h4>Wide Range of Items</h4>
                            <p>Our database covers a vast array of items across numerous categories, ensuring you can check prices for virtually anything you need.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="features-items">
                <li class="feature-item">
                        <div class="left-icon">
                            <img src="assets/images/features-first-icon.png" alt="User Friendly">
                        </div>
                        <div class="right-content">
                            <h4>User-Friendly Interface</h4>
                            <p>Enjoy an intuitive interface designed for effortless navigation and ease of use, catering to both tech-savvy professionals and casual users alike.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </section>
    <!-- ***** Why Us End ***** -->
    <hr>
    <!-- ***** Store Start ***** -->
    <section class="section" id="store">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>The <em>Store</em></h2>
                        <img src="assets/images/line-dec.png" alt="">
                        <p>Explore our system's available stores: e-Mart Summer Mall and H&L Aiman Mall. We focus on curating high-quality selections with diverse products and excellent service for a trusted shopping experience.</p>
                    </div>
                </div>
            </div>
            <div class="row" id="tabs">
              <div class="col-lg-4">
                <ul>
                  <li><a href='#tabs-1'><img src="assets/images/cart.png" alt="">
				<?php
					global $conn;
					$sql = "SELECT * FROM store WHERE storeID = 1";
					
					$result = mysqli_query($conn, $sql);
					if ($result -> num_rows > 0)
					{
						while ($row = $result -> fetch_assoc())
						{
							echo $row['StoreName'];
						}
					}
				?></a></li>
                  <li><a href='#tabs-2'><img src="assets/images/cart.png" alt="">
				<?php
					global $conn;
					$sql = "SELECT * FROM store WHERE storeID = 2";
					
					$result = mysqli_query($conn, $sql);
					if ($result -> num_rows > 0)
					{
						while ($row = $result -> fetch_assoc())
						{
							echo $row['StoreName'];
						}
					}
				?></a></a></li>
                  
                </ul>
              </div>
              <div class="col-lg-8">
                <section class='tabs-content'>
                  <article id='tabs-1'>
					<?php
						global $conn;
						$sql = "SELECT * FROM store WHERE storeID = 1";
						
						$result = mysqli_query($conn, $sql);
						if ($result -> num_rows > 0)
						{
							while ($row = $result -> fetch_assoc())
							{
								echo "<img src='".$row['storeIMG']."' alt='First Class'>
									<h4>".$row['StoreName']."</h4>
									 <p>".$row['desc1']."</p>";
							}
						}
					?>
								<script>
									function displayContactInfo() {
									  alert("Please contact our Operational Manager via Whatsapp in Contact Us section");
									}
								</script>
                  </article>
                  <article id='tabs-2'>
                    <?php
						global $conn;
						$sql = "SELECT * FROM store WHERE storeID = 2";
						
						$result = mysqli_query($conn, $sql);
						if ($result -> num_rows > 0)
						{
							while ($row = $result -> fetch_assoc())
							{
								echo "<img src='".$row['storeIMG']."' alt='First Class'>
									<h4>".$row['StoreName']."</h4>
									 <p>".$row['desc1']."</p>";
							}
						}
					?>
                  </article>
                
                </section>
              </div>
            </div>
        </div>
    </section>
    <!-- ***** Store End ***** -->
    <hr>
    <!-- ***** Filter & Compare Start ***** -->
    <section class="section" id="compare">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading dark-bg">
                    <h2><em> Filter & Compare</em></h2>
                    <img src="assets/images/line-dec.png" alt="">
                    <p style = "color: 000000;">This table displays items available in the system. Please click the button below the table to view, filter, and compare item details.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white" style="border-color: #000000; color: #000000;">
                                <th scope="col" style="border-color: #000000; color: #000000;">Item ID</th>
                                <th scope="col" style="border-color: #000000; color: #000000;">Item Name</th>
                                <th scope="col" style="border-color: #000000; color: #000000;">Item Price</th>
                                <th scope="col" style="border-color: #000000; color: #000000;">Item Category</th>
                                <th scope="col" style="border-color: #000000; color: #000000;">Item Description</th>
                                <th scope="col" style="border-color: #000000; color: #000000;">Store Name</th>
                                <th scope="col" style="border-color: #000000; color: #000000;">Item Image</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            global $conn;
                            $sql = "SELECT * FROM item LIMIT 3"; // Limiting to the first three rows

                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr style='text-align: center; border-color: #000000; color: #000000;'>
                                        <td style='border-color: #000000; color: #000000;'>".$row['ItemID']."</td>
                                        <td style='border-color: #000000; color: #000000;'>".$row['ItemName']."</td>
                                        <td style='border-color: #000000; color: #000000;'>".$row['ItemPrice']."</td>
                                        <td style='border-color: #000000; color: #000000;'>".$row['ItemCategory']."</td>
                                        <td style='border-color: #000000; color: #000000;'>".$row['ItemDescription']."</td>
                                        <td style='border-color: #000000; color: #000000;'>".$row['StoreName']."</td>
                                        <td style='border-color: #000000; color: #000000;'><img src='".$row['ItemImage']."' style='width: 100%'></td>
                                    </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="main-button scroll-to-section">
                    <center><a href="filterStudent.php">Filter & Compare</a></center>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- ***** Filter & Compare End ***** -->
    <hr>
    <!-- ***** Search Starts ***** -->
    <section class="section" id="search">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="section-heading">
                    <h2>Search <em>Item</em></h2>
                    <img src="assets/images/line-dec.png" alt="">
                    <p>The items available in the system cover the categories of Beverages, Biscuits, and Noodles. These categories are carefully selected to offer a diverse range of items, ensuring you can find a variety of choices that meet your needs and preferences. Whether you're looking for refreshing beverages, tasty biscuits, or convenient noodles, our system provides options that cater to different tastes and occasions.</p>
                </div>
            </div>
        </div>
        <div class="slideshow-container">
            <?php
            global $conn;
            $sql = "SELECT * FROM category";
                
            $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='mySlides fade'>
                                <img src='" . $row['categoryIMG'] . "' style='width:100%;'>
                                <div class='text'>" . $row['categoryName'] . "</div>
                              </div>";
                    }
                }
            ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
        <br>
        <div class="main-button scroll-to-section">
            <center><a href="searchStudent.php">Search Item</a></center>
        </div>
        <br>
    </div>
   </section>
   <!-- ***** Search End ***** -->
    <hr>
   <!-- ***** About Us Starts ***** -->
   <section class="section" id="trainers">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>About <em>Us</em></h2>
                        <img src="assets/images/line-dec.png" alt="">
                        <p>Pursuing a degree at Universiti Malaysia Sarawak (UNIMAS) equips students with valuable skills but often poses financial challenges. Many students balance limited financial aid, part-time work, loans, and scholarships to manage rising costs. Our solution, the "Price Checker System based on a Student Budget," compares prices from stores like e-Mart and H&L to help students make cost-effective purchases. This web-based tool aims to improve students' financial well-being and simplify university life.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <center>
						<?php
							global $conn;
							$sql = "SELECT * FROM aboutus";
							
							$result = mysqli_query($conn, $sql);
							if ($result -> num_rows > 0)
							{
								while ($row = $result -> fetch_assoc())
								{
									echo "<div class='col-lg-4'>
											<div class='trainer-item'>
												<div class='image-thumb'>
													<img src='".$row['aboutusIMG']."'>
												</div>
												<div class='down-content'>
													<span>".$row['aboutusCourse']."</span>
													<h4>".$row['aboutusName']."</h4>
													<p>".$row['aboutusDetails']."</p>
												</div>
											</div>
										</div>";
								}
							}
						?>
            </div>
        </div>
    </section>
    <!-- ***** About Us Ends ***** -->

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