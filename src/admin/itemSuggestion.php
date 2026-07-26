<?php

include("../config/db_cPCS.php");


$search=$_GET['search'] ?? "";

$search=mysqli_real_escape_string(
$conn,
$search
);



$query=mysqli_query($conn,"


SELECT

item.*,

AVG(ratings.rating) AS averageRating,

COUNT(ratings.ratingID) AS totalRating


FROM item


LEFT JOIN ratings

ON item.ItemID = ratings.ItemID


WHERE


ItemName LIKE '%$search%'

OR ItemCategory LIKE '%$search%'

OR StoreName LIKE '%$search%'


GROUP BY item.ItemID


LIMIT 5


");



if(mysqli_num_rows($query)==0)
{

echo "

<div class='item-suggestion-item'>

No product found.

</div>

";

exit();

}



while($item=mysqli_fetch_assoc($query))

{

?>


<div class="item-suggestion-item" 
data-name="<?php echo htmlspecialchars($item['ItemName']); ?>">



    <img src="<?php echo $item['ItemImage']; ?>">



    <div class="item-suggestion-info">


        <div class="item-suggestion-header">


            <h4>

                <?php echo htmlspecialchars($item['ItemName']); ?>

            </h4>


            <span class="item-suggestion-price">

                RM <?php echo number_format($item['ItemPrice'],2); ?>

            </span>


        </div>


        <div class="item-suggestion-category">


            <?php echo htmlspecialchars($item['ItemCategory']); ?>

            •

            <?php echo htmlspecialchars($item['StoreName']); ?>


        </div>


        <div class="item-rating-box">


            <div class="item-rating-score">

                <i class="fa fa-star"></i>


                <?php

                echo ($item['averageRating'] > 0)

                ? number_format($item['averageRating'],1)

                : "0.0";

                ?>


            </div>

            <div class="item-rating-review">


                <?php

                if($item['totalRating'] > 0)

                {

                    echo "(".$item['totalRating']." Reviews)";

                }

                else

                {

                    echo "(No Reviews)";

                }

                ?>

            </div>

        </div>

    </div>

</div>

<?php

}

?>