<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}



/* =====================================
   FILTER & SEARCH
===================================== */


$search = "";

$module = "";

$action = "";

$sort = "";


if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn,$_GET['search']);
}


if(isset($_GET['module']))
{
    $module = mysqli_real_escape_string($conn,$_GET['module']);
}


if(isset($_GET['action']))
{
    $action = mysqli_real_escape_string($conn,$_GET['action']);
}


if(isset($_GET['sort']))
{
    $sort=mysqli_real_escape_string($conn,$_GET['sort']);
}


/* =====================================
   PAGINATION
===================================== */


$limit = 10;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page-1) * $limit;


/* ==========================================
   AUDIT LOG STATISTICS
========================================== */


// Total Logs

$totalLogs = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM audit_logs
"))['total'];



// Today's Activity

$todayLogs = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM audit_logs
WHERE DATE(created_at)=CURDATE()
"))['total'];



// Total Changes

$totalChanges = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM audit_logs
WHERE action IN ('ADD','UPDATE','DELETE')
"))['total'];



// Active Admins

$totalAdmins = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(DISTINCT adminID) total
FROM audit_logs
"))['total'];



/* =====================================
   COUNT LOGS
===================================== */


$countQuery="

SELECT COUNT(*) total

FROM audit_logs

JOIN admin

ON audit_logs.adminID = admin.adminID

WHERE

(
admin.adminFullname LIKE '%$search%'

OR audit_logs.module LIKE '%$search%'

OR audit_logs.action LIKE '%$search%'

OR audit_logs.target LIKE '%$search%'

OR audit_logs.description LIKE '%$search%'
)


AND

(
'$module'=''
OR audit_logs.module='$module'
)


AND

(
'$action'=''
OR audit_logs.action='$action'
)

";


$countResult=mysqli_query($conn,$countQuery);

$totalRows=mysqli_fetch_assoc($countResult)['total'];

$totalPages=ceil($totalRows/$limit);




/* =====================================
   GET AUDIT LOGS
===================================== */


$query="

SELECT

audit_logs.*,

admin.adminFullname


FROM audit_logs


JOIN admin

ON audit_logs.adminID = admin.adminID


WHERE

(
admin.adminFullname LIKE '%$search%'

OR audit_logs.module LIKE '%$search%'

OR audit_logs.action LIKE '%$search%'

OR audit_logs.target LIKE '%$search%'

OR audit_logs.description LIKE '%$search%'
)


AND

(
'$module'=''
OR audit_logs.module='$module'
)


AND

(
'$action'=''
OR audit_logs.action='$action'
)

";

if($sort=="old")
{
    $query.=" ORDER BY audit_logs.created_at ASC ";
}
else
{
    $query.=" ORDER BY audit_logs.created_at DESC ";
}


$query.=" LIMIT $offset,$limit ";



