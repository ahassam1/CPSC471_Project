
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

$conn->close();
?>