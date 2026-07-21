<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}

$studentID = isset($_GET['studentID'])
    ? (int)$_GET['studentID']
    : 0;

$query = mysqli_query($conn,"
SELECT *
FROM student
WHERE studentID='$studentID'
");

if(mysqli_num_rows($query) == 0)
{
    exit("Student not found.");
}

$student = mysqli_fetch_assoc($query);

/* ==========================================
   STUDENT STATISTICS
========================================== */

$rating = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total
    FROM ratings
    WHERE studentID='$studentID'
    ")
)['total'];

/* Replace these queries with your actual tables later */

$post = 0;
$comment = 0;

?>

<div class="student-profile">

    <div class="profile-header">

        <img src="<?php echo htmlspecialchars($student['studentIMG']); ?>"
             class="profile-image">

        <h2>
            <?php echo htmlspecialchars($student['fullName']); ?>
        </h2>

        <p>
            <?php echo htmlspecialchars($student['email']); ?>
        </p>

        <?php if($student['logStatus']){ ?>

            <span class="status-badge active">
                <i class="fa-solid fa-circle-check"></i>
                Active Student
            </span>

        <?php } else { ?>

            <span class="status-badge disabled">
                <i class="fa-solid fa-circle-xmark"></i>
                Disabled Student
            </span>

        <?php } ?>

    </div>

    <div class="info-card">

        <h3>
            Student Information
        </h3>

        <div class="info-row">
            <span>Student ID</span>
            <strong><?php echo $student['studentID']; ?></strong>
        </div>

        <div class="info-row">
            <span>Username</span>
            <strong><?php echo htmlspecialchars($student['username']); ?></strong>
        </div>

    </div>

    <div class="student-stats">

        <div class="stat-card">

            <i class="fa-solid fa-star"></i>

            <h2><?php echo $rating; ?></h2>

            <span>Ratings</span>

        </div>

        <div class="stat-card">

            <i class="fa-solid fa-comments"></i>

            <h2><?php echo $post; ?></h2>

            <span>Posts</span>

        </div>

        <div class="stat-card">

            <i class="fa-solid fa-message"></i>

            <h2><?php echo $comment; ?></h2>

            <span>Comments</span>

        </div>

    </div>

</div>