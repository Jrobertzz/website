<?php
	
	include("database.php");
	session_start();
	if(count($_SESSION) == 0)
		header("location: login.php");
	$ID = $_SESSION['username'];
	$delete_file = $_GET['filename'];

	$sql_statement = "DELETE FROM our_file WHERE filename = '$delete_file'";
	mysqli_query($conn,$sql_statement);
	header("location: welcome.php");

?>