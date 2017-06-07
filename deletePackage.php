<?php
	
	include("database.php");
	session_start();
	if(count($_SESSION) == 0)
		header("location: login.php");
	$ID = $_SESSION['username'];
	$delete_package = $_GET['package'];

	$sql_statement = "DELETE FROM package WHERE package_name = '$delete_package'";
	$result = mysqli_query($conn,$sql_statement);
	header("location: welcome.php");

?>