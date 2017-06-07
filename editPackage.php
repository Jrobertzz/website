<?php
	
	include("database.php");
	session_start();
	if(count($_SESSION) == 0)
		header("location: login.php");
	$ID = $_SESSION['username'];
	$edit_package = $_GET['package'];


	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$package_name = $_POST['NewPackage'];
		$sql_statement = "UPDATE `package` SET `package_name`='$package_name' WHERE package_name = '$edit_package'";
		mysqli_query($conn,$sql_statement);
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


					<form name="NewPackageName" method="post">
     		    		<p class="customfont">enter new package name</p>
                  		<input type = "text" name = "NewPackage" class = "box" />
                  		<input type = "submit" style="visibility: hidden;" />
					</form>


  			</div>
  		</div>

    </body>

</html>