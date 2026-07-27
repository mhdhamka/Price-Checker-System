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
       ENABLE STUDENT
    =====================================
    */


    $result=mysqli_query(

    $conn,

    "
    UPDATE student

    SET logStatus='1'

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

            "Enabled student account ".$student['fullName']

        );

    }


}



header("Location: ../../admin/students.php");

exit();

?>