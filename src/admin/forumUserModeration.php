<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}


$adminID=$_SESSION['adminID'];


/* ==========================
USER SEARCH
========================== */


$search=$_GET['search'] ?? "";



/* ==========================
STUDENT MODERATION DATA
========================== */


$query="

SELECT


s.studentID,

s.fullName,

s.username,

s.studentIMG,


COUNT(fr.reportID) totalReports,


SUM(
CASE 
WHEN fr.status='Approved'
THEN 1
ELSE 0
END
) approvedReports,


SUM(
CASE
WHEN fr.status='Rejected'
THEN 1
ELSE 0
END
) rejectedReports


FROM student s


LEFT JOIN forumreport fr

ON s.studentID=fr.studentID



WHERE

s.fullName LIKE '%$search%'


GROUP BY s.studentID


ORDER BY totalReports DESC


";



$students=mysqli_query($conn,$query);


/* ==========================
ADMIN PROFILE
========================== */


$user=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT

adminUsername,

adminIMG

FROM admin

WHERE adminID='$adminID'

"));


$adminUsername=$user['adminUsername'] ?? "Admin";

$img=$user['adminIMG'] ?? "../../assets/images/profile/default.png";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Forum User Moderation</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/styleindex.css">
    <link rel="stylesheet" href="../../assets/css/forum.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="icon" href="../../assets/images/logo.png" type="image/x-icon">


</head>


<body>



<?php include("../student/includes/header.php"); ?>



<section class="section community-section" id="community">


<div class="container">


<br><br>


<a href="forumModeration.php"
class="back-dashboard-btn">

<i class="fa fa-arrow-left"></i>

Back To Moderation

</a>



<div class="forum-page-header">


<div class="page-header-icon moderation-header-icon">

<i class="fa-solid fa-user-shield"></i>

</div>


<div>

<h2>
User Moderation
</h2>


<p>
Monitor student report history and moderation behaviour.
</p>


</div>


</div>





<!-- SEARCH -->

<div class="user-moderation-toolbar">


<form>


<div class="moderation-search">


<i class="fa-solid fa-search"></i>


<input 
type="text"
name="search"
placeholder="Search student..."
value="<?php echo htmlspecialchars($search); ?>">


<button>

Search

</button>


</div>


</form>


</div>





<div class="user-grid">



<?php while($student=mysqli_fetch_assoc($students)){



$level="Normal";


if($student['approvedReports'] >= 5)
{
    $level="High Risk";
}

else if($student['approvedReports'] >= 2)
{
    $level="Warning";
}



?>



<div class="user-card">



<div class="user-header">


<img src="<?php echo !empty($student['studentIMG']) 
? $student['studentIMG']
: '../../assets/images/profile/default.png'; ?>">


<div>


<h3>

<?php echo htmlspecialchars($student['fullName']); ?>

</h3>


<p>
@<?php echo $student['username']; ?>
</p>



<span class="risk-badge 
<?php echo strtolower(str_replace(' ','-',$level)); ?>">

<i class="fa-solid fa-shield"></i>

<?php echo $level; ?>

</span>


</div>


</div>






<div class="moderation-stats-mini">


<div>

<strong>
<?php echo $student['totalReports']; ?>
</strong>

<p>
Reports
</p>

</div>



<div>

<strong>
<?php echo $student['approvedReports']; ?>
</strong>

<p>
Approved
</p>

</div>



<div>

<strong>
<?php echo $student['rejectedReports']; ?>
</strong>

<p>
Rejected
</p>

</div>


</div>




<a href="forumHistory.php?id=<?php echo $student['studentID']; ?>"
class="moderation-action-btn">


<i class="fa-solid fa-clock-rotate-left"></i>

View History


</a>




</div>



<?php } ?>



</div>



</div>


</section>



<?php include("../student/includes/footer.php"); ?>



    <script src="../../assets/js/studentTheme.js"></script>
    <script src="../../assets/js/header.js"></script>
    <script src="../../assets/js/forum/like.js"></script>
    <script src="../../assets/js/forum/bookmark.js"></script>
    <script src="../../assets/js/forum/modal.js"></script>
    <script src="../../assets/js/forum/topic.js"></script>
    <script src="../../assets/js/forum/searchTopic.js"></script>
    <script src="../../assets/js/forum/topicSuggestion.js"></script>
    <script src="../../assets/js/forum/adminTopicActions.js"></script>


</body>

</html>