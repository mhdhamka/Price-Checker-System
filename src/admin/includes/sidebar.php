<?php

$currentPage = basename($_SERVER['PHP_SELF']);


function activePage($page)
{
    global $currentPage;

    return $currentPage == $page ? "active" : "";
}


function activeDropdown($pages)
{
    global $currentPage;

    return in_array($currentPage,$pages) ? "active" : "";
}

?>


<!-- Admin Sidebar -->

<div class="admin-sidebar">


    <div class="sidebar-logo">

        <a href="../admin/dashboard.php">

            <img src="../../assets/images/logo.png">

        </a>

        <h4>
            Price Checker
        </h4>

    </div>



    <ul class="sidebar-menu">



        <!-- Dashboard -->

        <li class="<?php echo activePage('dashboard.php'); ?>">

            <a href="../admin/dashboard.php">

                <i class="fa fa-home"></i>

                Dashboard

            </a>

        </li>


        <!-- =========================
             MANAGEMENT DROPDOWN
        ========================== -->

        <li class="sidebar-dropdown <?php echo activeDropdown([
            'students.php',
            'items.php',
            'stores.php',
            'categories.php'
            ]); ?>">

            <a href="javascript:void(0)" class="dropdown-toggle">


                <i class="fa fa-database"></i>

                Management


                <i class="fa fa-chevron-down arrow"></i>


            </a>

            <ul class="sidebar-submenu">

                <li class="<?php echo activePage('students.php'); ?>">

                    <a href="../admin/students.php">

                        <i class="fa fa-user-graduate"></i>

                        Students

                    </a>

                </li>

                <li class="<?php echo activePage('items.php'); ?>">

                    <a href="../admin/items.php">

                        <i class="fa fa-cart-shopping"></i>

                        Products

                    </a>

                </li>


                <li class="<?php echo activePage('stores.php'); ?>">

                    <a href="../admin/stores.php">

                        <i class="fa fa-store"></i>

                        Stores

                    </a>

                </li>

                <li class="<?php echo activePage('categories.php'); ?>">

                    <a href="../admin/categories.php">

                        <i class="fa fa-layer-group"></i>

                        Categories

                    </a>

                </li>

            </ul>

        </li>



        <!-- =========================
             COMMUNITY DROPDOWN
        ========================== -->

        <li class="sidebar-dropdown <?php echo activeDropdown([
            'ratings.php',
            'forum.php'
            ]); ?>">

            <a href="javascript:void(0)" class="dropdown-toggle">


                <i class="fa fa-users"></i>

                Community


                <i class="fa fa-chevron-down arrow"></i>


            </a>


            <ul class="sidebar-submenu">

                <li class="<?php echo activePage('ratings.php'); ?>">

                    <a href="../admin/ratings.php">

                        <i class="fa fa-star"></i>

                        Ratings

                    </a>

                </li>

                <li class="<?php echo activePage('forum.php'); ?>">

                    <a href="../admin/forum.php">

                        <i class="fa fa-comments"></i>

                        Forum

                    </a>

                </li>


            </ul>


        </li>


        <!-- =========================
             ANALYTICS
        ========================== -->


        <li>


            <a href="../admin/reports.php">


                <i class="fa fa-chart-line"></i>

                Reports


            </a>


        </li>


        <!-- =========================
             SYSTEM DROPDOWN
        ========================== -->

        <li class="sidebar-dropdown <?php echo activeDropdown([
            'backup.php',
            'profile.php'
            ]); ?>">


            <a href="javascript:void(0)" class="dropdown-toggle">


                <i class="fa fa-gears"></i>

                System


                <i class="fa fa-chevron-down arrow"></i>


            </a>


            <ul class="sidebar-submenu">

                <li class="<?php echo activePage('backup.php'); ?>">

                    <a href="../admin/backup.php">


                        <i class="fa fa-database"></i>

                        Backup & Restore


                    </a>


                </li>


                <li class="<?php echo activePage('profile.php'); ?>">


                    <a href="../admin/profile.php">


                        <i class="fa fa-user"></i>

                        Profile


                    </a>


                </li>


            </ul>



        </li>









        <!-- LOGOUT -->


        <li>


            <a href="../public/logout.php">


                <i class="fa fa-right-from-bracket"></i>

                Logout


            </a>

        </li>

    </ul>

</div>

