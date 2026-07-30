<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");

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

$itemQuery=mysqli_query($conn,"
    SELECT ItemName
    FROM item
    WHERE ItemID='$itemID'
");

$item=mysqli_fetch_assoc($itemQuery);

$itemName=$item['ItemName'];

$check = mysqli_query($conn,"
SELECT *
FROM wishlist
WHERE studentID='$studentID'
AND ItemID='$itemID'
");

if(mysqli_num_rows($check)>0)
{

    $result=mysqli_query($conn,"
    DELETE
    FROM wishlist
    WHERE studentID='$studentID'
    AND ItemID='$itemID'
    ");


    if($result)
    {

        createAuditLog(

            $conn,

            $studentID,

            "Wishlist",

            "REMOVE",

            $itemName,

            "Removed ".$itemName." from wishlist"

        );

    }


    echo "removed";

}
else
{

    $result=mysqli_query($conn,"
    INSERT INTO wishlist
    (studentID, ItemID)
    VALUES
    ('$studentID', '$itemID')
    ");


    if($result)
    {

        createAuditLog(

            $conn,

            $studentID,

            "Wishlist",

            "ADD",

            $itemName,

            "Added ".$itemName." to wishlist"

        );

    }


    echo "added";

}