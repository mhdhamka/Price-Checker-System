<?php

session_start();

include("../../config/db_cPCS.php");


/* ==========================================
CHECK ITEM ID
========================================== */

if(!isset($_GET['itemID']))
{
    exit();
}


$itemID = intval($_GET['itemID']);



/* ==========================================
GET ALL REVIEWS
========================================== */


$sql = "

SELECT

ratings.rating,

ratings.comment,

ratings.dateCreated,

student.username,

student.studentIMG


FROM ratings


INNER JOIN student

ON ratings.studentID = student.studentID


WHERE ratings.ItemID = '$itemID'


ORDER BY ratings.dateCreated DESC


";


$result = mysqli_query($conn,$sql);



/* ==========================================
NO REVIEW
========================================== */


if(mysqli_num_rows($result)==0)
{

?>

<div class="review-card">

    <p>
        No reviews yet. Be the first to rate this product!
    </p>

</div>


<?php

exit();

}



/* ==========================================
DISPLAY REVIEWS
========================================== */


while($row=mysqli_fetch_assoc($result))
{


$rating = intval($row['rating']);

?>


<div class="review-card">


    <div class="review-user">


        <?php if(!empty($row['studentIMG'])) { ?>

            <img 
            src="<?php echo $row['studentIMG']; ?>"
            width="40"
            height="40"
            class="rounded-circle">


        <?php } ?>


        <strong>

            <?php echo $row['username']; ?>

        </strong>


    </div>



    <div class="review-stars">


        <?php

        for($i=1;$i<=5;$i++)
        {

            if($i <= $rating)
            {

                echo "★";

            }
            else
            {

                echo "☆";

            }

        }

        ?>


    </div>



    <p>

        <?php echo nl2br($row['comment']); ?>

    </p>



    <small>

        <?php echo date(
            "d M Y",
            strtotime($row['dateCreated'])
        ); ?>

    </small>



</div>


<?php

}

?>