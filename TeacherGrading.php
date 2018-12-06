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
		<script type="text/javascript" src="js/bootstrap.js"></script>
		
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
			
			.form-group {
				width:40%;
				position: absolute;
				top: 11%;
				left: 5%;
				font-size: 150%;
			}
			
			.inputGrade {
				margin:10px;

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
	</div>
	</nav>
	
	<div class="form-group">
	  <label for="studentList">Student List</label>
      <select multiple="none" class="form-control" id="studentList" size="32">
        <option>Insert</option>
        <option>Some</option>
        <option>Students</option>
        <option>In</option>
        <option>Here</option>
      </select>
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
		<div class="Input Box">
		<div class="studentSelectBar">
			<label for="studentSelect">Student Name</label>
			<select class="form-control" id="studentSelect">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
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
