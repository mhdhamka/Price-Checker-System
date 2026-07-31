<?php

session_start();

include("../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: loginAdmin.php");
    exit();
}



if(!isset($_GET['id']))
{
    exit("Student not found");
}


$studentID=$_GET['id'];



/* ==========================
STUDENT INFO
========================== */


$student=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT

studentID,
fullName,
username,
studentIMG

FROM student

WHERE studentID='$studentID'

"));



if(!$student)
{
    exit("Student does not exist");
}



/* ==========================
REPORT HISTORY
========================== */


$reports=mysqli_query($conn,"

SELECT


fr.*,

t.topicTitle,


r.replyContent



FROM forumreport fr



LEFT JOIN forumtopic t

ON fr.topicID=t.topicID



LEFT JOIN forumreply r

ON fr.replyID=r.replyID



WHERE fr.studentID='$studentID'


ORDER BY fr.created_at DESC


");





/* ==========================
SUMMARY
========================== */


$total=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreport

WHERE studentID='$studentID'

"))['total'];



$approved=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreport

WHERE studentID='$studentID'

AND status='Approved'

"))['total'];



$rejected=mysqli_fetch_assoc(mysqli_query($conn,"

SELECT COUNT(*) total

FROM forumreport

WHERE studentID='$studentID'

AND status='Rejected'

"))['total'];



?>

<!DOCTYPE html>

<html>


<head>

<title>
Forum History
</title>


<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../../assets/css/forum.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


</head>


<body>


<?php include("../student/includes/header.php"); ?>



<section class="section community-section">


<div class="container">


<br><br>


<a href="forumUserModeration.php"
class="back-dashboard-btn">

<i class="fa fa-arrow-left"></i>

Back

</a>




<div class="forum-page-header">


<div class="page-header-icon moderation-header-icon">

<i class="fa-solid fa-clock-rotate-left"></i>

</div>


<div>

<h2>
Moderation History
</h2>

<p>
Review student's forum violations and reports.
</p>


</div>


</div>





<div class="user-card">



<div class="user-header">


<img src="<?php echo !empty($student['studentIMG'])

?
'../../assets/images/student/'.$student['studentIMG']

:

'../../assets/images/student/default.png';

?>">



<div>


<h3>

<?php echo htmlspecialchars($student['fullName']); ?>

</h3>


<p>

@<?php echo $student['username']; ?>

</p>


</div>


</div>




<div class="moderation-stats-mini">


<div>

<strong>
<?php echo $total; ?>
</strong>

<p>
Reports
</p>

</div>


<div>

<strong>
<?php echo $approved; ?>
</strong>

<p>
Approved
</p>

</div>


<div>

<strong>
<?php echo $rejected; ?>
</strong>

<p>
Rejected
</p>


</div>


</div>


</div>





<div class="moderation-panel">


<h3>

<i class="fa-solid fa-list"></i>

Report Timeline

</h3>



<?php while($row=mysqli_fetch_assoc($reports)){ ?>



<div class="moderation-item">


<strong>

<?php 

echo $row['topicTitle'] 
?? "Reply Report";

?>

</strong>



<p>

Reason:

<?php echo htmlspecialchars($row['reason']); ?>

</p>



<span class="risk-badge">

<?php echo $row['status']; ?>

</span>



<small>

<?php echo $row['created_at']; ?>

</small>



</div>



<?php } ?>



</div>




</div>


</section>



<?php include("../student/includes/footer.php"); ?>


<script src="../../assets/js/studentTheme.js"></script>


</body>

</html>