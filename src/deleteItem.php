<!---TMF 4935: Final Year Project--->
<!---Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->

<?php
	include("dbConnect_PCS.php");

	$deleteID = $_GET['deleteID'];
	global $conn;
	$sql = "DELETE FROM item WHERE ItemID = $deleteID";
	$result = mysqli_query($conn, $sql);

	header("Location:indexAdmin.php");
?>