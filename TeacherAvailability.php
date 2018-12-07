<html>
	<head>
		<title>Teacher Availability</title>
		<link rel="stylesheet" href="css/style.css"> <!-- Schedule style -->
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
		
		<style>
			
			body{
				font-size:150%;
			}
			
		</style>
		
	</head>

<body>
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

		$currentsin = $_SESSION["sin1"];

?>

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
	
	<!--selection box based on http://form.guide/php-form/php-form-select.html -->
	

    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<label for='dayForm[]'>Select the days you wish to add availiability:</label><br>
	<select size= 7 multiple="multiple" name="dayForm[]">
		<option value="1">Monday</option>
		<option value="2">Tuesday</option>
		<option value="3">Wednesday</option>
		<option value="4">Thursday</option>
		<option value="5">Friday</option>
	</select><br>


    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<label for='timeForm[]'>Select the times you wish to add availiability:</label><br>
	<select size= 9 multiple="multiple" name="timeForm[]">
		<option value="8">8:00-9:00</option>
		<option value="9">9:00-10:00</option>
		<option value="10">10:00-11:00</option>
		<option value="11">11:00-12:00</option>
		<option value="12.5">12:30-1:30</option>
		<option value="13.5">1:30-2:30</option>
		<option value="14.5">2:30-3:30</option>
		<option value="15.5">3:30-4:30</option>


	</select><br>
	<input type="submit" name="formSubmit" value="Submit" >
</form>
<?php
	if(isset($_POST['formSubmit'])) 
	{
		$days = $_POST['dayForm'];
		$times = $_POST['timeForm'];

		
		if(!isset($days)) 
		{
			echo("<p>You didn't select any days!</p>\n");
		} 
		else 
		{
			$daycount = count($days);
			
			echo("<p>You selected $daycount days: ");
			for($i=0; $i < $daycount; $i++)
			{
				echo($days[$i] . " ");
			}
			echo("</p>");
		}
		
		if(!isset($times)) 
		{
			echo("<p>You didn't select any times!</p>\n");
		} 
		else 
		{
			$timescount = count($times);
			
			echo("<p>You selected $timescount times: ");
			for($i=0; $i < $timescount; $i++)
			{
				echo($times[$i] . " ");
			}
			echo("</p>");
		}
		echo "Ready to insert into SQL table <br>";

		for($i = 0; $i < $daycount; $i++)
		{
			for($j = 0; $j < $timescount; $j++)
			{
				addAvailability($currentsin, $days[$i], $times[$j], ($times[$j] + 1));
			}
		}
	}
	
	// Populate AVAILABILITY table
	function addAvailability($emp_id, $day, $start_time, $end_time)
	{
		global $conn;
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

		</body>
</html>
