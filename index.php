
<?php
//based on https://www.w3schools.com/php/php_mysql_create.asp

$servername = "localhost";
$username = "admin";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS TutorScheduleDB";
if ($conn->query($sql) === TRUE) {
    echo nl2br("TutorScheduleDB created successfully\n");
} else {
    echo "Error creating database: " . $conn->error;
}

$conn = new mysqli($servername, $username, $password, "TutorScheduleDB");

//how to use foreign keys https://stackoverflow.com/questions/22211452/getting-syntax-error-when-declaring-foreign-keys-in-mysql-using-innodb

$sql = "CREATE TABLE IF NOT EXISTS CLIENT (
		SIN INT PRIMARY KEY,
		Name VARCHAR(30) NOT NULL
		)";
		
	if ($conn->query($sql) === TRUE) {
		echo nl2br("Table Client created successfully\n");
	} 
	else {
		echo "Error creating table: " . $conn->error;
	}
	
	$sql = "CREATE TABLE IF NOT EXISTS PROGRAM (
		ID INT PRIMARY KEY,
		Subject VARCHAR(30),
		Grade_level INT
		)";
	if ($conn->query($sql) === TRUE) 
	{
		echo nl2br("Table Program created successfully\n\r");
	} 
	else 
	{
		echo "Error creating table: " . $conn->error;
	}
$sql = "CREATE TABLE IF NOT EXISTS EMPLOYEE (
		SIN INT PRIMARY KEY,
		Name VARCHAR(30) NOT NULL,
		Desired_Hours INT NOT NULL,
		Wage INT NOT NULL,
		Room_Number INT NOT NULL,
		Computer_Free BIT
		)";
		
	if ($conn->query($sql) === TRUE) 
	{
		echo nl2br("Table Employee created successfully\n");
	} 
	else 
	{
		echo "Error creating table: " . $conn->error;
	}
		
$conn->close();
?>