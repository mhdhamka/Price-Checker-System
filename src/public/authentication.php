<?php

session_start();

include ("../includes/config/db_cPCS.php");

if(isset($_POST['login'])){


    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "

    SELECT *
    FROM users
    WHERE username = ?

    ";


    $stmt = $conn->prepare($sql);


    $stmt->bind_param(
        "s",
        $username
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $row = $result->fetch_assoc();

        if($password == $row['password']){

            $_SESSION['userID'] = $row['userID'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];



            // update login status
            $update = "

            UPDATE users
            SET logStatus = 1
            WHERE userID = ?

            ";


            $stmt2=$conn->prepare($update);

            $stmt2->bind_param(
                "i",
                $row['userID']
            );

            $stmt2->execute();


            if($row['role']=="admin"){


                header(
                "Location: admin/dashboard.php"
                );

            }
            else{

                header(
                "Location: user/dashboard.php"
                );

            }

            exit();

        }
        else{

            echo "
            <script>
            alert('Wrong password');
            window.location='login.php';
            </script>
            ";

        }

    }
    else{

        echo "
        <script>
        alert('Username not found');
        window.location='login.php';
        </script>
        ";

    }

}

?>