<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../../public/loginAdmin.php");
    exit();
}



if(isset($_GET['id']))
{


    $id=(int)$_GET['id'];



    /*
    =====================================
       GET STORE INFORMATION
    =====================================
    */


    $store=mysqli_fetch_assoc(

        mysqli_query(

            $conn,

            "
            SELECT 

            StoreName,
            storeIMG

            FROM store

            WHERE storeID='$id'

            "

        )

    );



    if($store)

    {


        /*
        =====================================
           DELETE IMAGE
        =====================================
        */


        $imagePath="../../../assets/images/store/".basename($store['storeIMG']);


        if(file_exists($imagePath))
        {

            unlink($imagePath);

        }




        /*
        =====================================
           DELETE STORE
        =====================================
        */


        $result=mysqli_query(

        $conn,

        "
        DELETE FROM store

        WHERE storeID='$id'

        "

        );




        /*
        =====================================
           AUDIT LOG
        =====================================
        */


        if($result)

        {

            createAuditLog(

                $conn,

                $_SESSION['adminID'],

                "Store",

                "DELETE",

                $store['StoreName'],

                "Deleted store ".$store['StoreName']

            );

        }



    }


}



header("Location: ../../admin/stores.php");

exit();


?>