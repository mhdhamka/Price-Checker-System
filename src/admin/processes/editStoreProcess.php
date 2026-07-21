z<?php

session_start();

include("../../config/db_cPCS.php");

$id = $_POST['id'];

$storeName = $_POST['StoreName'];
$description = $_POST['desc1'];

$imageDB = $_POST['oldImage'];

if($_FILES['image']['name'] != "")
{
    $imageName = basename($_FILES['image']['name']);

    $imagePath = "../../../assets/images/store/" . $imageName;

    $imageDB = "../../assets/images/store/" . $imageName;

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        $imagePath
    );
}

mysqli_query(

    $conn,

    "UPDATE store SET

    StoreName='$fullName',
    desc1='$description',
    storeIMG='$imageDB'

    WHERE storeID='$id'"

);

header("Location: ../../admin/stores.php");

?>