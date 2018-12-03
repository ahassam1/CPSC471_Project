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
		
$conn->close();
?>