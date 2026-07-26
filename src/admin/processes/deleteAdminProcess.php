<?php

session_start();

include("../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../../public/loginAdmin.php");
    exit();
}


if(isset($_GET['id']))
{

    $id = (int)$_GET['id'];

    /* Prevent deleting yourself */

    if($id == $_SESSION['adminID'])
    {
        header("Location: ../../admin/admins.php");
        exit();
    }


    $admin = mysqli_fetch_assoc(

        mysqli_query(

            $conn,

            "SELECT adminIMG
            FROM admin
            WHERE adminID='$id'"

        )

    );


    if($admin)
    {

        $imagePath = "../../../" . str_replace("../../", "", $admin['adminIMG']);

        if(file_exists($imagePath))
        {
            unlink($imagePath);
        }


        mysqli_query(

            $conn,

            "DELETE
            FROM admin
            WHERE adminID='$id'"

        );

    }

}


header("Location: ../../admin/admins.php");

exit();

?>