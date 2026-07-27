<?php

session_start();

include("../../config/db_cPCS.php");

include("../../config/auditLog.php");


if(!isset($_SESSION['adminID']))
{
    header("Location: ../../public/loginAdmin.php");
    exit();
}


/*
==================================
CREATE BACKUP FOLDER
==================================
*/

$folder = "../backups/";


if(!is_dir($folder))
{
    mkdir($folder,0777,true);
}



/*
==================================
BACKUP FILE NAME
==================================
*/

$date = date("Ymd_His");

$fileName = "database_".$date.".sql";

$filePath = $folder.$fileName;



/*
==================================
DATABASE CONFIG
==================================
*/

$database = "db_pcs";



/*
==================================
MYSQL DUMP
==================================
*/

$command = "\"C:/xampp/mysql/bin/mysqldump.exe\" -u root $database > \"$filePath\"";


system($command,$output);



/*
==================================
CHECK BACKUP
==================================
*/

if(!file_exists($filePath))
{
    die("Backup failed. File not created.");
}


if(filesize($filePath)==0)
{
    unlink($filePath);

    die("Backup failed. SQL file is empty.");
}



/*
==================================
FILE SIZE
==================================
*/

$fileSize = round(
    filesize($filePath)/1024,
    2
)." KB";



/*
==================================
SAVE HISTORY
==================================
*/

mysqli_query(
$conn,
"
INSERT INTO backups
(
fileName,
fileSize,
createdBy
)

VALUES

(
'$fileName',
'$fileSize',
'".$_SESSION['adminID']."'
)

"
);


$backupID = mysqli_insert_id($conn);


/*
==================================
BACKUP LOG TABLE
==================================
*/

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
'$backupID',
'Created Backup',
'".$_SESSION['adminID']."'
)

"
);


/*
==================================
AUDIT LOG
==================================
*/

createAuditLog(

    $conn,

    $_SESSION['adminID'],

    "Backup",

    "CREATE",

    $fileName,

    "Created database backup ".$fileName

);


header("Location: ../backup.php");

?>