<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

/* ==========================================
   STUDENT STATISTICS
========================================== */

$totalStudents = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM student
"))['total'];

$activeStudents = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM student
WHERE logStatus='1'
"))['total'];

$disabledStudents = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM student
WHERE logStatus='0'
"))['total'];

$registeredThisMonth = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) total
FROM student
WHERE MONTH(created_at)=MONTH(CURRENT_DATE())
AND YEAR(created_at)=YEAR(CURRENT_DATE())
"))['total'];


/* ==========================================
   SEARCH / FILTER / SORT / PAGINATION
========================================== */

$search = $_GET['search'] ?? "";
$status = $_GET['logStatus'] ?? "";
$sort = $_GET['sort'] ?? "";

$sql = "SELECT * FROM student WHERE 1";

/* SEARCH */
if($search != "")
{
    $search = mysqli_real_escape_string($conn,$search);

    $sql .= " AND (
        fullName LIKE '%$search%'
        OR username LIKE '%$search%'
        OR email LIKE '%$search%'
    )";
}

/* CATEGORY FILTER */
if($status!="")
{
    $status=mysqli_real_escape_string($conn,$status);

    $sql.=" AND logStatus='$status'";
}

/* SORTING */
switch($sort)
{

case "old":

$sql.=" ORDER BY studentID ASC";

break;

case "az":

$sql.=" ORDER BY fullName ASC";

break;

case "za":

$sql.=" ORDER BY fullName DESC";

break;

default:

$sql.=" ORDER BY studentID ASC";

}

/* TOTAL RECORDS */
$countSQL = str_replace(
    "SELECT *",
    "SELECT COUNT(*) total",
    $sql
);

$total = mysqli_fetch_assoc(
    mysqli_query($conn,$countSQL)
)['total'];

/* PAGINATION */
$limit = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1)
{
    $page = 1;
}

$offset = ($page-1)*$limit;
$sql .= " LIMIT $limit OFFSET $offset";
$studentQuery = mysqli_query($conn,$sql);
$totalPages = ceil($total/$limit);


?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Manage Students
    </title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/adminDashboard.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">

</head>

<body>

