
	<?php
			
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
		
		$Uname = $_POST['passu'];
		$Pword = $_POST['passp'];
		
		$sql = "SELECT L.Username, L.Password, L.User_SIN
			   From login as L
			   Where '$Uname' = L.Username and '$Pword' = L.Password";
			   
		$result = $conn->query($sql);
		
		//based on https://www.w3schools.com/php/php_mysql_select.asp
					
		if ($result->num_rows == 1) 
		{
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
				echo "Username: " . $row["Username"]. "Password: " . $row["Password"]. "User_SIN: " . $row["User_SIN"]. "<br>";
				$sin = $row["User_SIN"];
				return $sin;

			}
		} 
		else 
		{
			echo "0 results";
		}
		
		return null;
	
				
		//header('location:index.php');
	?>