$logs=mysqli_query($conn,$query);



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

                        <i class="fa-solid fa-clock-rotate-left"></i>

                        Activity Records
                    </h2>

                    <p>

                        Monitor administrator actions, system updates and security activities.

                    </p>

                </div>

                <div class="dashboard-cards">

                    <div class="dashboard-card">

                        <i class="fa-solid fa-list"></i>

                        <h4>
                            <?php echo $totalLogs; ?>
                        </h4>

                        <p>
                            Total Logs
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa-solid fa-calendar-day"></i>

                        <h4>
                            <?php echo $todayLogs; ?>
                        </h4>

                        <p>
                            Today's Activity
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa-solid fa-pen-to-square"></i>

                        <h4>
                            <?php echo $totalChanges; ?>
                        </h4>

                        <p>
                            System Changes
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa-solid fa-user-shield"></i>

                        <h4>
                            <?php echo $totalAdmins; ?>
                        </h4>

                        <p>
                            Active Admins
                        </p>

                    </div>

                </div>
                

                <!-- Top Bar -->
                <div class="manage-top">

                    <form method="GET" class="search-box">

                        <div class="student-search-input">

                            <input type="text" name="search" placeholder="Search admin, module, target..."
                            value="<?php echo htmlspecialchars($search); ?>">

                        </div>

                        <select name="module">

                            <option value="">
                                All Modules
                            </option>

                            <?php


                            $moduleQuery=mysqli_query(
                            $conn,
                            "
                            SELECT DISTINCT module
                            FROM audit_logs
                            WHERE module IS NOT NULL
                            ORDER BY module ASC
                            "
                            );


                            while($row=mysqli_fetch_assoc($moduleQuery))

                            {


                            ?>

                            <option

                                value="<?php echo $row['module']; ?>"

                                <?php

                                if($module==$row['module'])
                                echo "selected";

                                ?>

                                >

                                <?php echo $row['module']; ?>

                            </option>

                            <?php

                            }

                            ?>


                        </select>

                        <select name="action">

                            <option value="">
                                All Actions
                            </option>

                            <?php

                            $actionQuery=mysqli_query(
                            $conn,
                            "
                            SELECT DISTINCT action
                            FROM audit_logs
                            ORDER BY action ASC
                            "
                            );



                            while($row=mysqli_fetch_assoc($actionQuery))

                            {


                            ?>

                            <option

                                value="<?php echo $row['action']; ?>"

                                <?php

                                if($action==$row['action'])
                                echo "selected";

                                ?>

                                >


                                <?php echo ucfirst($row['action']); ?>

                            </option>

                            <?php

                            }

                            ?>


                        </select>

                        <select name="sort">

                            <option value="">
                                Newest
                            </option>

                            <option value="old">
                                Oldest
                            </option>

                        </select>

                        <button type="submit">

                        <i class="fa fa-search"></i>

                        </button>

                    </form>

                </div>


                <!-- SEARCH -->
                <div class="table-card">

                    <h3>
                        System Activity History
                    </h3>


                    <table>

                        <thead>

                        <tr>

                            <th>No.</th>

                            <th>Admin</th>

                            <th>Module</th>

                            <th>Action</th>

                            <th>Target</th>

                            <th>Description</th>

                            <th>IP Address</th>

                            <th>Date</th>

                        </tr>


                        </thead>

                        <tbody>

                            <?php


                            if(mysqli_num_rows($logs)>0)

                            {


                            $no=$offset+1;



                            while($log=mysqli_fetch_assoc($logs))

                            {


                            ?>


                            <tr>

                                <td>

                                    <?php echo $no++; ?>

                                </td>

                                <td>

                                    <i class="fa fa-user-circle"></i>

                                    <?php echo $log['adminFullname']; ?>

                                </td>

                                <td>

                                    <span class="module-badge">

                                        <?php echo ucfirst($log['module']); ?>

                                    </span>

                                </td>

                                <td>

                                    <?php

                                    $actionClass="";

                                    switch(strtolower($log['action']))
                                    {


                                        case "add":

                                        $actionClass="success";

                                        break;


                                        case "delete":

                                        $actionClass="danger";

                                        break;


                                        case "update":

                                        $actionClass="warning";

                                        break;


                                        default:

                                        $actionClass="info";

                                    }

                                    ?>

                                    <span class="status-badge <?php echo $actionClass; ?>">

                                        <?php echo ucfirst($log['action']); ?>

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

                                    <?php

                                    echo date(

                                    "d M Y<br>h:i A",

                                    strtotime($log['created_at'])

                                    );


                                    ?>


                                </td>

                            </tr>

                            <?php


                            }


                            }

                            else

                            {


                            ?>

                            <tr>

                                <td colspan="8" class="empty-data">

                                <i class="fa fa-database"></i>

                                    <h4>
                                        No Activity Found
                                    </h4>

                                    <p>
                                        No audit records available.
                                    </p>

                                </td>

                            </tr>


                        <?php

                        }

                        ?>

                        </tbody>

                    </table>


                    <!-- ==========================================
                        PAGINATION
                    ========================================== -->

                    <div class="pagination">

                        <?php


                        /* Previous */

                        if($page > 1)

                        {

                        ?>

                        <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>&module=<?php echo urlencode($module); ?>&action=<?php echo urlencode($action); ?>">

                            <i class="fa fa-angle-left"></i>

                        </a>


                        <?php

                        }



                        /* First Page */

                        if($page > 3)

                        {

                        ?>

                        <a href="?page=1&search=<?php echo urlencode($search); ?>&module=<?php echo urlencode($module); ?>&action=<?php echo urlencode($action); ?>">

                            1

                        </a>


                        <?php

                        if($page > 4)

                        {

                        ?>

                        <span class="dots">

                            ...

                        </span>

                        <?php

                        }

                        }



                        /* Page Range */

                        $start = max(1,$page-2);

                        $end = min($totalPages,$page+2);


                        for($i=$start;$i<=$end;$i++)

                        {

                        ?>

                        <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&module=<?php echo urlencode($module); ?>&action=<?php echo urlencode($action); ?>"

                        class="<?php echo ($page==$i)?'active':''; ?>">

                            <?php echo $i; ?>

                        </a>


                        <?php

                        }



                        /* Last Page */

                        if($page < $totalPages-2)

                        {


                        if($page < $totalPages-3)

                        {

                        ?>

                        <span class="dots">

                            ...

                        </span>

                        <?php

                        }


                        ?>

                        <a href="?page=<?php echo $totalPages; ?>&search=<?php echo urlencode($search); ?>&module=<?php echo urlencode($module); ?>&action=<?php echo urlencode($action); ?>">

                            <?php echo $totalPages; ?>

                        </a>


                        <?php

                        }



                        /* Next */

                        if($page < $totalPages)

                        {

                        ?>

                        <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>&module=<?php echo urlencode($module); ?>&action=<?php echo urlencode($action); ?>">

                            <i class="fa fa-angle-right"></i>

                        </a>


                        <?php

                        }

                        ?>

                    </div>



                    <!-- PAGINATION INFO -->
                    <div class="pagination-info">

                        Showing

                        <strong>
                            <?php echo ($totalRows > 0) ? $offset + 1 : 0; ?>
                        </strong>

                        to

                        <strong>
                            <?php echo min($offset + $limit,$totalRows); ?>
                        </strong>

                        of

                        <strong>
                            <?php echo $totalRows; ?>
                        </strong>

                        activity records

                    </div>

                </div>



            </div>



            <?php include("../admin/includes/footer.php"); ?>


        </div>

    </div>

</body>

</html>