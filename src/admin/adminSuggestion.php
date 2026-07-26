<?php

include("../config/db_cPCS.php");


$search=$_GET['search'] ?? "";


$search=mysqli_real_escape_string(
$conn,
$search
);



$query=mysqli_query($conn,"

    SELECT *

    FROM admin

    WHERE

    adminFullname LIKE '%$search%'

    OR adminUsername LIKE '%$search%'

    OR adminEmail LIKE '%$search%'

    LIMIT 5

");



if(mysqli_num_rows($query)==0)

{

echo "

<div class='admin-suggestion-item'>

    No admin found.

</div>

";

exit();

}



while($admin=mysqli_fetch_assoc($query))

{

?>


<div class="admin-suggestion-item"
data-name="<?php echo htmlspecialchars($admin['adminFullname']); ?>">


    <img 
    src="<?php echo $admin['adminIMG']; ?>">



    <div class="admin-suggestion-info">


        <h4>

            <?php echo htmlspecialchars($admin['adminFullname']); ?>

        </h4>


        <span>

            <?php echo htmlspecialchars($admin['adminEmail']); ?>

        </span>


    </div>



</div>



<?php

}

?>