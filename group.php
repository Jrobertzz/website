<?php
	
	include("database.php");
	session_start();
	if(count($_SESSION) == 0)
		header("location: login.php");
	$ID = $_GET['group'];
	$_SESSION['group']=$ID;


	$sql_statement = "SELECT folder_id FROM folder WHERE group_owner = '$ID'";

	$query = mysqli_query($conn,$sql_statement);

	while($row = $query->fetch_row())
    {
		foreach($row as $sys){
			$r = $sys;
		}
    }

	$result = mysqli_query($conn, "SELECT filename FROM our_file WHERE folder_id = '$r'");
	while($row = $result->fetch_row())
        {
            $rows[]=$row;
        }

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$new_user = $_POST['InviteUser'];
		$sql_statement = "UPDATE user_group SET users = '$new_user'";

		$query = mysqli_query($conn,$sql_statement);

	}



?>

<html>

	<head>
		<title>FILES</title>
    </head>

    <body bgcolor = "#101010">

    	<div class="outer">
  			<div class="middle">

					<style type = "text/css">

						.outer {
    						display: table;
    						position: absolute;
    						height: 99%;
    						width: 99%;
						}

						.middle {
   							margin-left: auto;
    						margin-right: auto; 
    						width: 200;
						}

						@font-face {
						    font-family: "AMDRTG";
						    src: url(font/AMDRTG.ttf) format("truetype");
						}
						p.customfont { 
 				   			font-family: "AMDRTG";
  				  			color: #808080;
							text-align: center;
						}
						a {text-decoration: none; }

					</style>

					<br>

     		    	<p class="customfont"><?php echo $ID; ?></p>

     		    	<p class="customfont"><?php

					if(isset($rows)){
						foreach($rows as $folder){
							foreach($folder as $file){
								echo '<a href=delete.php?filename=' . htmlspecialchars($file) . '>delete   </a>';
								echo '<a href=uploads.php?filename=' . htmlspecialchars($file) . '>' . htmlspecialchars($file) . '</a>';
    							echo "<br>";
							}
    					echo "<br>";
						}
					}
     		    	?></p>

					<form action="upload.php?folder=group" method="post" enctype="multipart/form-data">
    					<input type="file" name="fileToUpload" id="fileToUpload">
    					<input type="submit" value="Upload File" name="submit">
					</form>

					<form name="InviteUser" method="post">
     		    		<p class="customfont">Add User</p>
                  		<input type = "text" name = "InviteUser" class = "box" /><br><br>
                  		<input type = "submit" style="visibility: hidden;" />
					</form>
  			</div>
  		</div>

    </body>

</html>