<?php
//based on https://www.w3schools.com/php/php_mysql_create.asp

	$servername = "localhost";
	$username = "admin";
	$password = "password";
	
	$dbName = "TutorScheduleDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

//*************************************************************************
// Create Databse
//*************************************************************************
	$sql = "CREATE DATABASE IF NOT EXISTS TutorScheduleDB";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}

	$conn = new mysqli($servername, $username, $password, $dbName);
	
	
//*************************************************************************
// Create Tables
//*************************************************************************

	// Create USER table
	$sql = "CREATE TABLE IF NOT EXISTS USER (
			SIN INT,
			Name VARCHAR(30),
			Is_employee BIT,
			PRIMARY KEY (SIN, Is_employee)
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	// Create PROGRAM table
	$sql = "CREATE TABLE IF NOT EXISTS PROGRAM (
		ID INT,
		Subject VARCHAR(20),
		Grade_level INT,
		PRIMARY KEY(ID, Subject)
		)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}

	// Create EMPLOYEE table
	$sql = "CREATE TABLE IF NOT EXISTS EMPLOYEE (
			SIN INT PRIMARY KEY,
			Desired_Hours INT NOT NULL,
			Room_Number INT NOT NULL,
			FOREIGN KEY (SIN) 
			REFERENCES USER(SIN)
			ON DELETE CASCADE
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}

	// Create AVAILABILITY table
	$sql = "CREATE TABLE IF NOT EXISTS AVAILABILITY (
			Employee_ID INT,
			Day INT(3),
			Hour DOUBLE,
			PRIMARY KEY (Employee_ID, Day, Hour),
			CHECK (Day > 0 AND Day <= 7),
			CHECK (Hour <= 18.5 AND Hour >= 8),
			CHECK (Day > 0 AND Day <= 5),
			FOREIGN KEY (Employee_ID) 
			REFERENCES EMPLOYEE(SIN)
			ON DELETE CASCADE
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	// Create PARENT table
	$sql = "CREATE TABLE IF NOT EXISTS PARENT (
			SIN INT PRIMARY KEY,
			Phone_Number VARCHAR(13),
			Email VARCHAR(25),
			FOREIGN KEY (SIN) 
			REFERENCES USER(SIN)
			ON DELETE CASCADE
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}

	// Create STUDENT table
	$sql = "CREATE TABLE IF NOT EXISTS STUDENT (
			SIN INT PRIMARY KEY,
			Age INT NOT NULL,
			Grade INT,
			Behaviour VARCHAR(30),
			Parent_SIN INT,
			FOREIGN KEY (SIN) 
			REFERENCES USER(SIN)
			ON DELETE CASCADE,
			FOREIGN KEY (Parent_SIN) 
			REFERENCES PARENT(SIN)
			ON DELETE SET NULL
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}

	// Create STUDENT_TAUGHT table
	$sql = "CREATE TABLE IF NOT EXISTS STUDENT_TAUGHT (
			Student_ID INT,
			Program_ID INT,
			PRIMARY KEY (Student_ID, Program_ID),
			FOREIGN KEY (Student_ID) 
			REFERENCES STUDENT(SIN)
			ON DELETE CASCADE,
			FOREIGN KEY (Program_ID) 
			REFERENCES PROGRAM(ID)
			ON DELETE CASCADE
			ON UPDATE CASCADE
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	// Create EMPLOYEE_TEACHES table
	$sql = "CREATE TABLE IF NOT EXISTS EMPLOYEE_TEACHES (
			Employee_ID INT,
			Program_ID INT,
			PRIMARY KEY (Employee_ID, Program_ID),
			FOREIGN KEY (Employee_ID) 
			REFERENCES EMPLOYEE(SIN)
			ON DELETE CASCADE,
			FOREIGN KEY (Program_ID) 
			REFERENCES PROGRAM(ID)
			ON DELETE CASCADE
			ON UPDATE CASCADE
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}	
	
	// Create LOGIN table
	$sql = "CREATE TABLE IF NOT EXISTS LOGIN (
			Username VARCHAR(8) PRIMARY KEY,
			Password VARCHAR(8) NOT NULL,
			User_SIN INT NOT NULL,
			FOREIGN KEY (User_SIN) 
			REFERENCES USER(SIN)
			ON DELETE CASCADE
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	// Create FEE table
	$sql = "CREATE TABLE IF NOT EXISTS FEE (
			Client_ID INT,
			Date_Due DATE,
			Balance DOUBLE,
			PRIMARY KEY (Client_ID, Date_Due),
			FOREIGN KEY (Client_ID)
			REFERENCES STUDENT(SIN)
			ON DELETE NO ACTION
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	// Create BOOKED_SESSION table
	$sql = "CREATE TABLE IF NOT EXISTS BOOKED_SESSION (
			Teacher_ID INT,
			Student_ID INT,
			Day INT,
			Hour DOUBLE,
			Program_ID INT,
			PRIMARY KEY (Teacher_ID, Student_ID, Day, Hour),
			CHECK (Day > 0 AND Day <= 7),
			CHECK (Hour <= 18.5 AND Hour >= 8),
			CHECK (Day > 0 AND Day <= 5),
			FOREIGN KEY (Student_ID) 
			REFERENCES STUDENT(SIN)
			ON DELETE CASCADE,
			FOREIGN KEY (Program_ID) 
			REFERENCES PROGRAM(ID)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
			FOREIGN KEY (Teacher_ID) 
			REFERENCES EMPLOYEE(SIN)
			ON DELETE CASCADE
			)";
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
	//Create EVALUATION table 
	$sql = "CREATE TABLE IF NOT EXISTS EVALUATION (
			Student_ID INT,
			Subject VARCHAR(20),
			GRADE DOUBLE,  
			FOREIGN KEY(Student_ID)
			REFERENCES STUDENT(SIN)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
			FOREIGN KEY (Subject)
			REFERENCES PROGRAM (Subject)
			ON DELETE CASCADE
			)";
			
	if (!mysqli_query($conn,$sql))
	{
		die('Error: ' . mysqli_error($conn));
	}
	
		
			
		
$conn->close();

require("DBpopulate.php");

?>