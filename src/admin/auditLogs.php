<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}



$logs=mysqli_query(
$conn,
"
SELECT 

audit_logs.*,

admin.adminFullname

FROM audit_logs

JOIN admin

ON audit_logs.adminID = admin.adminID

ORDER BY audit_logs.created_at DESC

"
);


?>

<!DOCTYPE html>

<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Audit Logs
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/adminDashboard.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

</head>

<body>

<div class="admin-container">

    <?php include("../admin/includes/sidebar.php"); ?>

        <div class="admin-main">

            <?php include("../admin/includes/header.php"); ?>

                <div class="dashboard-content">

                    <div class="page-title">

                        <h2>
                            Audit Logs
                        </h2>

                        <p>
                            Track administrator activities and system changes.
                        </p>

                    </div>

                    <div class="table-card">

                        <h3>
                        System Activity History
                        </h3>

                        <br>

                        <table>

                            <thead>

                                <tr>

                                    <th>
                                        No.
                                    </th>

                                    <th>
                                        Admin
                                    </th>

                                    <th>
                                        Module
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                    <th>
                                        Target
                                    </th>

                                    <th>
                                        Description
                                    </th>

                                    <th>
                                        IP Address
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $no=1;

                                while($log=mysqli_fetch_assoc($logs))

                                {

                                ?>

                                <tr>

                                    <td>

                                        <?php echo $no++; ?>

                                    </td>

                                    <td>

                                        <i class="fa fa-user"></i>

                                        <?php echo $log['adminFullname']; ?>

                                    </td>

                                    <td>

                                        <span class="module-badge">

                                            <?php echo $log['module']; ?>

                                        </span>

                                    </td>

                                    <td>

                                        <span class="status-badge">

                                            <?php echo $log['action']; ?>

                                        </span>

                                    </td>

                                    <td>

                                        <?php echo $log['target']; ?>

                                    </td>

                                    <td>

                                        <?php echo $log['description']; ?>

                                    </td>

                                    <td>

                                        <?php echo $log['ipAddress']; ?>

                                    </td>

                                    <td>

                                        <?php echo date(
                                        "d M Y h:i A",
                                        strtotime($log['created_at'])
                                        ); ?>

                                    </td>

                                </tr>


                                <?php

                                }

                                ?>


                            </tbody>


                        </table>

                    </div>

                </div>

                <?php include("../admin/includes/footer.php"); ?>


            </div>


        </div>


</body>


</html>