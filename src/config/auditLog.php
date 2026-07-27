<?php


/* ==========================================
   GET USER IP ADDRESS
========================================== */

function getUserIP()
{

    $ip = $_SERVER['REMOTE_ADDR'];


    // Convert localhost IPv6 to IPv4
    if($ip == "::1")
    {
        $ip = "127.0.0.1";
    }


    return $ip;

}



/* ==========================================
   CREATE AUDIT LOG
========================================== */

function createAuditLog(
    $conn,
    $adminID,
    $module,
    $action,
    $target,
    $description
)

{


    $ipAddress = getUserIP();


    $module = mysqli_real_escape_string($conn,$module);

    $action = mysqli_real_escape_string($conn,$action);

    $target = mysqli_real_escape_string($conn,$target);

    $description = mysqli_real_escape_string($conn,$description);



    $query = "

    INSERT INTO audit_logs

    (
        adminID,
        module,
        action,
        target,
        description,
        ipAddress
    )


    VALUES

    (
        '$adminID',
        '$module',
        '$action',
        '$target',
        '$description',
        '$ipAddress'
    )

    ";


    mysqli_query($conn,$query);


}


?>