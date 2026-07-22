<?php

session_start();

include("../../config/db_cPCS.php");

if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}

$ratingID=(int)$_POST['ratingID'];

mysqli_query(

    $conn,

    "DELETE
     FROM ratings
     WHERE ratingID='$ratingID'"

);

header("Location: ../ratings.php");
exit();

?>