<?php

session_start();

include("../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}

$studentID=(int)$_POST['studentID'];

/*
Default password:
12345678
*/

$password=password_hash("12345678",PASSWORD_DEFAULT);

mysqli_query($conn,"
UPDATE student
SET password='$password'
WHERE studentID='$studentID'
");

header("Location: ../students.php");
exit();