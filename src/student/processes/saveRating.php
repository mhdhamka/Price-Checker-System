<?php

session_start();
include("../../config/db_cPCS.php");
include("../../config/auditLog.php");

if(!isset($_SESSION['studentID']))
{
    exit("Please login first.");
}

$studentID = $_SESSION['studentID'];

$itemID = intval($_POST['itemID']);

$itemQuery=mysqli_query($conn,"
    SELECT ItemName
    FROM item
    WHERE ItemID='$itemID'
");

$item=mysqli_fetch_assoc($itemQuery);

$itemName=$item['ItemName'];

$rating = floatval($_POST['rating']);

$comment = mysqli_real_escape_string(
$conn,
trim($_POST['comment'])
);


/* ==========================================
CHECK EXISTING RATING
========================================== */

$check = mysqli_query(

$conn,

"

    SELECT ratingID

    FROM ratings

    WHERE studentID='$studentID'

    AND ItemID='$itemID'

    LIMIT 1

"

);


/* ==========================================
UPDATE
========================================== */

if(mysqli_num_rows($check)>0)
{

    $row = mysqli_fetch_assoc($check);

    $ratingID = $row['ratingID'];

    $updateResult = mysqli_query(

    $conn,

    "

    UPDATE ratings

    SET

    rating='$rating',

    comment='$comment'

    WHERE ratingID='$ratingID'

    "

    );



    if($updateResult)
    {

        $itemQuery=mysqli_query($conn,"

            SELECT ItemName

            FROM item

            WHERE ItemID='$itemID'

        ");

        $item=mysqli_fetch_assoc($itemQuery);


        createAuditLog(

            $conn,

            $studentID,

            "Rating",

            "UPDATE",

            $item['ItemName'],

            "Updated rating for ".$item['ItemName']." to ".$rating." stars"

        );

    }

}


/* ==========================================
INSERT
========================================== */

else
{

   $insertResult = mysqli_query(

    $conn,

    "

    INSERT INTO ratings

    (

    ItemID,

    studentID,

    rating,

    comment

    )

    VALUES

    (

    '$itemID',

    '$studentID',

    '$rating',

    '$comment'

    )

    "

    );



    if($insertResult)
    {

        $itemQuery=mysqli_query($conn,"

            SELECT ItemName

            FROM item

            WHERE ItemID='$itemID'

        ");

        $item=mysqli_fetch_assoc($itemQuery);


        createAuditLog(

            $conn,

            $studentID,

            "Rating",

            "ADD",

            $item['ItemName'],

            "Rated ".$item['ItemName']." with ".$rating." stars"

        );

    }

}

echo "success";

?>