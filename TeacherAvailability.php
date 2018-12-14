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
		<title>Teacher Availability</title>
		
		<!-- CSS Schedule Timeline from: https://codepen.io/oltika/pen/GNvdgV  -->
		<link rel="stylesheet" href="css/style.css"> <!-- Schedule style -->
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		
		<!-- CSS Theme from: https://bootswatch.com/  -->
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
		
		<style>
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

	<div class="card text-white bg-info mb-3" style="max-width:30rem;left:32%;top:10%;text-align:center">
		<div class="card-header">Set Availability</div>
		<div class="card-body">
			
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			  <div class="form-group">
					<label for='formDay'>Day</label><br>
					<select class="form-control" name="formDay">
						<option value="1">Monday</option>
						<option value="2">Tuesday</option>
						<option value="3">Wednesday</option>
						<option value="4">Thursday</option>
						<option value="5">Friday</option>
					</select>
					
					<label for='formStart'>Start Time</label><br>
					<select class="form-control" name="formStart">
						<option value="8">8:00AM</option>
						<option value="9">9:00AM</option>
						<option value="10">10:00AM</option>
						<option value="11">11:00AM</option>
						<option value="12.5">12:30PM</option>
						<option value="13.5">1:30PM</option>
						<option value="14.5">2:30PM</option>
						<option value="15.5">3:30PM</option>
					</select>
					
					<label for='formEnd'>End Time</label><br>
					<select class="form-control" name="formEnd">
						<option value="9">9:00AM</option>
						<option value="10">10:00AM</option>
						<option value="11">11:00AM</option>
						<option value="12.5">12:30PM</option>
						<option value="13.5">1:30PM</option>
						<option value="14.5">2:30PM</option>
						<option value="15.5">3:30PM</option>
						<option value="15.5">4:30PM</option>
					</select>
					
					<center>
					<br>
						<input type="submit" class="btn btn-primary" name="formSubmit" value="Set Availability" >
					</center>
					</form>
		</body>
</html>


<?php
//*************************************************************************
// PHP Teacher Availability Functions
//*************************************************************************
	if(isset($_POST['formSubmit'])) 
	{
		$day = $_POST['formDay'];
		$start = $_POST['formStart'];
		$end = $_POST['formEnd'];

		
		if($start >= $end){
			echo  '<div class="card text-white bg-danger mb-3" style="margin-top:15px">
				   <strong>Start Time Must Be Before Closing</strong>
				   </div>';
		}
		else{
			addAvailability($currentsin, $day, $start, $end);
			echo  '<div class="card text-white bg-success mb-3" style="margin-top:15px">
				   <strong>Availability Submitted</strong>
				   </div>';
		}
	}
	
	function addAvailability($emp_id, $day, $start_time, $end_time)
	{
		global $conn;
		
		$sql = "DELETE FROM AVAILABILITY
				WHERE Employee_ID = '" .  $emp_id. "' AND Day = '" . $day. "'";
		$conn->query($sql);
		
		$current_hour = $start_time;
		while($current_hour < 12 && $current_hour < $end_time){
			$sql = "INSERT IGNORE INTO AVAILABILITY (Employee_ID, Day, Hour) 
					VALUES ('". $emp_id."','". $day. "',". $current_hour.")";
			if (!mysqli_query($conn,$sql))
			{
				die('Error: ' . mysqli_error($conn));
			}
			$current_hour++;
		}
		
		$current_hour += 0.5;
		while($current_hour < $end_time){
			$sql = "INSERT IGNORE INTO AVAILABILITY (Employee_ID, Day, Hour) 
					VALUES ('". $emp_id."','". $day. "',". $current_hour.")";
			if (!mysqli_query($conn,$sql))
			{
				die('Error: ' . mysqli_error($conn));
			}
			$current_hour++;
		}
	}
?>


