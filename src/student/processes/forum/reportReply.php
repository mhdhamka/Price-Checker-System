<?php

session_start();

include("../../../config/db_cPCS.php");
include("../../../config/auditLog.php");

header("Content-Type: application/json");


/* ========================================
CHECK LOGIN
======================================== */

if(!isset($_SESSION['studentID']))
{

    echo json_encode([

        "status"=>"error",
        "message"=>"You must login first."

    ]);

    exit();

}


$studentID=(int)$_SESSION['studentID'];


/* ========================================
GET DATA
======================================== */

$replyID=(int)($_POST['replyID'] ?? 0);

$reason=trim($_POST['reason'] ?? '');


if($replyID<=0)
{

    echo json_encode([

        "status"=>"error",
        "message"=>"Invalid reply."

    ]);

    exit();

}


if($reason=="")
{

    echo json_encode([

        "status"=>"error",
        "message"=>"Please provide a reason."

    ]);

    exit();

}


/* ========================================
CHECK DUPLICATE
======================================== */

$check=mysqli_prepare($conn,"

SELECT reportID

FROM forumreport

WHERE replyID=?

AND studentID=?

LIMIT 1

");

mysqli_stmt_bind_param(

$check,

"ii",

$replyID,

$studentID

);

mysqli_stmt_execute($check);

$result=mysqli_stmt_get_result($check);

if(mysqli_num_rows($result)>0)
{

    echo json_encode([

        "status"=>"error",
        "message"=>"You already reported this reply."

    ]);

    exit();

}


/* ========================================
GET TOPIC TITLE FOR AUDIT
======================================== */

$audit=mysqli_prepare($conn,"

SELECT

t.topicTitle

FROM forumreply r

JOIN forumtopic t

ON r.topicID=t.topicID

WHERE r.replyID=?

LIMIT 1

");

mysqli_stmt_bind_param(

$audit,

"i",

$replyID

);

mysqli_stmt_execute($audit);

$auditResult=mysqli_stmt_get_result($audit);

$auditData=mysqli_fetch_assoc($auditResult);

$topicTitle=$auditData['topicTitle'] ?? "Reply";


/* ========================================
INSERT REPORT
======================================== */

$stmt=mysqli_prepare($conn,"

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

NULL,

?,

?,

?,

NOW()

)

");

mysqli_stmt_bind_param(

$stmt,

"iis",

$replyID,

$studentID,

$reason

);


if(mysqli_stmt_execute($stmt))
{

    createAuditLog(

        $conn,

        $studentID,

        "Forum",

        "REPORT_REPLY",

        $topicTitle,

        "Reported a reply in topic ".$topicTitle

    );

    echo json_encode([

        "status"=>"success",

        "message"=>"Reply reported successfully."

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