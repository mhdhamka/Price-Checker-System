<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}


$storeName = $_POST['StoreName'];

$description = $_POST['desc1'];



$imageName = basename($_FILES['image']['name']);

$imagePath = "../../../assets/images/store/" . $imageName;

$imageDB = "../../assets/images/store/" . $imageName;



move_uploaded_file(

    $_FILES['image']['tmp_name'],

    $imagePath

);



$result=mysqli_query(

$conn,

"INSERT INTO store(

    StoreName,
    desc1,
    storeIMG

)

VALUES(

    '$storeName',
    '$description',
    '$imageDB'

)"

);



if($result)

{

    createAuditLog(

        $conn,

        $_SESSION['adminID'],

        "Store",

        "ADD",

        $storeName,

        "Added new store ".$storeName

    );

}



header("Location: ../../admin/stores.php");

exit();

?>