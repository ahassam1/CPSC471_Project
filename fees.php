<html>
	<head>
		<title>Student Fees</title>
		<link rel="stylesheet" href="css/style.css"> <!-- Schedule style -->
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
	</head>

	<style>
		
		body {
			font-size:150%;
		}
		
	</style>
	
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

		$sql = "SELECT F.Date_Due, F.Balance 
			   From Fee as F
			   Where '$currentsin' = F.Client_ID";
			   
		$result = $conn->query($sql);

?>	

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
			<button class="btn btn-secondary my-2 my-sm-0" type="submit" style="font-size:100%">Logout</button>
		</form>
		
	</div>
	</nav>

<?php		
		
	if ($result->num_rows > 0) 
	{
    // output data of each row
		while($row = $result->fetch_assoc()) 
		{
			echo " Date_Due: " . $row["Date_Due"]; echo "&nbsp;";
			echo " Balance: " . $row["Balance"]; echo "&nbsp;";
		}
	} 
	else 
	{
		echo "0 results";
	}

			   

?>
</body>
</html>

