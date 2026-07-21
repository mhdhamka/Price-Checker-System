<?php

session_start();

include("../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}

$studentID=(int)$_POST['studentID'];

mysqli_query($conn,"
UPDATE student
SET logStatus='1'
WHERE studentID='$studentID'
");

header("Location: ../../admin/students.php");
exit();