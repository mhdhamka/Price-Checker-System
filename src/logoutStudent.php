<!---TMF 4935: Final Year Project--->
<!---Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->

<?php
	include "dbConnect_PCS.php";
	
	global $conn;
	$sql = "UPDATE student SET logStatus = 0 WHERE logStatus = 1";
	$result = mysqli_query($conn, $sql);				
	header('Location: index.php');
?>




