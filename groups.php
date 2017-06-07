<?php
	
	include("database.php");
	session_start();
	if(count($_SESSION) == 0)
		header("location: login.php");
	$ID = $_SESSION['username'];


	$query = mysqli_query($conn,"SELECT group_id FROM user_group WHERE users = '$_SESSION[username]' OR admin_username = '$_SESSION[username]'");

	while($row = $query->fetch_row())
    {
		foreach($row as $groups){
			$group[] = $groups;
		}
    }
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$new_group = $_POST['group_name'];
		$sql_statement = "INSERT INTO user_group (group_id, admin_username, users) VALUES ('$new_group', '$ID', '$ID')";
		mysqli_query($conn, $sql_statement);

		$sql_statement = "INSERT INTO folder (group_owner) VALUES ('$new_group')";
		$result = mysqli_query($conn, $sql_statement);

		$last_id = $conn->insert_id;

		$sql_statement = "INSERT INTO user_group (folder) VALUES ('$last_id')";
		$result = mysqli_query($conn, $sql_statement);

		header("location: groups.php");
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

     		    	<p class="customfont"><?php echo 'groups'; ?></p>

     		    		<p class="customfont"><?php

						if(isset($group)){
							foreach($group as $g){
								echo '<a href=group.php?group=' . htmlspecialchars($g) . '>' . htmlspecialchars($g) . '</a>';
    							echo "<br>";
							}
						}
						?>

						<form name="NewGroup" method="post">
     		    			<p class="customfont">New Group</p>
                  			<input type = "text" name = "group_name" class = "box" /><br><br>
                  			<input type = "submit" style="visibility: hidden;" />
						</form>
			</div>
		</div>
	</body>
</html>