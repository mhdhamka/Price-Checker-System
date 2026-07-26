<?php

session_start();

include("../../config/db_cPCS.php");



$id = $_POST['adminID'];

$name = $_POST['adminFullname'];

$username = $_POST['adminUsername'];

$email = $_POST['adminEmail'];

$password = $_POST['adminPassword'];



$imageDB = $_POST['oldImage'];





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




mysqli_query($conn,$sql);


header("Location: ../../admin/admins.php");

exit();

?>