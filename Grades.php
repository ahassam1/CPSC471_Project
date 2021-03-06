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

	$sql = "SELECT E.Subject, E.Grade 
		   From EVALUATION as E
		   Where '$currentsin' = E.Student_ID";
			   
	$result = $conn->query($sql);
?>

<html>
	<head> <!-- --------------------------------HEAD----------------------------------- -->
		<title>Student Grades</title>
		
		<!-- CSS Schedule Timeline from: https://codepen.io/oltika/pen/GNvdgV  -->
		<link rel="stylesheet" href="css/style.css"> <!-- Schedule style -->
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		
		<!-- CSS Theme from: https://bootswatch.com/  -->
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
		
		<style>
			body {
				font-size:150%;
			}
			
			tr:nth-child(even) {
				background-color: #f2f2f2;
			}
		</style>
	</head>

	<body> <!-- --------------------------------BODY----------------------------------- -->
	
	<!-- Navigation Bar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="collapse navbar-collapse" id="navbarColor01">
		
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="studentGUI.php" style="font-size:125%">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="studentSession.php" style="font-size:125%">Session</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="Grades.php" style="font-size:125%">View Grades</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="fees.php" style="font-size:125%">Fees</a>
			</li>
		</ul>
		
		<form action= "index.php">
			<button class="btn btn-secondary my-2 my-sm-0" type="submit" style="font-size:90%">Logout</button>
		</form>
		
	</div>
	</nav>
	
	<!-- Grades Table -->
	<table class="table table-hover" style="width:70%;margin-left:15%">
	<tbody>
		<tr class="table-info">
			<td align="center">Subject</td>
			<td align="center">Grade</td>
		</tr>
	
	<?php		
		if ($result->num_rows > 0) 
		{
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
				   echo '<tr>';
                   echo '<td align style = "text-align:center">' . $row['Subject'] .'</td>';
                   echo "<td align = center>" . $row['Grade'] . "</td>";
                   echo "</tr>" . "<br></br>";
			}
		} 
		else 
		{
			return;
		}
	?>
	
	</tbody>
	</table> 
		
	</body>
</html>