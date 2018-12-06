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
		
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
		
		<style>
			
			.jumbotron {
				width:40%;
				height:60%;
				position: absolute;
				top: 16%;
				left: 50%;
				font-size: 150%;
				text-align:center;
			}
			
			.jumbotron .ButtonGroup {
				margin: 20px;
			}
			
			.jumbotron .InputBox {
				margin: 20px;
			}
			
			.jumbotron .InputBox .studentSelectBar{
				margin: 20px;
			}
			
			.jumbotron .InputBox .inputGrade{
				margin: 20px;
			}
			
			.form-group {
				resize:none;
				width:40%;
				position: absolute;
				top: 11%;
				left: 5%;
				font-size: 150%;
			}

			
		</style>
	</head>
	
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="teacherGUI.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="TeacherGrading.php">Grading</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="TeacherAvailability.php">Availability</a>
			</li>
		</ul>
		
		<form action= "index.php">
			<button class="btn btn-secondary my-2 my-sm-0" type="submit">Logout</button>
		</form>
		
	</div>
	</nav>
	
	<div class="form-group">
      <label for="studentInfo">Student Information</label>
      <textarea readonly class="form-control" id="studentInfo" rows="45" style="resize:none"></textarea>
    </div>
	
	<div class="jumbotron">
		
		<h1 align="center">Manage Grades</h1>
		<div class="btn-group btn-group-toggle" id="ButtonGroup" data-toggle="buttons">
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
			<label for="studentSelect">Student Name</label>
			<select class="form-control" id="studentSelect">
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
			<label class="control-label">Student Grade</label>
			<div class="inputgroup">
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="gradeValue" aria-label="Grade Value">
				<div class="input-group-append">
				<span class="input-group-text">%</span>
				</div>
				</div>
			</div>
		</div>
		<br></br>
		<button type="button" class="btn btn-primary">Submit</button>
		</div>
			
	</div>
	</body>
</html>
