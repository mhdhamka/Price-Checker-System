<?php

session_start();

include("../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit("Student not logged in.");
}

if(!isset($_POST['itemID']))
{
    exit("Missing item ID.");
}

$studentID = $_SESSION['studentID'];
$itemID = (int)$_POST['itemID'];

$check = mysqli_query($conn,"
SELECT *
FROM wishlist
WHERE studentID='$studentID'
AND ItemID='$itemID'
");

if(mysqli_num_rows($check)>0)
{

    mysqli_query($conn,"
    DELETE
    FROM wishlist
    WHERE studentID='$studentID'
    AND ItemID='$itemID'
    ");

    echo "removed";

}
else
{

    mysqli_query($conn,"
    INSERT INTO wishlist
    (studentID, ItemID)
    VALUES
    ('$studentID', '$itemID')
    ");

    echo "added";

}