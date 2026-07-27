<?php

session_start();

include("../config/db_cPCS.php");

include("../config/auditLog.php");



/* =====================================
   AUDIT LOG - LOGOUT
===================================== */


if(isset($_SESSION['adminID']))
{

    createAuditLog(

        $conn,

        $_SESSION['adminID'],

        "Authentication",

        "LOGOUT",

        "Admin Account",

        "Admin logged out from the system"

    );

}



else if(isset($_SESSION['studentID']))
{

    createAuditLog(

        $conn,

        $_SESSION['studentID'],

        "Authentication",

        "LOGOUT",

        "Student Account",

        "Student logged out from the system"

    );

}



/* =====================================
   UPDATE LOGIN STATUS
===================================== */


// Logout student

if(isset($_SESSION['studentID']))
{

    mysqli_query(
    $conn,
    "
    UPDATE student

    SET logStatus = 0

    WHERE studentID='".$_SESSION['studentID']."'
    "
    );

}



// Logout admin

if(isset($_SESSION['adminID']))
{

    mysqli_query(
    $conn,
    "
    UPDATE admin

    SET logStatus = 0

    WHERE adminID='".$_SESSION['adminID']."'
    "
    );

}



/* =====================================
   DESTROY SESSION
===================================== */


session_unset();

session_destroy();



header("Location: index.php");

exit();


?>