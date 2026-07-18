<?php

$sql="
SELECT 
ItemName,
ItemPrice,
StoreName,
ItemImage
FROM item
ORDER BY ItemPrice ASC
LIMIT 6
";

$result=mysqli_query($conn,$sql);

?>


<section class="deals" id="deals">

    <h2>
    Today's Best Deals
    </h2>


    <div class="deal-grid">


    <?php while($row=mysqli_fetch_assoc($result)){ ?>


    <div class="deal-card">
        <img src="<?= $row['ItemImage'] ?>">

        <h3>
            <?= $row['ItemName'] ?>
        </h3>

        <p>
         RM <?= number_format($row['ItemPrice'],2) ?>
        </p>

        <span>
            Available at <?= $row['StoreName'] ?>
        </span>

    </div>

    <?php } ?>

    </div>

</section>