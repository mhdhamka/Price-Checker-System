<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}



$id = $_POST['id'];


// Get old category name

$oldCategory=mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "
        SELECT categoryName
        FROM category
        WHERE categoryID='$id'
        "

    )

);



$categoryName = $_POST['categoryName'];

$imageDB = $_POST['oldImage'];



if($_FILES['image']['name'] != "")
{

    $imageName = basename($_FILES['image']['name']);

    $imagePath = "../../../assets/images/category/".$imageName;

    $imageDB = "../../assets/images/category/".$imageName;


    move_uploaded_file(

        $_FILES['image']['tmp_name'],

        $imagePath

    );

}



$result=mysqli_query(

    $conn,

    "

    UPDATE category SET

    categoryName='$categoryName',

    categoryIMG='$imageDB'


    WHERE categoryID='$id'

    "

);



if($result)
{

    createAuditLog(

        $conn,

        $_SESSION['adminID'],

        "Category",

        "UPDATE",

        $categoryName,

        "Updated category from ".$oldCategory['categoryName']." to ".$categoryName

    );

}



header("Location: ../../admin/categories.php");

exit();

?>