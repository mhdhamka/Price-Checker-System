<?php

session_start();

include("../../config/db_cPCS.php");
include("../../config/auditLog.php");

if(!isset($_SESSION['adminID']))
{
    exit("Access denied.");
}

$adminID = (int)$_POST['adminID'];

$admin=mysqli_fetch_assoc(

mysqli_query(

$conn,

"
SELECT adminFullname
FROM admin
WHERE adminID='$adminID'
"

)

);


/* Prevent disabling yourself */

if($adminID == $_SESSION['adminID'])
{
    header("Location: ../../admin/admins.php");
    exit();
}

$result=mysqli_query(

$conn,

"
UPDATE admin

SET logStatus='0'

WHERE adminID='$adminID'

"

);



if($result)

{

    createAuditLog(

        $conn,

        $_SESSION['adminID'],

        "Admin",

        "UPDATE",

        $admin['adminFullname'],

        "Disabled admin account ".$admin['adminFullname']

    );

}

header("Location: ../../admin/admins.php");
exit();

?>