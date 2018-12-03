<?php

if(false){
	$servername = "localhost";
	$username = "admin";
	$password = "password";
	
	$dbName = "TutorScheduleDB";

	$conn = new mysqli($servername, $username, $password, $dbName);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	
//*************************************************************************
// Populate Tables
//*************************************************************************

	// Populate USER table
	$user_names = array("Max", "Penelope", "Layla", "Julian", "Maddie",
						"Grace", "Richard", "Adam", "Alex", "Fatima",
						"Wafo", "Matt", "Al", "Hans", "Eli", "Sam",
						"Abdo", "Kels");
	$user_sin = array(000000000, 000000001, 000000002, 000000003, 000000004,
						100000000, 100000001, 100000002, 100000003, 100000004,
						200000000, 200000001, 200000002, 200000003, 200000004,
						200000005, 200000006, 200000007);
							
	for($i = 0; $i < 18; $i++){
		if($i > 9)$user_type = true;
		else $user_type = false; 
		$sql = "INSERT INTO USER (SIN, Name, Is_employee) VALUES ('". $user_sin[$i]."','". $user_names[$i]. "','". $user_type."')";
		if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
		else echo "record added";

	}
	
	// Populate PROGRAM table

	// Populate EMPLOYEE table

	// Populate AVAILABILITY table
	
	// Populate PARENT table

	// Populate STUDENT table

	// Populate STUDENT_TAUGHT table
	
	// Populate EMPLOYEE_TEACHES table
	
	// Populate LOGIN table
	$usernames = array("Max", "Penelope", "Layla", "Julian", "Maddie",
						"Wafo", "Matt", "Al", "Hans", "Eli", "Sam",
						"Abdo", "Kels");
	$passwords = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10",
						"11", "12");
	$user_sin = array(000000000, 000000001, 000000002, 000000003, 000000004,
						200000000, 200000001, 200000002, 200000003, 200000004,
						200000005, 200000006, 200000007);
						
	for($i = 0; $i < 13; $i++){
		$sql = "INSERT INTO LOGIN (Username, Password, User_SIN) VALUES ('". $usernames[$i]."','". $passwords[$i]. "','". $user_sin[$i]."')";
		if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
		else echo "record added";
	}
	
	// Populate FEE table
	
	// Populate STUDENT_SESSION table

$student_ages = array(10, 16, 8, 19, 4);
$student_grades = array(5, 11, 3, 12, null);

	// Create USER table
	$sql = "CREATE TABLE IF NOT EXISTS USER (
			SIN INT PRIMARY KEY,
			Name VARCHAR(30) NOT NULL
			)";
	$conn->query($sql);
		
$conn->close();
}
?>