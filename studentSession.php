<html>
	<head>
		<title>Student Sessions</title>
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


//echo "Hope that we find the SIN here: ", $_SESSION["sin1"];

		$currentsin = $_SESSION["sin1"];

		// $sql = "SELECT E.Module, E.Grade 
			   // From EVALUATION as E
			   // Where '$currentsin' = E.Student_ID";
			   
		// $result = $conn->query($sql);

?>	

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="studentGUI.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="studentSession.php">Session</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="Grades.php">View Grades</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="fees.php">Fees</a>
			</li>
		</ul>
		
		<form action= "index.php">
			<button class="btn btn-secondary my-2 my-sm-0" type="submit">Logout</button>
		</form>
		
	</div>
	</nav>
	
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
Select Session Day: <br>	  
<select name="formDay">
  <option value="1">Monday</option>
  <option value="2">Tuesday</option>
  <option value="3">Wednesday</option>
  <option value="4">Thursday</option>
  <option value="5">Friday</option>
</select><br><br><br>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
Select Session Time: <br>	  
<select name="formHour">
  <option value="8">8:00AM-9:00AM</option>
  <option value="9">9:00AM-10:00AM</option>
  <option value="10">10:00AM-11:00AM</option>
  <option value="11">11:00AM-12:00PM</option>
  <option value="12.5">12:30PM-1:30PM</option>
  <option value="13.5">1:30PM-2:30PM</option>
  <option value="14.5">2:30PM-3:30PM</option>
  <option value="15.5">3:30PM-4:30PM</option>
</select><br><br><br>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
Select Subject: <br>	  
<select name="formSubject">

<?php
$sql = "SELECT P.Subject, P.ID
		FROM STUDENT_TAUGHT ST, PROGRAM P
		WHERE ST.Student_ID = '" . $currentsin. "' AND
				ST.Program_ID = P.ID";
	$result = $conn->query($sql);
	for($count = 0; $count < $result->num_rows; $count++){
		$row = $result->fetch_assoc();
		echo '<option value="'.$row['ID'].'">'.$row['Subject'].'</option>';
	}
?>
  
</select><br><br><br>
	<input type="submit" name="formSubmit" value="Request" >
</form>

<?php

if(isset($_POST['formSubmit']) )
{
  $day = $_POST['formDay'];
  $hour = $_POST['formHour'];
  $subject = $_POST['formSubject'];
  $errorMessage = "";
}
?>
	
		</body>
</html>
