<html>
	<head>
		<title>Teacher Availability</title>
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
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

/*
//echo "Hope that we find the SIN here: ", $_SESSION["sin1"];

		$currentsin = $_SESSION["sin1"];

		$sql = "SELECT E.Module, E.Grade 
			   From EVALUATION as E
			   Where '$currentsin' = E.Student_ID";
			   
		$result = $conn->query($sql);
*/

?>

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
	
	<!--selection box based on http://form.guide/php-form/php-form-select.html -->
	

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<label for='dayForm[]'>Select the days you wish to add availiability:</label><br>
	<select size= 7 multiple="multiple" name="dayForm[]">
		<option value="Monday">Monday</option>
		<option value="Tuesday">Tuesday</option>
		<option value="Wednesday">Wednesday</option>
		<option value="Thursday">Thursday</option>
		<option value="Friday">Friday</option>
	</select><br>


<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<label for='timeForm[]'>Select the times you wish to add availiability:</label><br>
	<select size= 8 multiple="multiple" name="timeForm[]">
		<option value="8-9">8-9</option>
		<option value="9-10">9-10</option>
		<option value="10-11">10-11</option>
		<option value="12-13">12-13</option>
		<option value="13-14">13-14</option>
		<option value="14-15">14-15</option>

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
			
			echo("<p>You selected $timescount days: ");
			for($i=0; $i < $timescount; $i++)
			{
				echo($times[$i] . " ");
			}
			echo("</p>");
		}
	}
?>

		</body>
</html>
