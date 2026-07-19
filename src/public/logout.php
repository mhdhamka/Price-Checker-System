<?php
session_start();

include ("../config/db_cPCS.php");

global $conn;

// Logout student
$sqlStudent = "UPDATE student SET logStatus = 0 WHERE logStatus = 1";
mysqli_query($conn, $sqlStudent);


// Logout admin
$sqlAdmin = "UPDATE admin SET logStatus = 0 WHERE logStatus = 1";
mysqli_query($conn, $sqlAdmin);


// Destroy session
session_unset();
session_destroy();


// Redirect to login page
header("Location: index.php");
exit();

?>