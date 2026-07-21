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

    $store=mysqli_fetch_assoc(

        mysqli_query(

            $conn,

            "SELECT storeIMG
            FROM store
            WHERE storeID='$id'"

        )

    );

    if($store)
    {

        if(file_exists($store['storeIMG']))
        {
            unlink($store['storeIMG']);
        }

        mysqli_query(

            $conn,

            "DELETE
            FROM store
            WHERE storeID='$id'"

        );

    }

}

header("Location: ../../admin/stores.php");

exit();

?>