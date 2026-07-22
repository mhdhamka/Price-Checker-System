<?php

session_start();
include("../../config/db_cPCS.php");

/* ==========================================
CHECK LOGIN
========================================== */

if(!isset($_SESSION['studentID']))
{
    exit();
}

$studentID = $_SESSION['studentID'];

$itemID = isset($_GET['itemID']) ? (int)$_GET['itemID'] : 0;


/* ==========================================
GET STUDENT RATING
========================================== */

$sql = "

SELECT

rating,
comment

FROM ratings

WHERE studentID = '$studentID'

AND ItemID = '$itemID'

LIMIT 1

";

$result = mysqli_query($conn, $sql);


/* ==========================================
RETURN RESULT
========================================== */

if(mysqli_num_rows($result) > 0)
{

    $rating = mysqli_fetch_assoc($result);

    echo json_encode($rating);

}
else
{

    // Return empty string if student has never rated this item.
    echo "";

}

?>