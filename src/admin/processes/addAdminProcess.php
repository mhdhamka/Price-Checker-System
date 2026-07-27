<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");

$adminFullname = $_POST['adminFullname'];
$adminUsername = $_POST['adminUsername'];
$adminEmail = $_POST['adminEmail'];
$adminPassword = password_hash(
    $_POST['adminPassword'],
    PASSWORD_DEFAULT
);

$imageName = basename($_FILES['image']['name']);

$imagePath = "../../../assets/images/admin/" . $imageName;

$imageDB = "../../assets/images/admin/" . $imageName;


move_uploaded_file(
    $_FILES['image']['tmp_name'],
    $imagePath
);


$result=mysqli_query(

$conn,

"INSERT INTO admin(

    adminFullname,
    adminUsername,
    adminEmail,
    adminPassword,
    adminIMG,
    logStatus

)

VALUES(

    '$adminFullname',
    '$adminUsername',
    '$adminEmail',
    '$adminPassword',
    '$imageDB',
    '1'

)"

);



if($result)

{

    createAuditLog(

        $conn,

        $_SESSION['adminID'],

        "Admin",

        "ADD",

        $adminFullname,

        "Added new admin account ".$adminFullname

    );

}


header("Location: ../../admin/admins.php");

exit();

?>