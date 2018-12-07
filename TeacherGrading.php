<?php
session_start();

		$servername = "localhost";
		$username = "admin";
		$password = "password";
	
		$dbName = "TutorScheduleDB";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbName);
		// Check connection
		if ($conn->connect_error) 
		{
		die("Connection failed: " . $conn->connect_error);
		} 

?>	

<html>
	<head>
		<title>Teacher Grading</title>
		
		<link rel="stylesheet" href="css/style.css"> <!-- Schedule style -->
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
		<script src="js/Bootswatch/jquery-3.0.0.min.js"></script>
		<script src="js/Bootswatch/bootstrap.js" type="text/javascript"></script>
		
		<style>
			
			.jumbotron {
				width:35%;
				height:60%;
				position: absolute;
				top: 16%;
				left: 55%;
				font-size: 150%;
				text-align:center;
			}
			
			.form-group {
				resize:none;
				width:40%;
				position: absolute;
				top: 11%;
				left: 5%;
				font-size:150%;
			}
			
			body{
				font-size:150%;
			}
	
			
		</style>
	</head>
	
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="teacherGUI.php" style="font-size:125%">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="TeacherGrading.php" style="font-size:125%">Grading</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="TeacherAvailability.php" style="font-size:125%">Availability</a>
			</li>
		</ul>
		
		<form action= "index.php">
			<button class="btn btn-secondary my-2 my-sm-0" type="submit" style="font-size:90%">Logout</button>
		</form>
		
	</div>
	</nav>
	
	<div class="form-group">
      <label for="studentInfo">Student Information</label>
      <textarea readonly class="form-control" id="studentInfo" rows="45" style="resize:none"></textarea>
    </div>
	
	<div class="jumbotron">
		
		<h1 align="center" style="padding:8px;font-size:125%;font-weight:550">Manage Grades</h1>
		<div class="btn-group btn-group-toggle" data-toggle="buttons">
			<label class="btn btn-primary active">
				<input type="radio" name="options" id="option1" autocomplete="off" checked=""> Add
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="options" id="option2" autocomplete="off"> Remove
			</label>
			<label class="btn btn-primary">
				<input type="radio" name="options" id="option3" autocomplete="off"> Modify
			</label>
		</div>
		<br></br>
		<div class="InputBox">
		<div class="studentSelectBar">
			<label for="studentSelect" style="padding:10px">Student Name</label>
			<select class="form-control" id="studentSelect" style="height:45px;font-size:70%">
			<optgroup>	
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</optgroup>
			</select>
		</div>
		
		<div class="inputGrade">
			<label class="control-label" style="padding:10px;">Student Grade</label>
			<div class="inputgroup">
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="gradeValue"  style="height:45px;width:50%;font-size:70%">
				<div class="input-group-append">
				<span class="input-group-text">%</span>
				</div>
				</div>
			</div>
		</div>
		<br></br>
		<button type="button" class="btn btn-primary" style="width:125px;height:50px;font-size:50%;margin:auto">Submit</button>
		</div>
			
	</div>
	</body>
</html>
