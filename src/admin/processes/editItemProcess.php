<?php

session_start();

include("../../config/db_cPCS.php");

$id = $_POST['id'];

$itemName = $_POST['itemName'];
$price = $_POST['price'];
$category = $_POST['category'];
$store = $_POST['store'];
$description = $_POST['description'];

$imageDB = $_POST['oldImage'];

if($_FILES['image']['name'] != "")
{
    $imageName = basename($_FILES['image']['name']);

    $imagePath = "../../../assets/images/item/" . $imageName;

    $imageDB = "../../assets/images/item/" . $imageName;

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        $imagePath
    );
}

mysqli_query(

    $conn,

    "UPDATE item SET

    ItemName='$itemName',
    ItemPrice='$price',
    ItemCategory='$category',
    ItemDescription='$description',
    StoreName='$store',
    ItemImage='$imageDB'

    WHERE ItemID='$id'"

);

header("Location: ../../admin/items.php");

?>