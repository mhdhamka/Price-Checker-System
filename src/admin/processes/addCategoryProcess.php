<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}


$categoryName = $_POST['categoryName'];


$imageName = basename($_FILES['image']['name']);

$imagePath = "../../../assets/images/category/" . $imageName;

$imageDB = "../../assets/images/category/" . $imageName;


move_uploaded_file(
    $_FILES['image']['tmp_name'],
    $imagePath
);



$result=mysqli_query(

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



if($result)
{

    createAuditLog(

        $conn,

        $_SESSION['adminID'],

        "Category",

        "ADD",

        $categoryName,

        "Added new category ".$categoryName

    );

}



header("Location: ../../admin/categories.php");

exit();

?>