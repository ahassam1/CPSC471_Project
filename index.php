<?php
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
$sql = "CREATE DATABASE TutorScheduleDB";
if ($conn->query($sql) === TRUE) {
    echo "Tutor Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>