<div class="admin-container">

    <?php include("../admin/includes/sidebar.php"); ?>

    <div class="admin-main">

        <?php include("../admin/includes/header.php"); ?>

        <div class="dashboard-content">

            <!-- Page Title -->

            <div class="page-title">

                <h2>

                    Students Management

                </h2>

                <p>

                    View, search, edit, and delete student records.

                </p>

            </div>

            <div class="dashboard-cards">

                <div class="dashboard-card">
                    <i class="fa-solid fa-user"></i>
                    <h4>
                        <?php echo $totalStudents; ?>
                    </h4>

                    <p>
                        Total Students
                    </p>
                </div>

                <div class="dashboard-card">
                    <i class="fa-solid fa-user-check"></i>
                    <h4>
                        <?php echo $activeStudents; ?>
                    </h4>

                    <p>
                        Active Students
                    </p>
                </div>

                <div class="dashboard-card">
                    <i class="fa-solid fa-user-slash"></i>
                    <h4>
                        <?php echo $disabledStudents; ?>
                    </h4>

                    <p>
                        Disabled Students
                    </p>
                </div>

                <div class="dashboard-card">
                    <i class="fa-solid fa-calendar-plus"></i>
                    <h4>
                        <?php echo $registeredThisMonth; ?>
                    </h4>

                    <p>
                        Registered This Month
                    </p>
                </div>

            </div>

            <!-- Report -->
            <div class="report-card">
                <h3>
                    Student Reports
                </h3>

                <p>
                    Generate and export student statistics.
                </p>

                <div class="report-buttons">
                    <a href="../admin/exportPDF.php?type=student">
                        <i class="fa fa-file-pdf"></i>
                        Export Student PDF
                    </a>

                    <a href="../admin/exportExcel.php?type=student">
                        <i class="fa fa-file-excel"></i>
                        Export Student Excel
                    </a>
                </div>
            </div>

            <!-- Top Bar -->
            <div class="manage-top">

                <form method="GET" class="search-box">

                    <input type="text" name="search" placeholder="Search student..." value="<?php echo htmlspecialchars($search); ?>">

                    <select name="logStatus">

                        <option value="">All Status</option>

                        <?php

                        $statusQuery = mysqli_query($conn,"SELECT DISTINCT logStatus FROM student");

                        while($statusRow = mysqli_fetch_assoc($statusQuery))
                        {

                        ?>

                        <option 
                            value="<?php echo $statusRow['logStatus']; ?>"
                            <?php 
                            if($status == $statusRow['logStatus'])
                                echo "selected";
                            ?>
                        >

                            <?php echo $statusRow['logStatus']; ?>

                        </option>

                        <?php

                        }

                        ?>

                    </select>


                    <select name="sort">

                        <option value="">Newest</option>

                        <option value="old" 
                        <?php if($sort=="old") echo "selected"; ?>>
                            Oldest
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

            <!-- Table -->
            <div class="table-card">

                <table>

                    <thead>

                        <tr>

                            <th>No.</th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    if(mysqli_num_rows($studentQuery)==0)
                    {

                    ?>

                    <tr>

                        <td colspan="7" style="text-align:center;">

                            No student record found.

                        </td>

                    </tr>

                    <?php

                    }
                    else
                    {

                    $no = $offset + 1;

                    while($student=mysqli_fetch_assoc($studentQuery))
                    {

                    ?>

                    <tr>

                        <td>

                            <?php echo $no++; ?>

                        </td>

                        <td>

                            <img src="<?php echo $student['studentIMG']; ?>" class="table-image">

                        </td>

                        <td>

                            <?php echo $student['fullName']; ?>

                        </td>

                        <td>

                            <?php echo $student['username']; ?>

                        </td>

                        <td>

                            <?php echo $student['email']; ?>

                        </td>

                        <td class="action-buttons">

                            <button type="button" class="action-btn view-btn"
                                data-id="<?php echo $student['studentID']; ?>"
                                title="View Student">

                                <i class="fa-solid fa-eye"></i>

                            </button>

                            <button type="button" class="action-btn reset-btn"
                                data-id="<?php echo $student['studentID']; ?>"
                                data-name="<?php echo htmlspecialchars($student['fullName']); ?>"
                                title="Reset Password">

                                <i class="fa-solid fa-key"></i>

                            </button>

                            <?php if($student['logStatus']==1){ ?>

                                <button type="button"
                                    class="action-btn disable-btn"
                                    data-id="<?php echo $student['studentID']; ?>"
                                    data-name="<?php echo htmlspecialchars($student['fullName']); ?>"
                                    title="Disable Student">

                                    <i class="fa-solid fa-user-slash"></i>

                                </button>

                            <?php }else{ ?>

                                <button type="button"
                                    class="action-btn enable-btn"
                                    data-id="<?php echo $student['studentID']; ?>"
                                    data-name="<?php echo htmlspecialchars($student['fullName']); ?>"
                                    title="Enable Student">

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


                <!-- ==========================================
                    PAGINATION
                ========================================== -->
                <div class="pagination">

                    <?php

                    // Previous button
                    if($page > 1)
                    {
                    ?>

                    <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>&logStatus=<?php echo urlencode($status); ?>&sort=<?php echo urlencode($sort); ?>">

                        <i class="fa fa-angle-left"></i>

                    </a>

                    <?php
                    }


                    // First page
                    if($page > 3)
                    {
                    ?>

                    <a href="?page=1&search=<?php echo urlencode($search); ?>&logStatus=<?php echo urlencode($status); ?>&sort=<?php echo urlencode($sort); ?>">

                        1

                    </a>


                    <?php if($page > 4)
                    { 
                    ?>

                    <span class="dots">
                        ...
                    </span>

                    <?php
                    }

                    }


                    // Current page range

                    $start = max(1, $page - 2);

                    $end = min($totalPages, $page + 2);


                    for($i=$start; $i<=$end; $i++)
                    {

                    ?>

                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&logStatus=<?php echo urlencode($status); ?>&sort=<?php echo urlencode($sort); ?>"
                    class="<?php if($page==$i) echo 'active'; ?>">

                        <?php echo $i; ?>

                    </a>


                    <?php

                    }


                    // Last page

                    if($page < $totalPages - 2)
                    {

                        if($page < $totalPages - 3)
                        {

                    ?>

                    <span class="dots">
                        ...
                    </span>


                    <?php

                        }

                    ?>

                    <a href="?page=<?php echo $totalPages; ?>&search=<?php echo urlencode($search); ?>&logStatus=<?php echo urlencode($status); ?>&sort=<?php echo urlencode($sort); ?>">

                        <?php echo $totalPages; ?>

                    </a>


                    <?php

                    }


                    // Next button

                    if($page < $totalPages)
                    {

                    ?>

                    <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>&logStatus=<?php echo urlencode($status); ?>&sort=<?php echo urlencode($sort); ?>">

                        <i class="fa fa-angle-right"></i>

                    </a>


                    <?php

                    }

                    ?>

                </div>


                <div class="pagination-info">

                    Showing

                    <strong>
                        <?php echo $offset + 1; ?>
                    </strong>

                    to

                    <strong>
                        <?php echo min($offset + $limit, $total); ?>
                    </strong>

                    of

                    <strong>
                        <?php echo $total; ?>
                    </strong>

                    students

                </div>

            </div>

        </div>

        <!-- ==========================================
            VIEW STUDENT MODAL
        ========================================== -->
        <div id="studentModal" class="student-modal">

            <div class="student-modal-content">

                <button type="button" class="close-modal">&times;</button>

                <div id="studentDetails">

                </div>

            </div>

        </div>

        <!-- ==========================================
            CONFIRM ACTION MODAL
        ========================================== -->

        <div id="confirmModal" class="student-modal">

            <div class="student-modal-content confirm-modal">

                <!-- Close Button -->
                <button type="button" class="close-modal">
                    &times;
                </button>

                <!-- Icon -->
                <div id="confirmIcon" class="confirm-icon">

                    <i class="fa-solid fa-key"></i>

                </div>

                <!-- Title -->
                <h2 id="confirmTitle">

                    Confirmation

                </h2>

                <!-- Message -->
                <p id="confirmMessage">

                    Are you sure you want to continue?

                </p>

                <!-- Student Name -->
                <div class="confirm-name">

                    <span id="confirmStudent">

                        Student Name

                    </span>

                </div>

                <!-- Information -->
                <div class="confirm-note">

                    <i class="fa-solid fa-circle-info"></i>

                    <span id="confirmNote">

                        Action description goes here.

                    </span>

                </div>

                <!-- Form -->
                <form id="confirmForm" method="POST">

                    <input
                        type="hidden"
                        id="confirmStudentID"
                        name="studentID">

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
<script src="../../assets/js/students.js"></script>

</body>


</html>