<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}



$id = (int)$_POST['adminID'];



/*
=====================================
   GET OLD ADMIN INFORMATION
=====================================
*/

$oldAdmin=mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "
        SELECT adminFullname
        FROM admin
        WHERE adminID='$id'
        "

    )

);



$name = $_POST['adminFullname'];

$username = $_POST['adminUsername'];

$email = $_POST['adminEmail'];

$password = $_POST['adminPassword'];



$imageDB = $_POST['oldImage'];



/*
=====================================
   UPLOAD NEW IMAGE
=====================================
*/


if($_FILES['image']['name'] != "")
{

    $imageName = basename($_FILES['image']['name']);


    $imagePath = "../../../assets/images/admin/" . $imageName;


    $imageDB = "../../assets/images/admin/" . $imageName;



    move_uploaded_file(

        $_FILES['image']['tmp_name'],

        $imagePath

    );

}



/*
=====================================
   UPDATE ADMIN
=====================================
*/


if($password != "")
{


    $password = password_hash(

        $password,

        PASSWORD_DEFAULT

    );


    $sql = "

    UPDATE admin SET

    adminFullname='$name',

    adminUsername='$username',

    adminEmail='$email',

    adminPassword='$password',

    adminIMG='$imageDB'


    WHERE adminID='$id'

    ";


}

else

{


    $sql = "

    UPDATE admin SET

    adminFullname='$name',

    adminUsername='$username',

    adminEmail='$email',

    adminIMG='$imageDB'


    WHERE adminID='$id'

    ";


}



$result=mysqli_query($conn,$sql);



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

        "Admin",

        "UPDATE",

        $name,

        "Updated admin account from ".$oldAdmin['adminFullname']." to ".$name

    );

}




header("Location: ../../admin/admins.php");

exit();


?>