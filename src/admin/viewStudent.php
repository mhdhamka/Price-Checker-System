<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_GET['studentID']))
{
    exit("Student not found.");
}

$studentID = (int)$_GET['studentID'];

$query = mysqli_query(

$conn,

"SELECT *
FROM student
WHERE studentID='$studentID'"

);

$student = mysqli_fetch_assoc($query);

if(!$student)
{
    exit("Student not found.");
}

/* Ratings */

$rating = mysqli_fetch_assoc(

mysqli_query(

$conn,

"SELECT COUNT(*) total
FROM ratings
WHERE studentID='$studentID'"

)

)['total'];

$post = 0;
$comment = 0;

?>

<div class="student-profile-modal">

    <div style="text-align:center;">

        <img src="<?php echo $student['studentIMG']; ?>"
             class="profile-image">

        <h2>

            <?php echo $student['fullName']; ?>

        </h2>

    </div>

    <hr>

    <table class="table">

        <tr>

            <th>Username</th>

            <td>

                <?php echo $student['username']; ?>

            </td>

        </tr>

        <tr>

            <th>Email</th>

            <td>

                <?php echo $student['email']; ?>

            </td>

        </tr>

        <tr>

            <th>Status</th>

            <td>

                <?php

                echo ($student['logStatus'])
                    ? "Active"
                    : "Disabled";

                ?>

            </td>

        </tr>

    </table>

    <hr>

    <div class="student-stats">

        <div>

            <h3><?php echo $rating; ?></h3>

            <p>Ratings</p>

        </div>

        <div>

            <h3><?php echo $post; ?></h3>

            <p>Posts</p>

        </div>

        <div>

            <h3><?php echo $comment; ?></h3>

            <p>Comments</p>

        </div>

    </div>

</div>