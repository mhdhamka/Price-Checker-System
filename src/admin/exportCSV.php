<?php

session_start();

include("../config/db_cPCS.php");

include("../admin/processes/reportLogger.php");

include("../config/auditLog.php");

$adminID=$_SESSION['adminID'] ?? null;


if(!$adminID)
{
    exit("Access denied.");
}

$type = $_GET['type'] ?? "item";

/* ==========================================
   ITEM REPORT
========================================== */

if($type == "item")
{

    $headers = [

        "Product Name",
        "Category",
        "Store",
        "Price"

    ];

    $sql = "

    SELECT

    ItemName,
    ItemCategory,
    StoreName,
    ItemPrice

    FROM item

    ORDER BY ItemName

    ";

    $filename = "Item_Report.csv";

}

/* ==========================================
   STUDENT REPORT
========================================== */

else if($type == "student")
{

    $headers = [

        "Student ID",
        "Full Name",
        "Username",
        "Email",
        "Status",
        "Total Ratings"

    ];

    $sql = "

    SELECT

    student.studentID,
    student.fullName,
    student.username,
    student.email,

    CASE
        WHEN student.logStatus = 1
        THEN 'Active'
        ELSE 'Disabled'
    END AS Status,

    COUNT(ratings.ratingID) AS TotalRatings

    FROM student

    LEFT JOIN ratings

    ON student.studentID = ratings.studentID

    GROUP BY student.studentID

    ORDER BY student.fullName

    ";

    $filename = "Student_Report.csv";

}

/* ==========================================
   RATING REPORT
========================================== */

else if($type == "rating")
{

    $headers = [

        "Rating ID",
        "Product",
        "Student",
        "Rating",
        "Comment",
        "Date Created"

    ];

    $sql = "

    SELECT

    ratings.ratingID,
    item.ItemName,
    student.fullName,
    ratings.rating,
    ratings.comment,
    ratings.dateCreated

    FROM ratings

    JOIN item

    ON ratings.ItemID = item.ItemID

    JOIN student

    ON ratings.studentID = student.studentID

    ORDER BY ratings.dateCreated DESC

    ";

    $filename = "Rating_Report.csv";

}

/* ==========================================
   CATEGORY REPORT
========================================== */

else if($type == "category")
{

    $headers = [

        "Category",
        "Total Items",
        "Average Price"

    ];

    $sql = "

    SELECT

    ItemCategory,

    COUNT(*) AS TotalItems,

    ROUND(AVG(ItemPrice),2) AS AveragePrice

    FROM item

    GROUP BY ItemCategory

    ORDER BY TotalItems DESC

    ";

    $filename = "Category_Report.csv";

}

/* ==========================================
   STORE REPORT
========================================== */

else if($type == "store")
{

    $headers = [

        "Store",
        "Total Items",
        "Average Price"

    ];

    $sql = "

    SELECT

    StoreName,

    COUNT(*) AS TotalItems,

    ROUND(AVG(ItemPrice),2) AS AveragePrice

    FROM item

    GROUP BY StoreName

    ORDER BY TotalItems DESC

    ";

    $filename = "Store_Report.csv";

}

/* ==========================================
   EXPORT CSV
========================================== */

$result = mysqli_query($conn, $sql);

header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$filename);

/* UTF-8 BOM for Excel compatibility */
echo "\xEF\xBB\xBF";

$output = fopen("php://output","w");

/* Header */
fputcsv($output, $headers);

/* Data */
while($row = mysqli_fetch_assoc($result))
{
    fputcsv($output, $row);
}

fclose($output);

logReport(
    $conn,
    $adminID,
    $type,
    "CSV"
);



createAuditLog(

    $conn,

    $adminID,

    "Report",

    "EXPORT",

    ucfirst($type)." Report CSV",

    "Generated ".ucfirst($type)." report in CSV format"

);



exit();

?>