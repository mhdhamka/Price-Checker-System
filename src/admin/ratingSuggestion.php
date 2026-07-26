<?php

include("../config/db_cPCS.php");


$search=$_GET['search'] ?? "";


$search=mysqli_real_escape_string(
$conn,
$search
);



$query=mysqli_query($conn,"

SELECT

ratings.ratingID,

student.fullName,
student.studentIMG,

item.ItemName,
item.ItemImage,
item.StoreName,

ratings.rating


FROM ratings


JOIN student

ON ratings.studentID = student.studentID


JOIN item

ON ratings.ItemID = item.ItemID


WHERE


student.fullName LIKE '%$search%'

OR item.ItemName LIKE '%$search%'


ORDER BY ratings.ratingID DESC


LIMIT 5


");




if(mysqli_num_rows($query)==0)
{

echo "

<div class='rating-suggestion-item'>

No rating found.

</div>

";


exit();

}




while($rating=mysqli_fetch_assoc($query))

{

?>



<div class="rating-suggestion-item"

data-name="<?php echo htmlspecialchars($rating['ItemName']); ?>">



    <img src="<?php echo $rating['ItemImage']; ?>">



    <div class="rating-suggestion-info">


        <div class="rating-suggestion-header">


            <h4>

                <?php echo htmlspecialchars($rating['ItemName']); ?>

            </h4>


            <span class="rating-star">

                ⭐ <?php echo $rating['rating']; ?>

            </span>

        </div>


        <span class="rating-student">

            By:

            <?php echo htmlspecialchars($rating['fullName']); ?>

        </span>

        <span class="rating-store">


            <?php echo htmlspecialchars($rating['StoreName']); ?>

        </span>

    </div>

</div>

<?php

}

?>