<?php

	include("database.php");

	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {


		$user = $_POST['username'];
		$pass = $_POST['password'];
		$password = password_hash($pass, PASSWORD_DEFAULT);

		$result = mysqli_query($conn, "SELECT hashed_password FROM account WHERE username = '$user'");
		$row = mysqli_fetch_array($result);
    	$verify = password_verify ($pass, $row[0]);

    	if($verify)
    	{
			$_SESSION["username"] = $user;
			header("location: welcome.php");
    	}
    	else
    	{
    		header("location: login.php");
    	}
	}
?>
<html>

	<head>
		<title>REGISTER</title>
    </head>

    <body bgcolor = "#101010">

    	<div class="outer">
  			<div class="middle">
   				 <div class="inner">

					<style type = "text/css">
						.outer {
    						display: table;
    						position: absolute;
    						height: 99%;
    						width: 99%;
						}

						.middle {
    						display: table-cell;
    						vertical-align: middle;
						}

						.inner {
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

					/*custom font, FOSS, no license http://luis.peralta.pt/AMDRTG*/

					</style>
					<form name="loginBox" method="post">
     		    		<p class="customfont">Login</p>
                  		<input type = "text" name = "username" class = "box" /><br><br>
                  		<input type = "password" name = "password" class = "box" /><br>
                  		<input type = "submit" style="visibility: hidden;" />
					</form>
				</div>
 			</div>
		</div>

    </body>
</html>
