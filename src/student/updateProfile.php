<?php
session_start();

include("../config/db_cPCS.php");
include("../config/auditLog.php");


// Check login
if (!isset($_SESSION['studentID'])) {
    header("Location: ../public/login.php");
    exit();
}


$studentID = $_SESSION['studentID'];


// Get current student data
$sql = "SELECT * FROM student WHERE studentID = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $studentID
);

mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


if (!$result || mysqli_num_rows($result) == 0) 
{
    die("Student not found.");
}


$row = mysqli_fetch_assoc($result);



// Get old username for audit
$oldUsername = $row['username'];



// Get form values
$fullName = trim($_POST['fullName']);
$username = trim($_POST['username']);
$email    = trim($_POST['email']);
$password = trim($_POST['password']);


// Keep existing image
$imagePath = $row['studentIMG'];



// =====================
// Upload New Image
// =====================

if(isset($_FILES['studentIMG']) && $_FILES['studentIMG']['error'] == 0)
{

    $targetFolder = "../../assets/images/profile/";


    if(!is_dir($targetFolder))
    {
        mkdir($targetFolder,0777,true);
    }


    $extension = strtolower(
        pathinfo(
            $_FILES['studentIMG']['name'],
            PATHINFO_EXTENSION
        )
    );


    $allowed=array(
        "jpg",
        "jpeg",
        "png",
        "webp"
    );


    if(in_array($extension,$allowed))
    {

        $newFileName =
        "student_".$studentID."_".time().".".$extension;


        $targetFile=$targetFolder.$newFileName;


        if(move_uploaded_file(
            $_FILES['studentIMG']['tmp_name'],
            $targetFile
        ))
        {

            $imagePath =
            "../../assets/images/profile/".$newFileName;

        }

    }

}




// =====================
// Update Profile
// =====================


if($password!="")
{

    $hashedPassword=password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    $sql="
    UPDATE student

    SET

    fullName=?,

    username=?,

    email=?,

    password=?,

    studentIMG=?

    WHERE studentID=?
    ";


    $stmt=mysqli_prepare($conn,$sql);


    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $fullName,
        $username,
        $email,
        $hashedPassword,
        $imagePath,
        $studentID
    );


}
else
{


    $sql="
    UPDATE student

    SET

    fullName=?,

    username=?,

    email=?,

    studentIMG=?

    WHERE studentID=?
    ";


    $stmt=mysqli_prepare($conn,$sql);


    mysqli_stmt_bind_param(
        $stmt,
        "ssssi",
        $fullName,
        $username,
        $email,
        $imagePath,
        $studentID
    );

}




if(mysqli_stmt_execute($stmt))
{


    /*
    =====================================
    AUDIT LOG
    =====================================
    */


    createAuditLog(

        $conn,

        $studentID,

        "Profile",

        "UPDATE_PROFILE",

        $username,

        "Updated profile information for ".$username

    );



    // Update session

    $_SESSION['username']=$username;

    $_SESSION['fullName']=$fullName;

    $_SESSION['email']=$email;



    echo "

    <script>

        alert('Profile updated successfully!');

        window.location='profile.php';

    </script>

    ";

}
else
{

    echo "

    <script>

        alert('Failed to update profile.');

        history.back();

    </script>

    ";

}


?>