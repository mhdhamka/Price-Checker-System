<?php

session_start();

include("../../../config/db_cPCS.php");


header('Content-Type: application/json');



if(!isset($_SESSION['studentID']))
{

echo json_encode([
    "error"=>"Not logged in"
]);

exit();

}



if(!isset($_POST['topicID']))
{

echo json_encode([
    "error"=>"Missing topic ID"
]);

exit();

}



$studentID=(int)$_SESSION['studentID'];

$topicID=(int)$_POST['topicID'];





$sql="

SELECT

topicID,
topicTitle,
topicContent,
categoryID

FROM forumtopic

WHERE topicID='$topicID'

AND studentID='$studentID'

LIMIT 1

";



$result=mysqli_query($conn,$sql);



if(mysqli_num_rows($result)==0)
{


echo json_encode([

"error"=>"Topic not found or you do not own this topic"

]);


exit();


}




echo json_encode(mysqli_fetch_assoc($result));


exit();

?>