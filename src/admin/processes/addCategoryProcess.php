<?php

session_start();

include("../../config/db_cPCS.php");

$categoryName = $_POST['categoryName'];

$imageName = basename($_FILES['image']['name']);

$imagePath = "../../../assets/images/category/" . $imageName;

$imageDB = "../../assets/images/category/" . $imageName;

move_uploaded_file(
    $_FILES['image']['tmp_name'],
    $imagePath
);

mysqli_query(
    $conn,

    "INSERT INTO category(
        categoryName,
        categoryIMG
    )

    VALUES(
        '$categoryName',
        '$imageDB'
    )"
);

header("Location: ../../admin/categories.php");

?>