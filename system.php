<?php
	
	include("database.php");
	session_start();
	if(count($_SESSION) == 0)
		header("location: login.php");
	$ID = $_GET['sys'];

	$query = mysqli_query($conn,"SELECT sys_id FROM system WHERE username = '$_SESSION[username]' AND operating_system = '$ID'");

	while($row = $query->fetch_row())
    {
		foreach($row as $sys){
			$r = $sys;
		}
    }


	$result = mysqli_query($conn, "SELECT package_name FROM package WHERE sys_id = '$r'");

	while($row = $result->fetch_row())
        {
            $rows[]=$row;
        }


	if($_SERVER["REQUEST_METHOD"] == "POST") {


		$package = $_POST['NewPackage'];

		$sql_statement = "INSERT INTO package (package_name, sys_id)
		VALUES ('$package', '$r')";
		echo "$sql_statement";
		mysqli_query($conn, $sql_statement);

		header("location: welcome.php");




	}



?>

<html>

	<head>
		<title>SYSTEM</title>
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


						.box {
							width: 200px;
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
						foreach($rows as $sys){
							foreach($sys as $package){
								echo '<a href=deletePackage.php?package=' . htmlspecialchars($package) . '>delete   </a>';
								echo '<a href=editPackage.php?package=' . htmlspecialchars($package) . '>edit</a>';
								echo $package;
    							echo "<br>";
    							echo "<br>";
							}
						}
					}
     		    	?></p>

					<form name="NewSysBox" method="post">
     		    		<p class="customfont">New Package</p>
                  		<input type = "text" name = "NewPackage" class = "box" />
                  		<input type = "submit" style="visibility: hidden;" />
					</form>

     		    	<p class="customfont"><?php 
					echo '<a href=configfiles.php>Configuration Files</a>';
     		    	?>


  			</div>
  		</div>

    </body>

</html>