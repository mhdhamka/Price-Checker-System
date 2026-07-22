<?php

session_start();
include("../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    header("Location: ../../public/loginAdmin.php");
    exit();
}

/* ==========================================
GET FORM DATA
========================================== */

$adminID = $_POST['adminID'];

$adminFullname = mysqli_real_escape_string(
    $conn,
    trim($_POST['adminFullname'])
);

$adminUsername = mysqli_real_escape_string(
    $conn,
    trim($_POST['adminUsername'])
);

$adminEmail = mysqli_real_escape_string(
    $conn,
    trim($_POST['adminEmail'])
);

$adminPassword = trim($_POST['adminPassword']);

$imageDB = $_POST['oldImage'];


/* ==========================================
UPLOAD NEW PROFILE IMAGE
========================================== */

if(isset($_FILES['adminIMG']) && $_FILES['adminIMG']['name'] != "")
{
    $imageName = basename($_FILES['adminIMG']['name']);

    $imagePath = "../../../assets/images/profile/" . $imageName;

    $imageDB = "../../assets/images/profile/" . $imageName;

    move_uploaded_file(
        $_FILES['adminIMG']['tmp_name'],
        $imagePath
    );
}


/* ==========================================
UPDATE PROFILE
========================================== */

$sql = "

UPDATE admin

SET

adminFullname = '$adminFullname',
adminUsername = '$adminUsername',
adminEmail = '$adminEmail',
adminIMG = '$imageDB'

";


/* ==========================================
UPDATE PASSWORD (OPTIONAL)
========================================== */

if($adminPassword != "")
{
    $hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

    $sql .= ", adminPassword = '$hashedPassword'";
}


/* ==========================================
WHERE
========================================== */

$sql .= "

WHERE adminID = '$adminID'

";


if(mysqli_query($conn,$sql))
{
    // Update session so changes appear immediately
    $_SESSION['adminUsername'] = $adminUsername;

    header("Location: ../../admin/profile.php?success=1");
    exit();
}
else
{
    die("Update failed: " . mysqli_error($conn));
}

?>