z<?php

session_start();

include("../../config/db_cPCS.php");

$id = $_POST['id'];

$categoryName = $_POST['categoryName'];

$imageDB = $_POST['oldImage'];

if($_FILES['image']['name'] != "")
{
    $imageName = basename($_FILES['image']['name']);

    $imagePath = "../../../assets/images/category/" . $imageName;

    $imageDB = "../../assets/images/category/" . $imageName;

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        $imagePath
    );
}

mysqli_query(

    $conn,

    "UPDATE category SET

    categoryName='$categoryName',
    categoryIMG='$imageDB'

    WHERE categoryID='$id'"

);

header("Location: ../../admin/categories.php");

?>