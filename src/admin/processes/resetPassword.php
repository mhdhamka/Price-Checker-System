<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}


$studentID=(int)$_POST['studentID'];



/*
=====================================
   GET STUDENT INFORMATION
=====================================
*/

$studentQuery=mysqli_query(

$conn,

"
SELECT fullName

FROM student

WHERE studentID='$studentID'
"

);


$student=mysqli_fetch_assoc($studentQuery);



if($student)
{


    /*
    =====================================
       RESET PASSWORD
    =====================================
    */


    $password=password_hash(
        "12345678",
        PASSWORD_DEFAULT
    );


    $result=mysqli_query(

    $conn,

    "
    UPDATE student

    SET password='$password'

    WHERE studentID='$studentID'
    "

    );



    /*
    =====================================
       AUDIT LOG
    =====================================
    */


    if($result)

    {

        createAuditLog(

            $conn,

            $_SESSION['adminID'],

            "Student",

            "UPDATE",

            $student['fullName'],

            "Reset password for student ".$student['fullName']

        );

    }


}



header("Location: ../../admin/students.php");

exit();

?>