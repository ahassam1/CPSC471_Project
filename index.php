
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
    echo "TutorScheduleDB created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn = new mysqli($servername, $username, $password, "TutorScheduleDB");

//how to use foreign keys https://stackoverflow.com/questions/22211452/getting-syntax-error-when-declaring-foreign-keys-in-mysql-using-innodb

$sql = "CREATE TABLE IF NOT EXISTS CLIENT (
		SIN INT(9) PRIMARY KEY,
		Name VARCHAR(30) NOT NULL
		)";
	if ($conn->query($sql) === TRUE) 
	{
<<<<<<< HEAD
		echo "Table Client created successfully";
>>>>>>> b12ed3711a916e734ca6b568d266caf6c516a261
	} 
	else 
	{
		echo "Error creating table: " . $conn->error;
	}
		
$conn->close();
?>