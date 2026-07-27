<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../public/loginAdmin.php");
    exit();
}



if(isset($_GET['id']))
{


    $id=(int)$_GET['id'];



    // Get category information before delete

    $category=mysqli_fetch_assoc(

        mysqli_query(

            $conn,

            "

            SELECT categoryName, categoryIMG

            FROM category

            WHERE categoryID='$id'

            "

        )

    );



    if($category)
    {



        if(file_exists($category['categoryIMG']))
        {
            unlink($category['categoryIMG']);
        }



        $result=mysqli_query(

            $conn,

            "

            DELETE FROM category

            WHERE categoryID='$id'

            "

        );



        if($result)
        {

            createAuditLog(

                $conn,

                $_SESSION['adminID'],

                "Category",

                "DELETE",

                $category['categoryName'],

                "Deleted category ".$category['categoryName']

            );

        }


    }


}



header("Location: ../../admin/categories.php");

exit();

?>