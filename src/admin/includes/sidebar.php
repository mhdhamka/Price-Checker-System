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

        <!-- MANAGEMENT -->
        <li class="sidebar-dropdown <?php echo activeDropdown([
            'students.php',
            'admins.php',
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

                <!-- Admin Users -->

                <li class="<?php echo activePage('admins.php'); ?>">

                    <a href="../admin/admins.php">

                        <i class="fa fa-user-shield"></i>

                        Administrators

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




        <!-- COMMUNITY -->

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




        <!-- REPORTS -->

        <li class="<?php echo activePage('reports.php'); ?>">

            <a href="../admin/reports.php">

                <i class="fa fa-chart-line"></i>

                Reports

            </a>

        </li>





        <!-- SYSTEM -->

        <li class="sidebar-dropdown <?php echo activeDropdown([

            'backup.php',
            'systemHealth.php',
            'auditLogs.php',
            'profile.php'

        ]); ?>">


            <a href="javascript:void(0)" class="dropdown-toggle">


                <i class="fa fa-gears"></i>

                System


                <i class="fa fa-chevron-down arrow"></i>


            </a>



            <ul class="sidebar-submenu">


                <!-- Backup -->

                <li class="<?php echo activePage('backup.php'); ?>">

                    <a href="../admin/backup.php">

                        <i class="fa fa-database"></i>

                        Backup & Restore

                    </a>

                </li>




                <!-- System Health -->

                <li class="<?php echo activePage('systemHealth.php'); ?>">

                    <a href="../admin/systemHealth.php">

                        <i class="fa fa-heart-pulse"></i>

                        System Health

                    </a>

                </li>




                <!-- Audit Logs -->

                <li class="<?php echo activePage('auditLogs.php'); ?>">

                    <a href="../admin/auditLogs.php">

                        <i class="fa fa-clock-rotate-left"></i>

                        Audit Logs

                    </a>

                </li>


                <!-- Profile -->
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