<?php

$id=$_POST['studentID'];

$password=md5($_POST['password']);

mysqli_query(

$conn,

"UPDATE student
SET password='$password'
WHERE studentID='$id'"

);

?>