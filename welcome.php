<?php

include("database.php");

	session_start();
	if(count($_SESSION) == 0)
		header("location: login.php");
	$ID = $_SESSION['username'];

	$result = mysqli_query($conn,"SELECT operating_system, architecture FROM system WHERE username = '$_SESSION[username]'");

	while($row = $result->fetch_row())
        {
            $rows[]=$row;
        }



	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$system = $_POST['OperatingSystem'];
		$arch = $_POST['architecture'];
		print_r($system);
		print_r($arch);

		$sql_statement = "INSERT INTO system (username, architecture, operating_system)
		VALUES ('$ID', '$arch', '$system')";
		mysqli_query($conn, $sql_statement);

		header("location: welcome.php");

	}

?>

<html>

	<head>
		<title>WELCOME</title>
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

     		    	<p class="customfont"><?php echo $_SESSION['username']; ?></p>

					<p class="customfont"><?php 
					if(isset($rows)){
						foreach($rows as $sys){
							$link = $sys[0];

							foreach($sys as $val){
    							echo '<a href=system.php?sys=' . htmlspecialchars($link) . '>' . htmlspecialchars($val) . '</a>';
    							echo "<br>";
							}
    						echo "<br>";
						}
					}

						echo '<a href=files.php>files</a>';
						echo "<br>";
						echo "<br>";
						echo '<a href=groups.php>groups</a>';




					 ?></p>


					<form name="NewSysBox" method="post">
     		    		<p class="customfont">enter operating system and architecture</p>
                  		<input type = "text" name = "OperatingSystem" class = "box" /><br><br>
                  		<input type = "text" name = "architecture" class = "box" /><br><br>
                  		<input type = "submit" style="visibility: hidden;" />
					</form>


  			</div>
  		</div>

    </body>

</html>