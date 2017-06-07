<?php

	include("database.php");

	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {


		$user = $_POST['username'];
		$pass = $_POST['password'];
		$password = password_hash($pass, PASSWORD_DEFAULT);

		$result = mysqli_query($conn, "SELECT username FROM account WHERE username = '$user'");
		if(is_null($result)){
    		header("location: login.php");
    	}
    	else{
			$_SESSION["username"] = $user;



			$sql_statement = "INSERT INTO account (username, hashed_password) 
							VALUES ('$user', '$password');";
			$result = mysqli_query($conn,$sql_statement);

			$sql_statement = "INSERT INTO folder (user_owner, type) 
							VALUES (\"$user\", \"files\")";
							echo "$sql_statement";
			mysqli_query($conn,$sql_statement);

			$sql_statement = "INSERT INTO folder (user_owner, type) 
							VALUES (\"$user\", \"config\")";
			mysqli_query($conn,$sql_statement);

			header("location: welcome.php");

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
					<form name="RegisterBox" method="post">
     		    		<p class="customfont">Username</p>
                  		<input type = "text" name = "username" class = "box" /><br>
     		    		<p class="customfont">Password</p>
                  		<input type = "password" name = "password" class = "box" /><br>
                  		<input type = "submit" style="visibility: hidden;" />
					</form>
				</div>
 			</div>
		</div>

    </body>
</html>
