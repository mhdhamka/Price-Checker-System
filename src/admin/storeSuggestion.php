<?php

include("../config/db_cPCS.php");


$search=$_GET['search'] ?? "";


$search=mysqli_real_escape_string(
$conn,
$search
);



$query=mysqli_query($conn,"


SELECT *

FROM store

WHERE

StoreName LIKE '%$search%'

ORDER BY StoreName ASC

LIMIT 5


");



if(mysqli_num_rows($query)==0)
{

echo "

<div class='store-suggestion-item'>

No store found.

</div>

";

exit();

}



while($store=mysqli_fetch_assoc($query))

{

?>


<div class="store-suggestion-item"

data-name="<?php echo htmlspecialchars($store['StoreName']); ?>">



    <img src="<?php echo $store['storeIMG']; ?>">



    <div class="store-suggestion-info">


        <h4>

            <?php echo htmlspecialchars($store['StoreName']); ?>

        </h4>


        <span>

            Grocery Store

        </span>


    </div>



</div>



<?php

}

?>