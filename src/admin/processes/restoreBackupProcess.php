<?php

session_start();

include("../../config/db_cPCS.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../../public/loginAdmin.php");
    exit();
}



/*
==================================
CHECK FILE UPLOAD
==================================
*/

if(!isset($_FILES['backupFile']))
{
    header("Location: ../backup.php?restore=failed&msg=no_file");
    exit();
}



$file = $_FILES['backupFile'];

$fileName = $file['name'];

$fileTmp = $file['tmp_name'];



/*
==================================
CHECK FILE TYPE
==================================
*/

$extension = pathinfo($fileName, PATHINFO_EXTENSION);


if(strtolower($extension) != "sql")
{
    header("Location: ../backup.php?restore=failed");
    exit();
}


$checkBackup = mysqli_query(
$conn,
"
SELECT backupID
FROM backups
WHERE fileName='$fileNameSafe'
"
);


if(mysqli_num_rows($checkBackup)==0)
{
    header("Location: ../backup.php?restore=failed");
    exit();
}



/*
==================================
GET BACKUP ID
==================================
*/


$fileNameSafe = mysqli_real_escape_string(
    $conn,
    $fileName
);


$backupQuery = mysqli_query(
    $conn,
    "
    SELECT backupID
    FROM backups
    WHERE fileName='$fileNameSafe'
    "
);



$backupData = mysqli_fetch_assoc($backupQuery);



if(!$backupData)
{
    header("Location: ../backup.php?restore=failed&msg=not_found");
    exit();
}



$backupID = $backupData['backupID'];



/*
==================================
RESTORE DATABASE
==================================
*/


$database = "db_pcs";


$command = "\"C:/xampp/mysql/bin/mysql.exe\" -u root $database < \"$fileTmp\"";


exec($command,$output,$result);


if($result !== 0)
{
    header("Location: ../backup.php?restore=failed");
    exit();
}




/*
==================================
CHECK RESTORE RESULT
==================================
*/


if($output !== 0)
{

    header("Location: ../backup.php?restore=failed&msg=restore_error");
    exit();

}




/*
==================================
INSERT RESTORE LOG
==================================
*/


$adminID = $_SESSION['adminID'];

mysqli_query(
$conn,
"
INSERT INTO backup_logs
(
    backupID,
    action,
    performedBy
)

VALUES

(
    ".($backupID ? "'$backupID'" : "NULL").",
    'Restore Backup',
    '".$_SESSION['adminID']."'
)

"
);



/*
==================================
SUCCESS REDIRECT
==================================
*/


header("Location: ../backup.php?restore=success");

exit();


?>