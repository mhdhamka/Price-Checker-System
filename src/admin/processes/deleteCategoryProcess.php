<?php

session_start();

include("../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}

if(isset($_GET['id']))
{

    $id=(int)$_GET['id'];

    $category=mysqli_fetch_assoc(

        mysqli_query(

            $conn,

            "SELECT categoryIMG
            FROM category
            WHERE categoryID='$id'"

        )

    );

    if($category)
    {

        if(file_exists($category['categoryIMG']))
        {
            unlink($category['categoryIMG']);
        }

        mysqli_query(

            $conn,

            "DELETE
            FROM category
            WHERE categoryID='$id'"

        );

    }

}

header("Location: ../../admin/categories.php");

exit();

?>