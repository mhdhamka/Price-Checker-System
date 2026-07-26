<?php

session_start();

include("../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}

$adminID = (int)$_POST['adminID'];

mysqli_query(
    $conn,
    "
    UPDATE admin
    SET logStatus='1'
    WHERE adminID='$adminID'
    "
);

header("Location: ../../admin/admins.php");
exit();

?>