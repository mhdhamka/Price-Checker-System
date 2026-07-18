<?php


include ("../config/db_cPCS.php");


if(isset($_POST['register'])){


    $fullname=$_POST['fullName'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];


    // check duplicate username

    $check="

    SELECT *
    FROM users
    WHERE username=?
    OR email=?

    ";


    $stmt=$conn->prepare($check);

    $stmt->bind_param(
        "ss",
        $username,
        $email
    );


    $stmt->execute();


    $result=$stmt->get_result();


    if($result->num_rows>0){


        echo "

        <script>
        alert('Username or email already exists');
        window.location='register.php';
        </script>

        ";

        exit();

    }


    $profileIMG="assets/images/default.png";



    $sql="

    INSERT INTO users

    (
    fullName,
    username,
    email,
    password,
    profileIMG,
    role
    )


    VALUES

    (?,?,?,?,?, 'user')

    ";


    $stmt=$conn->prepare($sql);


    $stmt->bind_param(

    "sssss",

    $fullname,
    $username,
    $email,
    $password,
    $profileIMG

    );


    if($stmt->execute()){


        echo "

        <script>

            alert('Registration successful');

            window.location='login.php';

        </script>

        ";
    }

    else{

        echo $conn->error;

    }

}

?>