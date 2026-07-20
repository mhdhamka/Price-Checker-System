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

    $item=mysqli_fetch_assoc(

        mysqli_query(

            $conn,

            "SELECT ItemImage
            FROM item
            WHERE ItemID='$id'"

        )

    );

    if($item)
    {

        if(file_exists($item['ItemImage']))
        {
            unlink($item['ItemImage']);
        }

        mysqli_query(

            $conn,

            "DELETE
            FROM item
            WHERE ItemID='$id'"

        );

    }

}

header("Location: ../../admin/items.php");

exit();

?>