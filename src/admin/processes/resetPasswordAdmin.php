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


/* Default password: 12345678 */

$password = password_hash(
    "12345678",
    PASSWORD_DEFAULT
);

$result=mysqli_query(

$conn,

"
UPDATE admin

SET adminPassword='$password'

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

        "Reset password for admin ".$admin['adminFullname']

    );

}

header("Location: ../../admin/admins.php");
exit();

?>