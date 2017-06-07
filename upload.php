<?php

	include("database.php");
	session_start();
	if(count($_SESSION) == 0)
		header("location: login.php");
	$ID = $_SESSION['username'];
	$source = $_GET['folder'];
	$folder_id = $_SESSION['group'];

    $filename = $_FILES["fileToUpload"]["name"];
    
    //******************************************CHANGE TO LOCATION YOU HAVE R/W PERMISSIONS*******
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "/home/robertsjw2/website/" . $_FILES["fileToUpload"]["name"]);


    if($source == "user")
		$sql_statement = "SELECT folder_id FROM folder WHERE user_owner = '$ID' AND type = 'files'";
	else
		$sql_statement = "SELECT folder_id FROM folder WHERE group_owner = '$folder_id'";

	$query = mysqli_query($conn,$sql_statement);

	while($row = $query->fetch_row())
    {
		foreach($row as $sys){
			$r = $sys;
		}
    }
	$sql_statement = "INSERT INTO our_file (filename, folder_id) 
		VALUES ('$filename', '$r')";
	mysqli_query($conn,$sql_statement);
    if($source == "user")
		header("location: files.php");
    else{
    	$url = "location: group.php?group=" . $_SESSION[group];
		header($url);
    }
?>
