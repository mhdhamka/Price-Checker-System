<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}


/* ==========================================
DATABASE INFORMATION
========================================== */


$databaseName = "db_pcs";


$lastBackupQuery = mysqli_query(
$conn,
"
SELECT backupDate
FROM backups
ORDER BY backupDate DESC
LIMIT 1
"
);


$lastBackupData = mysqli_fetch_assoc($lastBackupQuery);


$lastBackup = $lastBackupData 
? date("d M Y h:i A", strtotime($lastBackupData['backupDate']))
: "No backup yet";


$backupFolder = "backups/";

$latestBackup = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "
        SELECT *
        FROM backups
        ORDER BY backupDate DESC
        LIMIT 1
        "
    )
);

/* ==========================================
BACKUP HISTORY
========================================== */
$backupQuery = mysqli_query(
$conn,
"
SELECT *
FROM backups
ORDER BY backupDate DESC
"
);


if(!$backupQuery)
{
    die("Backup table error: ".mysqli_error($conn));
}


$totalBackup = mysqli_num_rows($backupQuery);


/* ==========================================
BACKUP ACTIVITIES
========================================== */

$activityQuery = mysqli_query(
$conn,
"
SELECT 
backup_logs.action,
backup_logs.actionDate,
backups.fileName,
admin.adminFullname

FROM backup_logs

JOIN backups
ON backup_logs.backupID = backups.backupID

JOIN admin
ON backup_logs.performedBy = admin.adminID

ORDER BY backup_logs.actionDate DESC

LIMIT 5
"
);


if(!$activityQuery)
{
    die(mysqli_error($conn));
}


?>


<!DOCTYPE html>

