<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");

$id = $_POST['id'];

$oldItem=mysqli_fetch_assoc(

mysqli_query(
$conn,
"
SELECT ItemName
FROM item
WHERE ItemID='$id'
"
)

);


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

$result=mysqli_query(

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



if($result)

{

    createAuditLog(

        $conn,

        $_SESSION['adminID'],

        "Item",

        "UPDATE",

        $itemName,

        "Updated item from ".$oldItem['ItemName']." to ".$itemName

    );

}

header("Location: ../../admin/items.php");

?>