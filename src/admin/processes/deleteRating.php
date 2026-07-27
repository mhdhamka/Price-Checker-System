<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}


$ratingID=(int)$_POST['ratingID'];


// Get rating details before delete

$rating=mysqli_fetch_assoc(

    mysqli_query(

        $conn,

        "
        SELECT 

        ratings.rating,
        item.ItemName,
        student.fullName

        FROM ratings

        JOIN item

        ON ratings.ItemID=item.ItemID

        JOIN student

        ON ratings.studentID=student.studentID

        WHERE ratingID='$ratingID'

        "

    )

);



if($rating)
{


    $result=mysqli_query(

        $conn,

        "

        DELETE
        FROM ratings
        WHERE ratingID='$ratingID'

        "

    );



    if($result)
    {

        createAuditLog(

            $conn,

            $_SESSION['adminID'],

            "Rating",

            "DELETE",

            $rating['ItemName'],

            "Deleted rating ".$rating['rating']." stars submitted by ".$rating['fullName']

        );

    }


}



header("Location: ../ratings.php");

exit();

?>