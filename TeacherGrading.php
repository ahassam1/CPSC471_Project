<?php
//*************************************************************************
// Start Session & Connect to MySQL DB
//*************************************************************************
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
		
	$currentsin = $_SESSION["sin1"];
?>	

<html>
	<head> <!-- --------------------------------HEAD----------------------------------- -->
		<title>Teacher Grading</title>
		
		<!-- CSS Schedule Timeline from: https://codepen.io/oltika/pen/GNvdgV  -->
		<link rel="stylesheet" href="css/style.css"> <!-- Schedule style -->
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		
		<!-- CSS Theme from: https://bootswatch.com/  -->
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
		
		<style>
			.jumbotron {
				width:35%;
				height:80%;
				position: absolute;
				top: 19%;
				left: 30%;
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
	
	<body> <!-- --------------------------------BODY----------------------------------- -->

	<!-- Navigation Bar -->
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
	
	<!-- Right Side Input Area -->
	<div class="jumbotron">
		<h1 align="center" style="padding:8px;font-size:125%;font-weight:550">Manage Grades</h1>
		<br></br>
		<div class="InputBox">
		<div class="studentSelectBar">
			<label for="studentSelect" style="padding:10px;font-size:80%">Student Name</label>			
			<form action="TeacherGrading.php" method="post" id = "form1">
			<select name="form-control" id="studentSelect" style="height:45px;width:100%;font-size:70%">
			<?php
			   
			   $sql = "SELECT DISTINCT B.Student_ID, B.Program_ID, U.Name, P.Subject
			   From booked_session as B, user as U, program as P
			   Where '$currentsin' = B.Teacher_ID and B.Student_ID = U.SIN and P.ID = B.Program_ID";
			   
			   $result = $conn->query($sql);
			 
				for($count = 0; $count < $result->num_rows; $count++){
					$row = $result->fetch_assoc();
					echo '<option value="'.$count.'">' . "Student Name: " .$row['Name']. " /Student ID: " . $row['Student_ID'] . " /Subject: " . $row['Subject'] .'</option>';
				}
			?>
			</optgroup>
			</select>

		</div>
		
		<!-- Input Text Area for Grade -->
		<div class="inputGrade">
			<label class="control-label" style="padding:10px;font-size:80%">Student Grade</label>
			<div class="inputgroup">
				<div class="input-group mb-3">
					<input type="text" class="form-control" name ="gradeValue" id="gradeValue"  style="height:45px;width:50%;font-size:70%">
				<div class="input-group-append">
				<span class="input-group-text">%</span>
				</div>
				</div>
			</div>
		</div>
		</div>
			<input type="submit" class="btn btn-primary" name="submit" value="Submit Grade" style="margin-top:20px">
		</form>

	</div>
	
	
	<?php
	
	if(isset($_POST['submit'])){
		
		
		$sql = "SELECT DISTINCT B.Student_ID, B.Program_ID, U.Name, P.Subject
			   From booked_session as B, user as U, program as P
			   Where '$currentsin' = B.Teacher_ID and B.Student_ID = U.SIN and P.ID = B.Program_ID";
			   
		$result = $conn->query($sql);
		
	$indexofinfo = $_POST['form-control'];  // get the index that was selected
	$grade = $_POST['gradeValue']; // get the grade entered 
	//echo $indexofinfo;
	for($count = 0; $count < $result->num_rows; $count++)
	{
		$row = $result->fetch_assoc();
		if($count == $indexofinfo)
		{
			//echo "Made it in there";
			$ID = $row['Student_ID'];
			$Subject = $row['Subject'];
			
			$sql = "DELETE FROM EVALUATION WHERE Student_ID = '" . $ID. "' 
					AND Subject = '" . $Subject. "'";
			if (!mysqli_query($conn,$sql))
			{
				die('Error: ' . mysqli_error($conn));
			}
			
			$sql = "INSERT IGNORE INTO EVALUATION (Student_ID, Subject, Grade) VALUES ('$ID', '$Subject', '$grade')";
			if (!mysqli_query($conn,$sql))
			{
				die('Error: ' . mysqli_error($conn));
			}
		}		
		
	}
	}
	?>
	
	<!-- JavaScript Resources -->
	<script src="js/Bootswatch/jquery-3.0.0.min.js"></script>
	<script src="js/Bootswatch/bootstrap.js" type="text/javascript"></script>
	
	</body>
</html>
