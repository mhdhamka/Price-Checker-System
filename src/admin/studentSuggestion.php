<?php

include("../config/db_cPCS.php");


$search=$_GET['search'] ?? "";

$search=mysqli_real_escape_string(
$conn,
$search
);


$query=mysqli_query($conn,"

SELECT *

FROM student

WHERE

fullName LIKE '%$search%'

OR username LIKE '%$search%'

OR email LIKE '%$search%'

LIMIT 5

");



if(mysqli_num_rows($query)==0)
{

echo "

<div class='student-suggestion-item'>

No student found.

</div>

";

exit();

}



while($student=mysqli_fetch_assoc($query))

{

?>


<div class="student-suggestion-item" data-name="<?php echo htmlspecialchars($student['fullName']); ?>">


    <img src="<?php echo $student['studentIMG']; ?>">



    <div class="student-suggestion-info">

        <h4>
            <?php echo htmlspecialchars($student['fullName']); ?>
        </h4>

        <span>
            <?php echo htmlspecialchars($student['email']); ?>
        </span>

    </div>

</div>


<?php

}

?>