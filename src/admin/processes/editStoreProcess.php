<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}



$id=(int)$_POST['id'];



/*
=====================================
   GET OLD STORE NAME
=====================================
*/


$oldStore=mysqli_fetch_assoc(

mysqli_query(

$conn,

"
SELECT StoreName

FROM store

WHERE storeID='$id'

"

)

);



$storeName=$_POST['StoreName'];

$description=$_POST['desc1'];

$imageDB=$_POST['oldImage'];




/*
=====================================
   UPLOAD IMAGE
=====================================
*/


if($_FILES['image']['name'] != "")
{

    $imageName=basename($_FILES['image']['name']);

    $imagePath="../../../assets/images/store/".$imageName;


    $imageDB="../../assets/images/store/".$imageName;



    move_uploaded_file(

        $_FILES['image']['tmp_name'],

        $imagePath

    );

}



/*
=====================================
   UPDATE STORE
=====================================
*/


$result=mysqli_query(

$conn,

"
UPDATE store SET

StoreName='$storeName',

desc1='$description',

storeIMG='$imageDB'


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

        "UPDATE",

        $storeName,

        "Updated store from ".$oldStore['StoreName']." to ".$storeName

    );

}



header("Location: ../../admin/stores.php");

exit();

?>