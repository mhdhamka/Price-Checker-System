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

    $id = (int)$_GET['id'];



    /*
    =====================================
       GET ITEM INFORMATION
    =====================================
    */


    $itemQuery = mysqli_query(

        $conn,

        "
        SELECT 
            ItemName,
            ItemImage

        FROM item

        WHERE ItemID='$id'
        "

    );


    $item = mysqli_fetch_assoc($itemQuery);



    if($item)
    {


        /*
        =====================================
           DELETE IMAGE FILE
        =====================================
        */


        $imagePath = "../../../assets/images/item/" . basename($item['ItemImage']);


        if(file_exists($imagePath))
        {
            unlink($imagePath);
        }




        /*
        =====================================
           DELETE ITEM
        =====================================
        */

        $deleteQuery = mysqli_query(

            $conn,

            "
            DELETE FROM item
            WHERE ItemID='$id'
            "

        );



        /*
        =====================================
           INSERT AUDIT LOG
        =====================================
        */
        if($deleteQuery)

        {
            createAuditLog(

                $conn,

                $_SESSION['adminID'],

                "Product",

                "DELETE",

                $item['ItemName'],

                "Deleted product ".$item['ItemName']

            );

        }


    }


}


header("Location: ../../admin/items.php");

exit();

?>