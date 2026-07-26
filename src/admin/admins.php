<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}


/* ==========================================
   ADMIN STATISTICS
========================================== */


$totalAdmins = mysqli_fetch_assoc(
mysqli_query(
$conn,
"
SELECT COUNT(*) total
FROM admin
"
)
)['total'];



$activeAdmins = mysqli_fetch_assoc(
mysqli_query(
$conn,
"
SELECT COUNT(*) total
FROM admin
WHERE logStatus='1'
"
)
)['total'];



$disabledAdmins = mysqli_fetch_assoc(
mysqli_query(
$conn,
"
SELECT COUNT(*) total
FROM admin
WHERE logStatus='0'
"
)
)['total'];



$newAdmins = mysqli_fetch_assoc(
mysqli_query(
$conn,
"
SELECT COUNT(*) total
FROM admin
WHERE MONTH(created_at)=MONTH(CURRENT_DATE())
AND YEAR(created_at)=YEAR(CURRENT_DATE())
"
)
)['total'];



/* ==========================================
   SEARCH FILTER SORT
========================================== */


$search = $_GET['search'] ?? "";

$logStatus = $_GET['logStatus'] ?? "";

$sort = $_GET['sort'] ?? "";



$sql = "
SELECT *
FROM admin
WHERE 1
";



/* SEARCH */

if($search!="")
{

    $search=mysqli_real_escape_string(
    $conn,
    $search
    );


    $sql.=" AND (

        adminFullname LIKE '%$search%'

        OR adminUsername LIKE '%$search%'

        OR adminEmail LIKE '%$search%'

    )";

}


/* STATUS FILTER */
if($logStatus!="")
{

    $logStatus=mysqli_real_escape_string(
    $conn,
    $logStatus
    );


    $sql.=" AND logStatus='$logStatus'";

}



/* SORT */

switch($sort)
{

    case "az":

        $sql.=" ORDER BY adminFullname ASC";

    break;


    case "za":

        $sql.=" ORDER BY adminFullname DESC";

    break;


    default:

        $sql.=" ORDER BY adminID ASC";

}



/* TOTAL RECORD */

$total = mysqli_num_rows(
mysqli_query(
$conn,
$sql
)
);



/* PAGINATION */

$limit = 10;


$page = isset($_GET['page']) 
? (int)$_GET['page'] 
: 1;



if($page < 1)
{
    $page = 1;
}


$offset = ($page-1)*$limit;



$sql.=" LIMIT $limit OFFSET $offset";



$adminQuery = mysqli_query(
$conn,
$sql
);



$totalPages = ceil(
$total/$limit
);



?>


<!DOCTYPE html>

