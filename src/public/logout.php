<?php

session_start();

include("../config/db_cPCS.php");
include("../config/auditLog.php");


/* =====================================
   AUDIT LOG - ADMIN LOGOUT
===================================== */


if(isset($_SESSION['adminID']))
{

    $adminID = $_SESSION['adminID'];

    createAuditLog(
        $conn,
        $adminID,
        "Admin",
        "LOGOUT",
        "Admin Account",
        "Admin logged out from the system"
    );

}


/* =====================================
   UPDATE LOGIN STATUS
===================================== */


// Logout student

mysqli_query(
$conn,
"
UPDATE student 
SET logStatus = 0 
WHERE logStatus = 1
"
);


// Logout admin

mysqli_query(
$conn,
"
UPDATE admin 
SET logStatus = 0 
WHERE logStatus = 1
"
);



/* =====================================
   DESTROY SESSION
===================================== */

session_unset();

session_destroy();



header("Location: index.php");

exit();

?>