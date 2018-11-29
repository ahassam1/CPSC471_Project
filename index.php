<html>
	<!-- --------------------------HEAD------------------------- -->
	<head>
		<!-- Add Page Information and CSS Here -->
		<title>Login</title>
		<link rel="stylesheet" type= "text/css" href= "bootstrap-lumen-theme.css">
		
		<style>
		
		.username {
		width: 275px;
		border_radius: 5px;
		padding: 10px;
		height: 50px;
		position: absolute;
		margin-top: -100px;
		margin-left: -400px;
		top: 50%;
		left: 68%;
		}
		
		.form-group {
		width: 275px;
		border_radius: 5px;
		padding: 10px;
		height: 50px;
		position: absolute;
		margin-top: -50px;
		margin-left: -400px;
		top: 50%;
		left: 68%;
		}
		
		.enter{
		width: 800px;
		border_radius: 5px;
		padding: 10px;
		height: 50px;
		position: absolute;
		margin-top: -0px;
		margin-left: -300px;
		top: 50%;
		left: 68%;
		}
		
		body {
		width: 1368px;
		height: 850px;
		background-image: url("LoginOverlay.png");
		background-position: left top;
		background-attachment: fixed;
		background-repeat: no-repeat;
		background-size: 1370px 820px;
		}
		
		h1 {
		color: #158CBA;
		font-family: sans-serif;
		font-size: 100;
		position: absolute;
		margin-top: -0px;
		margin-left: -305px;
		top: 20%;
		left: 60%;
		}
		
		</style>
	</head>
	
	<body scroll="vertical" style="overflow: hidden"> <!-- --------------------------BODY------------------------- -->
		
		<h1>LOGIN</h1>
		
		<!-- Username & Password Input -->	
			<div class= "username">
				<input type="text" class="form-control" placeholder="Username" id="username"> 
			</div>
			<br></br>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" id="pass">
				
			</div>
			<br></br>
			<div class= "enter">
				<input type= "submit" class="btn btn-outline-primary" value= "Sign In">
			</div>	
		
<!-- ----------------------------PHP----------------------------------- -->
<?php
//based on https://www.w3schools.com/php/php_mysql_create.asp

	$servername = "localhost";
	$username = "admin";
	$password = "password";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	// Create database
	$sql = "CREATE DATABASE IF NOT EXISTS TutorScheduleDB";
	if ($conn->query($sql) === TRUE) {
		//echo nl2br("TutorScheduleDB created successfully\n");
	} else {
		//echo "Error creating database: " . $conn->error;
	}

	$conn = new mysqli($servername, $username, $password, "TutorScheduleDB");

	//how to use foreign keys https://stackoverflow.com/questions/22211452/getting-syntax-error-when-declaring-foreign-keys-in-mysql-using-innodb

	$sql = "CREATE TABLE IF NOT EXISTS CLIENT (
			SIN INT PRIMARY KEY,
			Name VARCHAR(30) NOT NULL
			)";
		
	if ($conn->query($sql) === TRUE) {
		//echo nl2br("Table Client created successfully\n");
	} 
	else {
		//echo "Error creating table: " . $conn->error;
	}
	
	$sql = "CREATE TABLE IF NOT EXISTS PROGRAM (
		ID INT PRIMARY KEY,
		Subject VARCHAR(30),
		Grade_level INT
		)";
	if ($conn->query($sql) === TRUE) 
	{
		//echo nl2br("Table Program created successfully\n\r");
	} 
	else 
	{
		//echo "Error creating table: " . $conn->error;
	}
	$sql = "CREATE TABLE IF NOT EXISTS EMPLOYEE (
			SIN INT PRIMARY KEY,
			Name VARCHAR(30) NOT NULL,
			Desired_Hours INT NOT NULL,
			Wage INT NOT NULL,
			Room_Number INT NOT NULL,
			Computer_Free BIT
			)";
		
	if ($conn->query($sql) === TRUE) 
	{
		//echo nl2br("Table Employee created successfully\n");
	} 
	else 
	{
		//echo "Error creating table: " . $conn->error;
	}
		
$conn->close();
?>
		
	</body>
	
</html>