<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Admin Management
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
                        Admin Management
                    </h2>

                    <p>
                        Manage administrator accounts, permissions and security.
                    </p>

                </div>


                <!-- STATISTICS -->
                <div class="dashboard-cards">

                    <div class="dashboard-card">

                        <i class="fa fa-user-shield"></i>

                        <h4>
                            <?php echo $totalAdmins; ?>
                        </h4>

                        <p>
                            Total Admins
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa fa-user-check"></i>

                        <h4>
                            <?php echo $activeAdmins; ?>
                        </h4>

                        <p>
                            Active Admins
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa fa-user-slash"></i>

                        <h4>
                            <?php echo $disabledAdmins; ?>
                        </h4>

                        <p>
                            Disabled Admins
                        </p>

                    </div>

                    <div class="dashboard-card">

                        <i class="fa fa-calendar-plus"></i>

                        <h4>
                            <?php echo $newAdmins; ?>
                        </h4>

                        <p>
                            Added This Month
                        </p>

                    </div>

                </div>


                <!-- ADMIN ACCOUNT ACTION -->
                <div class="report-card">

                    <h3>
                        Administrators
                    </h3>

                    <p>
                        Manage administrator accounts, access permissions and security.
                    </p>

                    <div class="report-buttons">

                        <a href="addAdmin.php">

                        <i class="fa fa-user-plus"></i>

                        Add Admin

                        </a>

                    </div>


                </div>


                <!-- SEARCH -->
                <div class="manage-top">

                    <form method="GET" class="search-box">

                        <div class="admin-search-input">

                                <input type="text" id="adminSearchBox" name="search" autocomplete="off" placeholder="Search admin..."
                                value="<?php echo htmlspecialchars($search); ?>">

                            <!-- Student Suggestions -->
                            <div id="adminSuggestion"></div>

                        </div>

                        <select name="logStatus">

                            <option value="">
                                All Status
                            </option>

                            <option value="1"
                                <?php if($logStatus=="1") echo "selected"; ?>>
                                Active
                            </option>

                            <option value="0"
                                <?php if($logStatus=="0") echo "selected"; ?>>
                                Disabled
                            </option>

                        </select>

                        <select name="sort">

                            <option value="">
                                Latest
                            </option>

                            <option value="az"
                                <?php if($sort=="az") echo "selected"; ?>>
                                A-Z
                            </option>

                            <option value="za"
                                <?php if($sort=="za") echo "selected"; ?>>
                                Z-A
                            </option>

                        </select>

                        <button type="submit">

                            <i class="fa fa-search"></i>

                        </button>

                    </form>

                </div>


                <!-- TABLE -->
                <div class="table-card">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    No.
                                </th>

                                <th>
                                    Image
                                </th>

                                <th>
                                    Name
                                </th>

                                <th>
                                Username
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            if(mysqli_num_rows($adminQuery)==0)

                            {


                            ?>


                            <tr>

                                <td colspan="7" style="text-align:center;">

                                    No admin record found.

                                </td>

                            </tr>


                            <?php


                            }

                            else

                            {


                            $no=$offset+1;


                            while($admin=mysqli_fetch_assoc($adminQuery))

                            {


                            ?>

                            <tr>

                                <td>

                                    <?php echo $no++; ?>

                                </td>

                                <td>

                                    <img src="<?php echo $admin['adminIMG']; ?>" class="table-image">

                                </td>

                                <td>

                                <?php echo $admin['adminFullname']; ?>

                                </td>


                                <td>

                                    <?php echo $admin['adminUsername']; ?>

                                </td>

                                <td>

                                    <?php echo $admin['adminEmail']; ?>

                                </td>

                                <td>

                                    <?php if($admin['logStatus']==1){ ?>


                                        <span class="status-active">

                                            Active

                                        </span>


                                    <?php }else{ ?>


                                        <span class="status-disabled">

                                            Disabled

                                        </span>


                                    <?php } ?>


                                </td>


                                <td class="action-buttons">

                                    <a
                                        href="editAdmin.php?id=<?php echo $admin['adminID']; ?>"
                                        class="action-btn edit-btn"
                                        title="Edit Administrator">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                    <button
                                        type="button"
                                        class="action-btn reset-btn"
                                        data-id="<?php echo $admin['adminID']; ?>"
                                        data-name="<?php echo htmlspecialchars($admin['adminFullname']); ?>"
                                        title="Reset Password">

                                        <i class="fa-solid fa-key"></i>

                                    </button>

                                    <?php if($admin['logStatus']==1){ ?>

                                        <button
                                            type="button"
                                            class="action-btn disable-btn"
                                            data-id="<?php echo $admin['adminID']; ?>"
                                            data-name="<?php echo htmlspecialchars($admin['adminFullname']); ?>"
                                            title="Disable Administrator">

                                            <i class="fa-solid fa-user-slash"></i>

                                        </button>

                                    <?php }else{ ?>

                                        <button
                                            type="button"
                                            class="action-btn enable-btn"
                                            data-id="<?php echo $admin['adminID']; ?>"
                                            data-name="<?php echo htmlspecialchars($admin['adminFullname']); ?>"
                                            title="Enable Administrator">

                                            <i class="fa-solid fa-user-check"></i>

                                        </button>

                                    <?php } ?>

                                </td>

                            </tr>

                                <?php


                                }


                                }


                                ?>


                        </tbody>

                    </table>


                    <!-- PAGINATION -->
                    <div class="pagination">


                        <?php


                        if($page>1)

                        {


                        ?>

                        <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>&logStatus=<?php echo urlencode($logStatus); ?>&sort=<?php echo urlencode($sort); ?>">

                            <i class="fa fa-angle-left"></i>

                        </a>


                        <?php


                        }


                        for($i=1;$i<=$totalPages;$i++)

                        {


                        ?>

                        <a
                        href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&logStatus=<?php echo urlencode($logStatus); ?>&sort=<?php echo urlencode($sort); ?>"
                        class="<?php if($page==$i) echo 'active'; ?>">

                            <?php echo $i; ?>

                        </a>

                        <?php

                        }

                        if($page<$totalPages)

                        {


                        ?>

                        <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>&logStatus=<?php echo urlencode($logStatus); ?>&sort=<?php echo urlencode($sort); ?>">

                            <i class="fa fa-angle-right"></i>

                        </a>

                        <?php

                        }

                        ?>

                    </div>


                    <div class="pagination-info">

                        Showing

                        <strong>

                            <?php echo ($total>0)?$offset+1:0; ?>

                        </strong>

                        to

                        <strong>

                            <?php echo min($offset+$limit,$total); ?>

                        </strong>

                        of

                        <strong>

                            <?php echo $total; ?>

                        </strong>

                        admins

                    </div>



                </div>


            </div>

  
            <!-- ==========================================
                CONFIRM ACTION MODAL
            ========================================== -->

            <div id="confirmModal" class="student-modal">

                <div class="student-modal-content confirm-modal">

                    <button
                        type="button"
                        class="close-modal">

                        &times;

                    </button>

                    <div
                        id="confirmIcon"
                        class="confirm-icon">

                        <i class="fa-solid fa-key"></i>

                    </div>

                    <h2 id="confirmTitle">

                        Confirmation

                    </h2>

                    <p id="confirmMessage">

                        Are you sure you want to continue?

                    </p>

                    <div class="confirm-name">

                        <span id="confirmName">

                            Administrator Name

                        </span>

                    </div>

                    <div class="confirm-note">

                        <i class="fa-solid fa-circle-info"></i>

                        <span id="confirmNote">

                            Action description goes here.

                        </span>

                    </div>

                    <form
                        id="confirmForm"
                        method="POST">

                        <input
                            type="hidden"
                            id="confirmID"
                            name="adminID">

                        <div class="confirm-actions">

                            <button
                                type="button"
                                class="cancel-btn">

                                <i class="fa-solid fa-xmark"></i>

                                Cancel

                            </button>

                            <button
                                type="submit"
                                id="confirmBtn"
                                class="confirm-btn">

                                Confirm

                            </button>

                        </div>

                    </form>

                </div>

            </div>


        <?php include("../admin/includes/footer.php"); ?>


    </div>


</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/admins.js"></script>


</body>


</html>