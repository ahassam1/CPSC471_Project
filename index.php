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
	$conn->query($sql);

	$conn = new mysqli($servername, $username, $password, $dbName);
	
	
//*************************************************************************
// Create Tables
//*************************************************************************

	// Create USER table
	$sql = "CREATE TABLE IF NOT EXISTS USER (
			SIN INT PRIMARY KEY,
			Name VARCHAR(30) NOT NULL
			)";
	$conn->query($sql);
	
	// Create PROGRAM table
	$sql = "CREATE TABLE IF NOT EXISTS PROGRAM (
		ID INT PRIMARY KEY,
		Subject VARCHAR(4) NOT NULL,
		Grade_level INT
		)";
	$conn->query($sql);

	// Create EMPLOYEE table
	$sql = "CREATE TABLE IF NOT EXISTS EMPLOYEE (
			SIN INT PRIMARY KEY,
			Desired_Hours INT NOT NULL,
			Wage INT NOT NULL,
			Room_Number INT NOT NULL,
			Computer_Free BIT,
			FOREIGN KEY (SIN) 
			REFERENCES USER(SIN)
			ON DELETE CASCADE
			)";
	$conn->query($sql);

	// Create AVAILABILITY table
	$sql = "CREATE TABLE IF NOT EXISTS AVAILABILITY (
			Employee_ID INT,
			Day BIT(3),
			Hour DOUBLE,
			PRIMARY KEY (Employee_ID, Day, Hour
			CHECK (Day > 0 && Day <= 7),
			CHECK (Hour <= 18.5 && Hour >= 8),
			FOREIGN KEY (Employee_ID) 
			REFERENCES EMPLOYEE(SIN)
			ON DELETE CASCADE
			)";
	$conn->query($sql);
	
	// Create PARENT table
	$sql = "CREATE TABLE IF NOT EXISTS PARENT (
			SIN INT PRIMARY KEY,
			Phone_Number VARCHAR(10),
			Email VARCHAR(8),
			FOREIGN KEY (SIN) 
			REFERENCES USER(SIN)
			ON DELETE CASCADE
			)";
	$conn->query($sql);

	// Create STUDENT table
	$sql = "CREATE TABLE IF NOT EXISTS STUDENT (
			SIN INT PRIMARY KEY,
			Age INT NOT NULL,
			Grade INT,
			Behaviour VARCHAR(1),
			Parent_SIN INT,
			FOREIGN KEY (SIN) 
			REFERENCES USER(SIN)
			ON DELETE CASCADE,
			FOREIGN KEY (Parent_SIN) 
			REFERENCES PARENT(SIN)
			ON DELETE SET NULL
			)";
	$conn->query($sql);

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
	$conn->query($sql);	
	
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
	$conn->query($sql);	
	
	// Create LOGIN table
	$sql = "CREATE TABLE IF NOT EXISTS LOGIN (
			Username INT PRIMARY KEY,
			Password VARCHAR(8) NOT NULL,
			User_SIN INT NOT NULL,
			FOREIGN KEY (User_SIN) 
			REFERENCES USER(SIN)
			ON DELETE CASCADE
			)";
	$conn->query($sql);
	
	// Create FEE table
	$sql = "CREATE TABLE IF NOT EXISTS FEE (
			Client_ID INT,
			Date_Due DATE,
			Balance DOUBLE,
			PRIMARY KEY (Client_ID, Date_Due),
			FOREIGN KEY (Client_ID)
			REFERENCES USER(SIN)
			ON DELETE NO ACTION
			)";
	$conn->query($sql);
	
	// Create STUDENT_SESSION table
	$sql = "CREATE TABLE IF NOT EXISTS STUDENT_SESSION (
			Student_ID INT,
			Day BIT(3),
			Hour DOUBLE,
			Program_ID INT,
			PRIMARY KEY (Student_ID, Day, Hour),
			CHECK (Day > 0 && Day <= 7),
			CHECK (Hour <= 18.5 && Hour >= 8),
			FOREIGN KEY (Student_ID) 
			REFERENCES STUDENT(SIN)
			ON DELETE CASCADE,
			FOREIGN KEY (Program_ID) 
			REFERENCES PROGRAM(ID)
			ON DELETE CASCADE
			ON UPDATE CASCADE
			)";
	$conn->query($sql);
		
$conn->close();
?>