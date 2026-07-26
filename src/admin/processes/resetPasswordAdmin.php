<?php

session_start();

include("../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}

$adminID = (int)$_POST['adminID'];

/* Default password: 12345678 */

$password = password_hash(
    "12345678",
    PASSWORD_DEFAULT
);

mysqli_query(
    $conn,
    "
    UPDATE admin
    SET adminPassword='$password'
    WHERE adminID='$adminID'
    "
);

header("Location: ../../admin/admins.php");
exit();

?>