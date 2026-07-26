<?php

session_start();

include("../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}

$adminID = (int)$_POST['adminID'];

/* Prevent disabling yourself */

if($adminID == $_SESSION['adminID'])
{
    header("Location: ../../admin/admins.php");
    exit();
}

mysqli_query(
    $conn,
    "
    UPDATE admin
    SET logStatus='0'
    WHERE adminID='$adminID'
    "
);

header("Location: ../../admin/admins.php");
exit();

?>