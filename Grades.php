<html>
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

		$sql = "SELECT E.Module, E.Grade 
			   From EVALUATION as E
			   Where '$currentsin' = E.Student_ID";
			   
		$result = $conn->query($sql);

?>	


<h2>Student Grade Table</h2>

<table style="width:100%">
  <tr>
    <th>Firstname</th>
    <th>Lastname</th> 
    <th>Age</th>
  </tr>
  <tr>
    <td>Jill</td>
    <td>Smith</td>
    <td>50</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
  </tr>
  <tr>
    <td>John</td>
    <td>Doe</td>
    <td>80</td>
  </tr>
</table>


		
<?php		
		
	if ($result->num_rows > 0) 
	{
    // output data of each row
		while($row = $result->fetch_assoc()) 
		{
        echo "Module: " . $row["Module"]. " " . "Grade: " . $row["Grade"]. "<br>";
		}
	} 
	else 
	{
		echo "0 results";
	}

			   

?>
</body>
</html>