<?php


function logReport($conn,$adminID,$type,$format)
{

    $type=mysqli_real_escape_string($conn,$type);

    $format=mysqli_real_escape_string($conn,$format);


    mysqli_query($conn,"

    INSERT INTO report_logs

    (
        adminID,
        reportType,
        format
    )

    VALUES

    (
        '$adminID',
        '$type',
        '$format'
    )

    ");

}

?>