<?php

session_start();
include("../../config/db_cPCS.php");

if(!isset($_SESSION['studentID']))
{
    exit("Please login first.");
}

$studentID = $_SESSION['studentID'];

$itemID = intval($_POST['itemID']);

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

    mysqli_query(

    $conn,

    "

    UPDATE ratings

    SET

    rating='$rating',

    comment='$comment'

    WHERE ratingID='$ratingID'

    "

    );

}


/* ==========================================
INSERT
========================================== */

else
{

    mysqli_query(

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

}

echo "success";

?>