<?php

include("../config/db_cPCS.php");


$search=$_GET['search'] ?? "";


$search=mysqli_real_escape_string(
$conn,
$search
);



$query=mysqli_query($conn,"

SELECT *

FROM category

WHERE

categoryName LIKE '%$search%'

LIMIT 5

");



if(mysqli_num_rows($query)==0)
{

echo "

<div class='category-suggestion-item'>

No category found.

</div>

";

exit();

}



while($category=mysqli_fetch_assoc($query))

{

?>


<div class="category-suggestion-item"
data-name="<?php echo htmlspecialchars($category['categoryName']); ?>">



    <img src="<?php echo $category['categoryIMG']; ?>">


    <div class="category-suggestion-info">


        <h4>

            <?php echo htmlspecialchars($category['categoryName']); ?>

        </h4>


        <span>

            Grocery Category

        </span>


    </div>


</div>



<?php

}

?>