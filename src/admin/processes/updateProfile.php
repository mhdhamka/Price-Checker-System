<?php

session_start();

include("../../config/db_cPCS.php");

include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../../public/loginAdmin.php");
    exit();
}



/* ==========================================
GET FORM DATA
========================================== */

$adminID = $_POST['adminID'];



/*
GET OLD ADMIN DATA
*/

$oldAdmin = mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "
        SELECT 

        adminFullname,
        adminUsername,
        adminEmail,
        adminIMG

        FROM admin

        WHERE adminID='$adminID'

        "

    )

);



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


$imageChanged = false;


if(isset($_FILES['adminIMG']) && $_FILES['adminIMG']['name'] != "")
{

    $imageChanged = true;


    $imageName = basename(
        $_FILES['adminIMG']['name']
    );


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

    $hashedPassword = password_hash(
        $adminPassword,
        PASSWORD_DEFAULT
    );


    $sql .= ",

    adminPassword = '$hashedPassword'

    ";

}



/* ==========================================
WHERE
========================================== */


$sql .= "

WHERE adminID = '$adminID'

";




/* ==========================================
EXECUTE UPDATE
========================================== */


if(mysqli_query($conn,$sql))
{


    /*
    UPDATE SESSION
    */

    $_SESSION['adminUsername'] = $adminUsername;



    /*
    ==========================================
    CREATE DYNAMIC AUDIT DESCRIPTION
    ==========================================
    */


    $changes = [];



    // Fullname changed

    if($oldAdmin['adminFullname'] != $adminFullname)
    {

        $changes[] =

        "fullname from "
        .$oldAdmin['adminFullname']
        ." to "
        .$adminFullname;

    }




    // Username changed

    if($oldAdmin['adminUsername'] != $adminUsername)
    {

        $changes[] =

        "username from "
        .$oldAdmin['adminUsername']
        ." to "
        .$adminUsername;

    }




    // Email changed

    if($oldAdmin['adminEmail'] != $adminEmail)
    {

        $changes[] =

        "email from "
        .$oldAdmin['adminEmail']
        ." to "
        .$adminEmail;

    }




    // Password changed

    if($adminPassword != "")
    {

        $changes[] =
        "password";

    }




    // Image changed

    if($imageChanged)
    {

        $changes[] =
        "profile image";

    }




    if(count($changes)>0)
    {

        $description =

        "Updated admin profile: "
        .
        implode(", ",$changes);

    }

    else

    {

        $description =

        "Updated admin profile without changes";

    }





    /*
    ==========================================
    INSERT AUDIT LOG
    ==========================================
    */


    createAuditLog(

        $conn,

        $_SESSION['adminID'],

        "Admin",

        "UPDATE",

        $adminUsername,

        $description

    );



    header(
        "Location: ../../admin/profile.php?success=1"
    );

    exit();

}

else

{

    die(
        "Update failed: "
        .mysqli_error($conn)
    );

}


?>