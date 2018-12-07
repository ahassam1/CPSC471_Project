<html>
	<head>
		<title>Student Sessions</title>
		<link rel="stylesheet" href="css/style.css"> <!-- Schedule style -->
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
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
	
<form name = "test" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

<section>
    <div>
		<br><br><br><br><br><br><br>
		<center>
		<label for = "formDay">Select Session Day:</label>
		<select name="formDay">
		<option value="1">Monday</option>
		<option value="2">Tuesday</option>
		<option value="3">Wednesday</option>
		<option value="4">Thursday</option>
		<option value="5">Friday</option>
		</select><br><br><br>
	</div>		

	<div>
		<center>
		<label for = "formHour">Select Session Time:</label>
		<select name="formHour">
		<option value="8">8:00AM-9:00AM</option>
		<option value="9">9:00AM-10:00AM</option>
		<option value="10">10:00AM-11:00AM</option>
		<option value="11">11:00AM-12:00PM</option>
		<option value="12.5">12:30PM-1:30PM</option>
		<option value="13.5">1:30PM-2:30PM</option>
		<option value="14.5">2:30PM-3:30PM</option>
		<option value="15.5">3:30PM-4:30PM</option>
		</center>
		</select><br><br><br>
	</div>
	
	<div>
		<center>
		<label for = "formSubject">Select Subject:</label>	  
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
	</div>
	</center>
	</select><br><br><br>
	<center>
	<input type="submit" name="formSubmit" value="Add" >
	<input type="submit" name="formRemove" value="Remove" >
	</center>
	<br>
</form>

<?php

if(isset($_POST['formSubmit']) )
{
	$day = $_POST['formDay'];
	$hour = $_POST['formHour'];
	$subject = $_POST['formSubject'];
	$errorMessage = "";
	
	
	$sql = "	SELECT * 
				FROM BOOKED_SESSION B
				WHERE '" . $currentsin. "' = B.Student_ID AND B.Day = '" . $day. "' AND B.hour = '" .$hour ."'";
			
	$result = $conn->query($sql);
	if (mysqli_num_rows($result) > 0)echo("<p>Unable to book session, scheduling conflict!");
	else{	
		
		$sql = "SELECT EMPS.SIN, EMPS.Desired_Hours
				FROM EMPLOYEE EMPS, 
					(SELECT *
					FROM EMPLOYEE E, EMPLOYEE_TEACHES T
					WHERE E.SIN = T.Employee_ID AND T.Program_ID = '" . $subject. "'
							AND EXISTS (SELECT * 
										FROM AVAILABILITY A 
										WHERE E.SIN = A.Employee_ID AND A.Day = '" . $day. "' AND A.hour = '" .$hour ."')
							AND NOT EXISTS (SELECT * 
											FROM BOOKED_SESSION B
											WHERE E.SIN = B.Teacher_ID AND B.Day = '" . $day. "' AND B.hour = '" .$hour ."')
							AND NOT EXISTS (SELECT * 
											FROM BOOKED_SESSION B
											WHERE '" . $currentsin. "' = B.Student_ID AND B.Day = '" . $day. "' AND B.hour = '" .$hour ."')
					) AS AVAIL_EMPS
				WHERE Emps.SIN = AVAIL_EMPS.Employee_ID
						AND EMPS.Desired_Hours > (	SELECT COUNT(*)
													FROM BOOKED_SESSION B
													WHERE Emps.SIN = B.Teacher_ID
													)
				ORDER BY EMPS.Desired_Hours DESC";
				
		$result = $conn->query($sql);
		if (mysqli_num_rows($result) > 0) {
			$selected = $result->fetch_assoc();
			$sql = "INSERT IGNORE INTO BOOKED_SESSION (Teacher_ID, Student_ID, Day, Hour, Program_ID)
				VALUES ('" . $selected["SIN"]."','". $currentsin."','". $day."','". $hour."','". $subject."')";
				if (!mysqli_query($conn,$sql))
				{
					die('Error: ' . mysqli_error($conn));
				}
				else echo("<p>Session booked!");
				
		$sql = "SELECT *
				FROM FEE F 
				WHERE F.Client_ID = '" . $currentsin. "'";	
		$result = $conn->query($sql);
		if (mysqli_num_rows($result) > 0){
			$sql = "UPDATE Fee
					SET Balance = Balance + 80
					WHERE Client_ID = '" . $currentsin. "'";	
			if (!mysqli_query($conn,$sql)){
				die('Error: ' . mysqli_error($conn));
			}
		}
		else{
			$sql = "INSERT IGNORE INTO FEE (Client_ID, Date_Due, Balance)
					VALUES ('" . $currentsin."','2018-12-31', '85')";
			if (!mysqli_query($conn,$sql)){
				die('Error: ' . mysqli_error($conn));
			}
					
		}
				
		}
		else echo("<p>Unable to book session, no available teachers!");
	}
}

else if(isset($_POST['formRemove']) )
{
	$day = $_POST['formDay'];
	$hour = $_POST['formHour'];	
	
	$sql = "	SELECT * 
				FROM BOOKED_SESSION
				WHERE '" . $currentsin. "' = Student_ID AND Day = '" . $day. "' AND hour = '" .$hour ."'";	
	$result = $conn->query($sql);
	if (mysqli_num_rows($result) <= 0) echo("<p>No session to drop at specified time!");
	
	else{	
		
		$sql = "DELETE FROM BOOKED_SESSION
				WHERE '" . $currentsin. "' = Student_ID AND Day = '" . $day. "' AND hour = '" .$hour ."'";
				
		if ($conn->query($sql) === TRUE) {
			echo "Session deleted successfully";
		} else {
					echo "Error deleting record: " . $conn->error;
				}
	}
}
?>
	
		</body>
</html>
