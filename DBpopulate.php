<?php

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
		$sql = "INSERT IGNORE INTO USER (SIN, Name, Is_employee) 
				VALUES ('". $user_sin[$i]."','". $user_names[$i]. "','". $user_type."')";
		if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
	}
	
	// Populate PROGRAM table
	$prog_names = array("Reading", "Writing", "Math", "Comprehension");
							
	for($i = 0; $i < 4; $i++){ 
		$sql = "INSERT IGNORE INTO PROGRAM (ID, Subject, Grade_level) 
				VALUES ('". $i."','". $prog_names[$i]. "', NULL)";
		if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
	}

	// Populate EMPLOYEE table
	$hours = array(16, 40, 10, 40, 40, 30, 20, 40);
							
	for($i = 0; $i < 8; $i++){ 
	$current_sin = 200000000 + $i;
		$sql = "INSERT IGNORE INTO EMPLOYEE (SIN, Desired_Hours, Room_Number) 
				VALUES ('" . $current_sin."','". $hours[$i]. "','". $i."')";
		if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
	}

	// Populate AVAILABILITY table
	function addAvailability($emp_id, $day, $start_time, $end_time){
		global $conn;
		
		
		$sql = "DELETE FROM AVAILABILITY
				WHERE Employee_ID = '" .  $emp_id. "' AND Day = '" . $day. "'";
		$conn->query($sql);
		
		$current_hour = $start_time;
		while($current_hour < 12 && $current_hour < $end_time){
			$sql = "INSERT IGNORE INTO AVAILABILITY (Employee_ID, Day, Hour) 
					VALUES ('". $emp_id."','". $day. "',". $current_hour.")";
			if (!mysqli_query($conn,$sql))
			{
				die('Error: ' . mysqli_error($conn));
			}
			$current_hour++;
		}
		
		$current_hour += 0.5;
		while($current_hour < $end_time){
			$sql = "INSERT IGNORE INTO AVAILABILITY (Employee_ID, Day, Hour) 
					VALUES ('". $emp_id."','". $day. "',". $current_hour.")";
			if (!mysqli_query($conn,$sql))
			{
				die('Error: ' . mysqli_error($conn));
			}
			$current_hour++;
		}
	}
	addAvailability(200000000, 1, 8, 12);
	addAvailability(200000000, 5, 8, 16.5);
	addAvailability(200000000, 1, 8, 9);
	
	addAvailability(200000001, 1, 10, 16.5);
	addAvailability(200000001, 2, 10, 16.5);
	addAvailability(200000001, 3, 10, 16.5);
	addAvailability(200000001, 4, 10, 16.5);
	addAvailability(200000001, 5, 10, 16.5);
	
	addAvailability(200000002, 3, 8, 12.5);
	addAvailability(200000002, 4, 13.5, 16.5);
	
	addAvailability(200000003, 1, 8, 16.5);
	addAvailability(200000003, 2, 8, 16.5);
	addAvailability(200000003, 3, 8, 16.5);
	addAvailability(200000003, 4, 8, 16.5);
	addAvailability(200000003, 5, 8, 16.5);
	
	addAvailability(200000004, 1, 8, 16.5);
	addAvailability(200000004, 2, 8, 16.5);
	addAvailability(200000004, 3, 8, 16.5);
	addAvailability(200000004, 4, 8, 16.5);
	addAvailability(200000004, 5, 8, 16.5);
	
	addAvailability(200000005, 1, 10, 16.5);
	addAvailability(200000005, 2, 8, 16.5);
	addAvailability(200000005, 3, 8, 16.5);
	addAvailability(200000005, 4, 8, 14.5);
	
	addAvailability(200000005, 2, 8, 12.5);
	addAvailability(200000005, 3, 8, 16.5);
	addAvailability(200000005, 4, 8, 16.5);
	addAvailability(200000005, 5, 8, 12.5);	
	
	// Populate PARENT table
	$email = array("Grace@gmail.com", "Richard_r@yahoo.ca", "adam_ondra_idol@gmail.com", 
					"alex_hon@climber.org", "F.Khan@yahoo.com");						
	$phone = array("(403)456-6789", null, null, null, "(587)321-0987");
	for($i = 0; $i < 5; $i++){ 
	$current_sin = 100000000 + $i;
		$sql = "INSERT IGNORE INTO PARENT (SIN, Phone_Number, Email) 
				VALUES ('" . $current_sin."','". $phone[$i]. "','". $email[$i]."')";
		if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
	}

	// Populate STUDENT table
	$student_ages = array(10, 16, 8, 19, 4);
	$student_grades = array(5, 11, 3, 12, null);
	for($i = 0; $i < 4; $i++){ 
	$current_sin = 000000000 + $i;
	$parent_sin = 100000000 + $i;
		$sql = "INSERT IGNORE INTO STUDENT (SIN, Age, Grade, Behaviour, Parent_SIN)
				VALUES ('" . $current_sin."','". $student_ages[$i]."','". $student_grades[$i]."', NULL,'". $parent_sin."')";
		if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
	}
	
	$current_sin = 000000000 + $i;
	$parent_sin = 100000000 + $i;
	$beh = "difficult";
	$sql = "INSERT IGNORE INTO STUDENT (SIN, Age, Grade, Behaviour, Parent_SIN)
				VALUES ('" . $current_sin."','". $student_ages[$i]."','". $student_grades[$i]."','". $beh."','". $parent_sin."')";
	if (!mysqli_query($conn,$sql))
	{
			die('Error: ' . mysqli_error($conn));
	}
	
	// Populate STUDENT_TAUGHT table
	$sql = "INSERT IGNORE INTO STUDENT_TAUGHT (Student_ID, Program_ID) VALUES (0, 0)";
		if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
		
	$sql = "INSERT IGNORE INTO STUDENT_TAUGHT (Student_ID, Program_ID) VALUES (1, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO STUDENT_TAUGHT (Student_ID, Program_ID) VALUES (1, 3)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	$sql = "INSERT IGNORE INTO STUDENT_TAUGHT (Student_ID, Program_ID) VALUES (2, 2)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	$sql = "INSERT IGNORE INTO STUDENT_TAUGHT (Student_ID, Program_ID) VALUES (3, 1)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	$sql = "INSERT IGNORE INTO STUDENT_TAUGHT (Student_ID, Program_ID) VALUES (4, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO STUDENT_TAUGHT (Student_ID, Program_ID) VALUES (4, 1)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO STUDENT_TAUGHT (Student_ID, Program_ID) VALUES (4, 2)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO STUDENT_TAUGHT (Student_ID, Program_ID) VALUES (4, 3)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	// Populate EMPLOYEE_TEACHES table
		$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000000, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000000, 1)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000000, 3)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000001, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000001, 1)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000001, 2)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000001, 3)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000002, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000003, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000003, 1)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000003, 2)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000003, 3)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000004, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000004, 1)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000004, 2)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000004, 3)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000005, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000005, 1)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000005, 2)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000005, 3)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000006, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000006, 3)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000007, 0)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000007, 1)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000007, 2)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	$sql = "INSERT IGNORE INTO EMPLOYEE_TEACHES (Employee_ID, Program_ID) VALUES (200000007, 3)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
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
		$sql = "INSERT IGNORE INTO LOGIN (Username, Password, User_SIN) 
				VALUES ('". $usernames[$i]."','". $passwords[$i]. "','". $user_sin[$i]."')";
		if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
	}
	
	// Populate FEE table
	
	// Populate BOOKED_SESSION table
	function bookSession($student_id, $day, $hour, $prog_id){
		global $conn;
		
		$sql = "SELECT EMPS.SIN, EMPS.Desired_Hours
				FROM EMPLOYEE EMPS, 
					(SELECT *
					FROM EMPLOYEE E, EMPLOYEE_TEACHES T
					WHERE E.SIN = T.Employee_ID AND T.Program_ID = '" . $prog_id. "'
							AND EXISTS (SELECT * 
										FROM AVAILABILITY A 
										WHERE E.SIN = A.Employee_ID AND A.Day = '" . $day. "' AND A.hour = '" .$hour ."')
							AND NOT EXISTS (SELECT * 
											FROM BOOKED_SESSION B
											WHERE E.SIN = B.Teacher_ID AND B.Day = '" . $day. "' AND B.hour = '" .$hour ."')
							AND NOT EXISTS (SELECT * 
											FROM BOOKED_SESSION B
											WHERE '" . $student_id. "' = B.Student_ID AND B.Day = '" . $day. "' AND B.hour = '" .$hour ."')
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
				VALUES ('" . $selected["SIN"]."','". $student_id."','". $day."','". $hour."','". $prog_id."')";
				if (!mysqli_query($conn,$sql))
				{
					die('Error: ' . mysqli_error($conn));
				}
			
		$sql = "SELECT *
				FROM FEE F 
				WHERE F.Client_ID = '" . $student_id. "'";	
		$result = $conn->query($sql);
		if (mysqli_num_rows($result) > 0){
			$sql = "UPDATE Fee
					SET Balance = Balance + 80
					WHERE Client_ID = '" . $student_id. "'";	
			if (!mysqli_query($conn,$sql)){
				die('Error: ' . mysqli_error($conn));
			}
		}
		else{
			$sql = "INSERT IGNORE INTO FEE (Client_ID, Date_Due, Balance)
					VALUES ('" . $student_id."','2018-12-31', '85')";
			if (!mysqli_query($conn,$sql)){
				die('Error: ' . mysqli_error($conn));
			}
					
		}
		}
	}
	bookSession(0, 1, 11, 0);
	bookSession(0, 2, 9, 2);
	bookSession(0, 2, 14.5, 1);
	bookSession(0, 4, 15, 0);
	bookSession(0, 4, 9, 2);
	
	//Populate EVALUATION table
	$sql = "INSERT IGNORE INTO EVALUATION (Student_ID, Subject, Grade) VALUES (0, 'Algebra', 75.3)";
	if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));
		}
	$sql = "INSERT IGNORE INTO EVALUATION (Student_ID, Subject, Grade) VALUES (0, 'Math', 49.5)";
	if (!mysqli_query($conn,$sql))
		{
			die('Error: ' . mysqli_error($conn));

		}		
		
// $currentsin = 4;
		// $sql = "SELECT P.Subject, P.ID
				// FROM STUDENT_TAUGHT ST, PROGRAM P
				// WHERE ST.Student_ID = '" . $currentsin. "' AND
						// ST.Program_ID = P.ID";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
    // // output data of each row
    // while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["Subject"]. " - Name: " . $row["ID"]. "<br>";
    // }
// } else {
    // echo "0 results";
// }
	
$conn->close();
?>