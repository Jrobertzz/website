<?php
	
	include("database.php");
	session_start();
	if(count($_SESSION) == 0)
		header("location: login.php");
	$ID = $_SESSION['username'];

	$query = mysqli_query($conn,"SELECT folder_id FROM folder WHERE user_owner = '$_SESSION[username]' AND type = 'files'");

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
    						width: 400;
						}

						@font-face {
						    font-family: "AMDRTG";
						    src: url(font/AMDRTG.ttf) format("truetype");
						}
						p.customfont { 
 				   			font-family: "AMDRTG";
  				  			color: #808080;

						}
						a {text-decoration: none;
						color: blue;}
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

					<form action="upload.php?folder=user" method="post" enctype="multipart/form-data">
    					<input type="file" name="fileToUpload" id="fileToUpload">
    					<input type="submit" value="Upload File" name="submit">
					</form>
  			</div>
  		</div>

    </body>

</html>