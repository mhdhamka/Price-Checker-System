<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");

$itemName=$_POST['itemName'];
$price=$_POST['price'];
$category=$_POST['category'];
$store=$_POST['store'];
$description=$_POST['description'];

$imageName=basename($_FILES['image']['name']);

$imagePath="../../../assets/images/item/".$imageName;

$imageDB="../../assets/images/item/".$imageName;


move_uploaded_file(
    $_FILES['image']['tmp_name'],
    $imagePath
);


$result = mysqli_query(

$conn,

"INSERT INTO item(

ItemName,
ItemPrice,
ItemCategory,
ItemDescription,
StoreName,
ItemImage

)

VALUES(

'$itemName',
'$price',
'$category',
'$description',
'$store',
'$imageDB'

)"

);



if($result)

{

    createAuditLog(

        $conn,

        $_SESSION['adminID'],

        "Item",

        "ADD",

        $itemName,

        "Added new item ".$itemName

    );

}


header("Location: ../../admin/items.php");

?>