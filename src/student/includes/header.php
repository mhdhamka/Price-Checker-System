<?php

$currentPage = basename($_SERVER['PHP_SELF']);

function activePage($page)
{
    global $currentPage;

    return $currentPage == $page ? "active" : "";
}

$isDashboard = ($currentPage == "dashboard.php");

?>

<header class="header-area header-sticky">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <nav class="main-nav">


                    <!-- LOGO -->

                    <a href="../student/dashboard.php" class="logo">

                        <img src="../../assets/images/logo.png">

                    </a>



                    <!-- NAVIGATION -->

                    <ul class="nav">


                        <li>

                            <a href="<?php echo $isDashboard ? '#top' : '../student/dashboard.php#top'; ?>"
                               class="<?php echo $isDashboard ? 'active' : ''; ?>">

                                Home

                            </a>

                        </li>


                        <li>

                            <a href="<?php echo $isDashboard ? '#compare' : '../student/dashboard.php#compare'; ?>">

                                Compare

                            </a>

                        </li>


                        <li>

                            <a href="<?php echo $isDashboard ? '#search' : '../student/dashboard.php#search'; ?>">

                                Products

                            </a>

                        </li>


                        <li>

                            <a href="<?php echo $isDashboard ? '#tools' : '../student/dashboard.php#tools'; ?>">

                                Tools

                            </a>

                        </li>


                        <li>

                            <a href="<?php echo $isDashboard ? '#trend' : '../student/dashboard.php#trend'; ?>">

                                Trending

                            </a>

                        </li>


                        <li>

                            <a href="<?php echo $isDashboard ? '#community' : '../student/dashboard.php#community'; ?>">

                                Community

                            </a>

                        </li>


                        <li>

                            <a href="<?php echo $isDashboard ? '#why-us' : '../student/dashboard.php#why-us'; ?>">

                                About

                            </a>

                        </li>


                    </ul>



                    <!-- USER ACTION -->

                    <div class="user-actions">


                        <button id="themeToggle" 
                                class="theme-btn" 
                                type="button">

                            <i class="fa-solid fa-moon"></i>

                        </button>



                        <div class="dropdown">


                            <img src="<?php echo $img; ?>" 
                                 class="profile-avatar">



                            <div class="dropdown-content">


                                <a href="../student/profile.php"
                                   class="<?php echo activePage('profile.php'); ?>">

                                    <i class="fa fa-user"></i>

                                    My Profile

                                </a>


                                <a href="../public/logout.php">

                                    <i class="fa fa-right-from-bracket"></i>

                                    Logout

                                </a>


                            </div>


                        </div>


                    </div>




                    <!-- MOBILE MENU -->

                    <a class="menu-trigger">

                        <span>
                            Menu
                        </span>

                    </a>


                </nav>

            </div>

        </div>

    </div>

</header>