<?php

session_start();

include ("../includes/config/db_cPCS.php");


if(isset($_SESSION['userID'])){


    $userID=$_SESSION['userID'];

    $sql="

    UPDATE users
    SET logStatus=0
    WHERE userID=?

    ";


    $stmt=$conn->prepare($sql);

    $stmt->bind_param(
    "i",
    $userID
    );


    $stmt->execute();

}

session_destroy();

header(
    "Location: login.php"
);

exit();

?>