<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Backup & Restore
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

                    <!-- PAGE TITLE -->
                    <div class="page-title">
                        <h2>

                            Backup & Restore

                        </h2>

                        <p>

                            Manage database backup and recovery.

                        </p>
                    </div>

                    <!-- RESTORE SUCCESS MESSAGE -->
                    <?php

                    if(isset($_GET['restore']))
                    {

                        if($_GET['restore']=="success")
                        {

                            echo "
                            <div class='alert-success'>
                                <i class='fa fa-check-circle'></i>
                                Database restored successfully.
                            </div>
                            ";

                        }


                        if($_GET['restore']=="failed")
                        {

                            echo "
                            <div class='alert-error'>
                                <i class='fa fa-times-circle'></i>
                                Database restore failed.
                            </div>
                            ";

                        }

                    }

                    ?>


                    <!-- DATABASE STATUS CARDS -->
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

                            <i class="fa-solid fa-clock"></i>

                            <h4>
                                <?php echo $lastBackup; ?>
                            </h4>

                            <p>
                                Last Backup
                            </p>

                        </div>

                        <div class="dashboard-card">

                            <i class="fa-solid fa-file"></i>

                            <h4>
                                <?php echo $totalBackup; ?>
                            </h4>

                            <p>
                                Available Backups
                            </p>

                        </div>

                        <div class="dashboard-card">

                            <i class="fa-solid fa-server"></i>

                            <h4>
                                <?php echo $databaseName; ?>
                            </h4>

                            <p>
                                Database Name
                            </p>

                        </div>

                    </div>


                    <!-- BACKUP ACTION -->
                    <div class="report-card">

                        <h3>

                            Database Backup

                        </h3>


                        <p>

                            Create, restore and download database backups.

                        </p>

                        <div class="report-buttons">

                            <a href="../admin/processes/createBackupProcess.php">

                            <i class="fa-solid fa-plus"></i>

                                Create Backup

                            </a>

                            <a href="#" onclick="document.getElementById('restoreForm').click();">

                            <i class="fa-solid fa-upload"></i>

                                Restore Backup

                            </a>

                            <?php 

                                if(
                                    $latestBackup &&
                                    file_exists("backups/".$latestBackup['fileName'])
                                )

                                {

                                ?>

                                    <a href="backups/<?php echo $latestBackup['fileName']; ?>" download>

                                        <i class="fa-solid fa-download"></i>

                                        Download Latest Backup

                                    </a>

                                <?php

                                }

                                else

                                {

                                ?>

                                    <p>
                                        No backup available
                                    </p>

                                <?php

                                }

                                ?>

                        </div>


                        <form action="../admin/processes/restoreBackupProcess.php" method="POST"
                        enctype="multipart/form-data">

                            <input type="file" name="backupFile" id="restoreForm"
                            hidden onchange="this.form.submit()">

                        </form>


                    </div>


                    <!-- BACKUP ACTIVITIES -->
                    <div class="section-card">

                        <div class="section-header">

                            <h3>
                                Backup Activities
                            </h3>

                        </div>


                        <div class="activity-list">


                    <?php


                    if(mysqli_num_rows($activityQuery)==0)

                    {


                    ?>


                    <div class="activity-card">

                        <div class="activity-icon">

                            <i class="fa fa-info"></i>

                        </div>


                        <div class="activity-info">

                            <h5>
                                No activity yet
                            </h5>

                            <p>
                                Backup actions will appear here.
                            </p>

                        </div>


                    </div>


                    <?php


                    }


                    else


                    {


                    while($activity=mysqli_fetch_assoc($activityQuery))


                    {


                    ?>


                    <div class="activity-card">


                        <div class="activity-icon">

                            <?php

                            if($activity['action']=="Created Backup")
                            {

                            ?>

                            <i class="fa fa-plus"></i>


                            <?php

                            }

                            elseif($activity['action']=="Restore Backup")

                            {

                            ?>

                            <i class="fa fa-upload"></i>


                            <?php

                            }

                            else

                            {

                            ?>

                            <i class="fa fa-database"></i>


                            <?php

                            }

                            ?>

                        </div>



                        <div class="activity-info">


                            <h5>

                                <?php echo $activity['adminFullname']; ?>


                            </h5>


                            <p>

                                <?php echo $activity['action']; ?>

                                :

                                <?php echo $activity['fileName']; ?>


                            </p>


                            <small>

                                <?php

                                echo date(
                                "d M Y h:i A",
                                strtotime($activity['actionDate'])
                                );

                                ?>


                            </small>

                        </div>

                    </div>

                    <?php


                    }


                    }


                    ?>

                        </div>

                    </div>


                    <br>

                    <!-- BACKUP HISTORY -->

                    <div class="table-card">

                        <h3 style="margin-bottom:20px;">
                            Backup History
                        </h3>

                        <table>

                            <thead>

                                <tr>

                                    <th>
                                        No.
                                    </th>

                                    <th>
                                        Backup File
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Size
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>


                            </thead>

                            <tbody>

                                <?php

                                if(mysqli_num_rows($backupQuery)==0)

                                {

                                ?>

                                <tr>

                                    <td colspan="4" style="text-align:center;">

                                        No backup available.

                                    </td>

                                </tr>


                                <?php

                                }

                                else

                                {

                                $no = 1;

                                while($backup=mysqli_fetch_assoc($backupQuery))

                                {
                                ?>

                                <tr>
                                    <td>

                                        <?php echo $no++; ?>

                                    </td>

                                    <td>

                                        <i class="fa-solid fa-file-code"></i>

                                        <?php echo $backup['fileName']; ?>

                                    </td>


                                    <td>

                                        <?php echo date(
                                        "d M Y H:i",
                                        strtotime($backup['backupDate'])
                                        ); ?>

                                    </td>

                                    <td>
                                        <?php echo $backup['fileSize']; ?>
                                    </td>

                                    <td>


                                        <a class="edit-btn" href="<?php echo $backupFolder.$backup['fileName']; ?>" download>

                                            <i class="fa-solid fa-download"></i>

                                        </a>

                                    </td>

                                </tr>



                                <?php


                                }


                                }


                                ?>

                            </tbody>


                        </table>

                    </div>

                </div>




            <?php include("../admin/includes/footer.php"); ?>


        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        setTimeout(function(){

            let alerts = document.querySelectorAll(
                ".alert-success, .alert-error"
            );


            alerts.forEach(function(alert){

                alert.classList.add("alert-hide");


                setTimeout(function(){

                    alert.remove();

                },500);


            });


        },5000);


    </script>

</body>

</html>