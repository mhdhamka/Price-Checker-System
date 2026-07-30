<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");

header("Content-Type: application/json");


/*
================================
CHECK LOGIN
================================
*/

if(!isset($_SESSION['studentID']))
{

    echo json_encode([

        "status"=>"error",
        "message"=>"You must login first."

    ]);

    exit();

}

$studentID = (int)$_SESSION['studentID'];


/*
================================
GET DATA
================================
*/

$topicID = (int)($_POST['topicID'] ?? 0);

$reason = trim($_POST['reason'] ?? '');


if($topicID <= 0)
{

    echo json_encode([

        "status"=>"error",
        "message"=>"Invalid topic."

    ]);

    exit();

}


if($reason == "")
{

    echo json_encode([

        "status"=>"error",
        "message"=>"Please provide a reason."

    ]);

    exit();

}


/*
================================
CHECK DUPLICATE REPORT
================================
*/

$check = mysqli_prepare($conn, "

SELECT reportID

FROM forumreport

WHERE topicID=?

AND studentID=?

LIMIT 1

");

mysqli_stmt_bind_param(
    $check,
    "ii",
    $topicID,
    $studentID
);

mysqli_stmt_execute($check);

$result = mysqli_stmt_get_result($check);

if(mysqli_num_rows($result) > 0)
{

    echo json_encode([

        "status"=>"error",
        "message"=>"You already reported this topic."

    ]);

    exit();

}


/*
================================
GET TOPIC TITLE FOR AUDIT LOG
================================
*/

$audit = mysqli_prepare($conn, "

SELECT topicTitle

FROM forumtopic

WHERE topicID=?

LIMIT 1

");

mysqli_stmt_bind_param(
    $audit,
    "i",
    $topicID
);

mysqli_stmt_execute($audit);

$auditResult = mysqli_stmt_get_result($audit);

$auditData = mysqli_fetch_assoc($auditResult);

$topicTitle = $auditData['topicTitle'] ?? "Unknown Topic";


/*
================================
INSERT REPORT
================================
*/

$stmt = mysqli_prepare($conn, "

INSERT INTO forumreport

(

    topicID,
    replyID,
    studentID,
    reason,
    created_at

)

VALUES

(

    ?,
    NULL,
    ?,
    ?,
    NOW()

)

");

mysqli_stmt_bind_param(

    $stmt,

    "iis",

    $topicID,

    $studentID,

    $reason

);


if(mysqli_stmt_execute($stmt))
{

    createAuditLog(

        $conn,

        $studentID,

        "Forum",

        "REPORT_TOPIC",

        $topicTitle,

        "Reported forum topic: ".$topicTitle

    );

    echo json_encode([

        "status"=>"success",
        "message"=>"Report submitted successfully."

    ]);

}
else
{

    echo json_encode([

        "status"=>"error",
        "message"=>"Failed to submit report."

    ]);

}

mysqli_stmt_close($stmt);

?>