<?php

session_start();
include("../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}

$ratingID=(int)$_GET['ratingID'];

$query=mysqli_query($conn,"

SELECT

ratings.*,

student.fullName,
student.studentIMG,

item.ItemName,
item.ItemImage,
item.StoreName,
item.ItemCategory

FROM ratings

JOIN student
ON ratings.studentID=student.studentID

JOIN item
ON ratings.ItemID=item.ItemID

WHERE ratingID='$ratingID'

");

if(mysqli_num_rows($query)==0)
{
    exit("Rating not found.");
}

$rating=mysqli_fetch_assoc($query);

?>

<div class="student-profile">

    <div class="profile-header">

        <img
        src="<?php echo $rating['ItemImage'];?>"
        class="profile-image">

        <h2>

            <?php echo htmlspecialchars($rating['ItemName']); ?>

        </h2>

        <p>

            Rated by
            <strong>

                <?php echo htmlspecialchars($rating['fullName']); ?>

            </strong>

        </p>

    </div>

    <div class="info-card">

        <h3>

            Rating Information

        </h3>

        <div class="info-row">

            <span>Store</span>

            <strong>

                <?php echo $rating['StoreName']; ?>

            </strong>

        </div>

        <div class="info-row">

            <span>Category</span>

            <strong>

                <?php echo $rating['ItemCategory']; ?>

            </strong>

        </div>

        <div class="info-row">

            <span>Rating</span>

            <strong>

                ⭐ <?php echo $rating['rating']; ?>/5

            </strong>

        </div>

        <div class="info-row">

            <span>Date</span>

            <strong>

                <?php echo date("d M Y H:i",
                strtotime($rating['dateCreated']));?>

            </strong>

        </div>

    </div>



    <div class="info-card">

        <h3>

            Student Review

        </h3>

        <p class="rating-comment">

            <?php

            if(trim($rating['comment'])=="")
            {

                echo "<em>No review submitted.</em>";

            }
            else
            {

                echo nl2br(htmlspecialchars($rating['comment']));

            }

            ?>

        </p>

    </div>

</div>