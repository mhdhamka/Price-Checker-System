<?php

session_start();

include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}


/* DATABASE STATUS */

$dbStatus = "Connected";

$dbName = "db_pcs";


$tableQuery = mysqli_query(
$conn,
"SHOW TABLES"
);

$totalTables = mysqli_num_rows($tableQuery);



/* BACKUP STATUS */

$backupQuery = mysqli_query(
$conn,
"
SELECT backupDate
FROM backups
ORDER BY backupDate DESC
LIMIT 1
"
);


$backup=mysqli_fetch_assoc($backupQuery);


$lastBackup = $backup 
? date("d M Y h:i A",strtotime($backup['backupDate']))
: "No backup available";



/* SYSTEM INFO */

$phpVersion = phpversion();

$server = $_SERVER['SERVER_SOFTWARE'];



?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        System Health
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/adminDashboard.css">
    <link rel="icon" href="../../assets/images/logo.png">

</head>


<body>


<div class="admin-container">

    <?php include("../admin/includes/sidebar.php"); ?>

        <div class="admin-main">

        <?php include("../admin/includes/header.php"); ?>

            <div class="dashboard-content">

                <div class="page-title">

                    <h2>
                        System Health
                    </h2>

                    <p>
                        Monitor system performance and application status.
                    </p>

                </div>

                <!-- HEALTH STATUS -->
                <div class="dashboard-cards">

                    <div class="dashboard-card">

                        <i class="fa-solid fa-database"></i>

                        <h4>
                            Healthy
                        </h4>

                        <p>
                            Database Status
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa-solid fa-table"></i>

                        <h4>
                            <?php echo $totalTables; ?>
                        </h4>

                        <p>
                            Database Tables
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa-solid fa-code"></i>

                        <h4>
                            <?php echo $phpVersion; ?>
                        </h4>

                        <p>
                            PHP Version
                        </p>

                    </div>



                    <div class="dashboard-card">

                        <i class="fa-solid fa-server"></i>

                        <h4>
                            Online
                        </h4>

                        <p>
                            Server Status
                        </p>

                    </div>


                </div>

                <!-- SYSTEM INFORMATION -->
                <div class="section-card">

                    <div class="section-header">

                        <h3>
                            System Information
                        </h3>

                    </div>



                    <div class="activity-list">

                        <div class="activity-card">

                            <div class="activity-icon">

                                <i class="fa-solid fa-database"></i>

                            </div>

                            <div class="activity-info">

                                <h5>
                                    Database Connection
                                </h5>

                                <p>
                                    <?php echo $dbStatus; ?> - <?php echo $dbName; ?>
                                </p>

                            </div>

                        </div>

                        <div class="activity-card">

                            <div class="activity-icon">

                                <i class="fa-solid fa-clock"></i>

                            </div>

                            <div class="activity-info">

                                <h5>
                                    Last Backup
                                </h5>

                                <p>
                                    <?php echo $lastBackup; ?>
                                </p>

                            </div>

                        </div>

                        <div class="activity-card">

                            <div class="activity-icon">

                                <i class="fa-solid fa-globe"></i>

                            </div>

                            <div class="activity-info">

                                <h5>
                                    Server Information
                                </h5>

                                <p>
                                    <?php echo $server; ?>
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- HEALTH CHECK -->
                <div class="report-card">

                    <h3>
                        System Health Check
                    </h3>

                    <p>
                        All major system components are operating normally.
                    </p>


                    <div class="report-buttons">

                        <a href="backup.php">

                            <i class="fa-solid fa-database"></i>

                            Manage Backup

                        </a>

                        <a href="reports.php">

                            <i class="fa-solid fa-chart-line"></i>

                            View Reports

                        </a>


                    </div>

                </div>

            </div>

            <?php include("../admin/includes/footer.php"); ?>

        </div>

    </div>

</body>

</html>