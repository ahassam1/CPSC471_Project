<html>
	<head>
		<title>Student Grades</title>
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

		$sql = "SELECT E.Subject, E.Grade 
			   From EVALUATION as E
			   Where '$currentsin' = E.Student_ID";
			   
		$result = $conn->query($sql);

?>	

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="studentGUI.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Session</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="Grades.php">View Grades</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="fees.php">Fees</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php">Logout</a>
			</li>
		</ul>
	</div>
	</nav>

<table class="table table-hover">
  <tbody>

    <tr class="table-info">
      <td align="center">Subject</td>
      <td align="center">Grade</td>
    </tr>

  </tbody>
</table> 
		
<?php		
		
	if ($result->num_rows > 0) 
	{
    // output data of each row
		while($row = $result->fetch_assoc()) 
		{
				   echo '<tr style = "text-align:center;">';
                   echo '<td align style = "text-align:center;">' . $row['Subject'] . "                                                         ". "</td>";
                   echo "<td align = center>" . $row['Grade'] . "</td>";
                   echo "</tr>" . "<br>";
		}
	} 
	else 
	{
		echo "0 results";
	}

			   

?>
</body>
</html>