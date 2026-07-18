<?php

session_start();

include "../config/db_cPCS.php";


if(!isset($_SESSION['userID'])){

    header("Location: loginUser.php");
    exit();

}



$search = "";
$category = "";
$store = "";

if(isset($_GET['search'])){

    $search=$_GET['search'];

}

if(isset($_GET['category'])){

    $category=$_GET['category'];

}


if(isset($_GET['store'])){

    $store=$_GET['store'];

}

$sql="
SELECT 
item.*,
ROUND(AVG(ratings.rating),2) AS avgRating

FROM item
LEFT JOIN ratings
ON item.ItemID = ratings.ItemID
WHERE 1

";


$params=[];
$types="";


if($search!=""){


$sql.=" AND ItemName LIKE ? ";
$params[]="%".$search."%";
$types.="s";


}


if($category!=""){


$sql.=" AND ItemCategory=? ";
$params[]=$category;
$types.="s";


}


if($store!=""){


$sql.=" AND StoreName=? ";
$params[]=$store;
$types.="s";


}


$sql.="

GROUP BY item.ItemID
ORDER BY item.ItemID DESC

";


$stmt=$conn->prepare($sql);

if(count($params)>0){

$stmt->bind_param(
$types,
...$params
);

}


$stmt->execute();
$result=$stmt->get_result();

?>


<!DOCTYPE html>

<html>

<head>


<title>
PriceWise Products
</title>


<link rel="stylesheet" href="../../assets/css/user-header.css">

<link rel="stylesheet" href="../../assets/css/products.css">



</head>



<body>


<?php include "../includes/userHeader.php"; ?>




<section class="products-page">


<div class="container">



<h1>

Find Your Best Deals

</h1>


<p>

Compare prices and choose smarter.

</p>





<form method="GET" class="filter-box">


<input 

type="text"

name="search"

placeholder="Search product..."

value="<?=htmlspecialchars($search)?>"

>




<select name="category">


<option value="">
All Categories
</option>


<?php


$cat=mysqli_query(
$conn,
"SELECT * FROM category"
);


while($row=mysqli_fetch_assoc($cat)){


?>


<option

value="<?=$row['categoryName']?>"

<?=($category==$row['categoryName'])?"selected":""?>

>


<?=$row['categoryName']?>


</option>


<?php } ?>


</select>





<select name="store">


<option value="">
All Stores
</option>


<option value="e-Mart">
e-Mart
</option>


<option value="H&L">
H&L
</option>


</select>




<button>

Search

</button>


</form>






<div class="product-grid">





<?php while($row=mysqli_fetch_assoc($result)){ ?>




<div class="product-card">



<img 

src="../<?=$row['ItemImage']?>"

>




<h3>

<?=$row['ItemName']?>

</h3>




<p class="category">

<?=$row['ItemCategory']?>

</p>




<h4>

RM <?=number_format($row['ItemPrice'],2)?>

</h4>




<div class="rating">


⭐

<?=$row['avgRating'] ?? "No Rating"?>


</div>





<a 

href="compare.php?id=<?=$row['ItemID']?>"

class="compare-btn">


Compare Price


</a>




</div>



<?php } ?>




</div>





</div>


</section>




<?php include "../includes/userFooter.php"; ?>


</body>

</html>