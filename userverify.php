
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
		
		$Uname = $_POST['passu'];
		$Pword = $_POST['passp'];
		
		$sql = "SELECT L.Username, L.Password, L.User_SIN
			   From login as L
			   Where '$Uname' = L.Username and '$Pword' = L.Password";
			   
		$result = $conn->query($sql);
		
		//based on https://www.w3schools.com/php/php_mysql_select.asp
		
		$sin = null;
		$success = 1;
					
		if ($result->num_rows == 1) 
		{
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
				echo " Username: " . $row["Username"]; echo "&nbsp;";
				echo " Password: " . $row["Password"]; echo "&nbsp;";
				echo " User_SIN: " . $row["User_SIN"]; echo "&nbsp;";
				
				$sin = $row["User_SIN"];
			}
		} 
		
		else 
		{
			echo "0 results";
			$success = 0;
			require("index.php");	
		}
		
	if($success == 1)
	{
		
		$_SESSION["sin1"] = $sin;
		
		$sql2 = "SELECT U.Is_employee
			   From user as U
			   Where '$sin' = U.SIN";
			   
		$result2 = $conn->query($sql2);
		$status = -1;
		
		if ($result2->num_rows == 1) 
		{
			// output data of each row
			while($row2 = $result2->fetch_assoc()) 
			{
				$status = $row2["Is_employee"];
			}
		} 
		else 
		{
			echo "0 results";
		}
		//echo $_SESSION["sin1"];
		
		if($status == 1)
		{
			require("teacherGUI.php");
		}
		if($status == 0)
		{
			require("studentGUI.php");
		}
	}	

	?>
