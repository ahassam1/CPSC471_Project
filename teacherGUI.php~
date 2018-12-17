<?php
//*************************************************************************
// Start Session
//*************************************************************************
if(session_id() == '' || !isset($_SESSION)){
	session_start();
}

//*************************************************************************
// PHP Schedule Populate Functions
//*************************************************************************
function convertTime($time){
	
	switch($time){
	case "8":
		$_SESSION['start'] = "08:00";
		$_SESSION['end']   = "09:00";
		break;
	case "9":
		$_SESSION['start'] = "09:00";
		$_SESSION['end']   = "10:00";
		break;
	case "10":
		$_SESSION['start'] = "10:00";
		$_SESSION['end']   = "11:00";
		break;
	case "11":
		$_SESSION['start'] = "11:00";
		$_SESSION['end']   = "12:00";
		break;
	case "12.5":
		$_SESSION['start'] = "12:30";
		$_SESSION['end']   = "13:30";
		break;
	case "13.5":
		$_SESSION['start'] = "13:30";
		$_SESSION['end']   = "14:30";
		break;
	case "14.5":
		$_SESSION['start'] = "14:30";
		$_SESSION['end']   = "15:30";
		break;
	case "15.5":
		$_SESSION['start'] = "15:30";
		$_SESSION['end']   = "16:30";
		break;
	case "16.5":
		$_SESSION['start'] = "16:30";
		$_SESSION['end']   = "17:30";
		break;
	default:
		break;
	}
	return;
}

function createTableElement($day){
	
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
	
	$userSin = $_SESSION['sin1'];
	
	$sql = "SELECT *
			FROM booked_session B, program P, Employee T
			WHERE '$userSin' = B.Teacher_ID AND '$day' = B.Day
			AND B.Program_ID = P.ID
			ORDER BY B.Hour";
	
	$result = $conn->query($sql);
	
	if($result->num_rows != 0){
		
		//while($row = $result->fetch_array()){
		for($count = 0; $count < $result->num_rows; $count++){
			$row = $result->fetch_assoc();
			convertTime($row["Hour"]);
			
			echo '<li class="single-event" data-start="'.$_SESSION['start'].'" data-end="'.$_SESSION['end'].'" data-event="event-'.(($count%4)+1).'">
				  <a href="#0">
				  <em class="event-name">'.$row['Subject'].'</em>
				  </a>
				  </li>';
		}
	}
	return;
}
?>

<html lang="en" class="no-js">
	<head> <!-- --------------------------------HEAD----------------------------------- -->
		<title> Teacher Schedule </title>

		<!-- CSS Schedule Timeline from: https://codepen.io/oltika/pen/GNvdgV  -->
		<link rel="stylesheet" href="css/style.css"> <!-- Schedule style -->
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		
		<!-- CSS Theme from: https://bootswatch.com/  -->
		<link rel="stylesheet" href="css/bootstrap-lumen-theme.css">
		
		<style>
			body {
				font-size:150%;
			}
		</style>
	</head>
	
	<body> <!-- --------------------------------BODY----------------------------------- -->
	
	<!-- Navigation Bar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="collapse navbar-collapse" id="navbarColor01">
		
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="teacherGUI.php" style="font-size:125%">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="TeacherGrading.php" style="font-size:125%">Grading</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="TeacherAvailability.php" style="font-size:125%">Availability</a>
			</li>
		</ul>
		
		<form action= "index.php">
			<button class="btn btn-secondary my-2 my-sm-0" type="submit" style="font-size:90%">Logout</button>
		</form>
		
	</div>
	</nav>
	
	<!-- TimeLine -->
	<div class="cd-schedule loading">
	<div class="timeline">
		<ul>
			<li><span>8:00</span></li>
			<li><span>8:30</span></li>
			<li><span>9:00</span></li>
			<li><span>9:30</span></li>
			<li><span>10:00</span></li>
			<li><span>10:30</span></li>
			<li><span>11:00</span></li>
			<li><span>11:30</span></li>
			<li><span>12:00</span></li>
			<li><span>12:30</span></li>
			<li><span>13:00</span></li>
			<li><span>13:30</span></li>
			<li><span>14:00</span></li>
			<li><span>14:30</span></li>
			<li><span>15:00</span></li>
			<li><span>15:30</span></li>
			<li><span>16:00</span></li>
			<li><span>16:30</span></li>
			<li><span>17:00</span></li>
		</ul>
	</div> 
	
	<!-- Schedule Population -->
	<div class="events">
		<ul>
			<li class="events-group">
				<div class="top-info"><span style="font-weight:700">Monday</span></div>
				<ul>
					<?php createTableElement(1); ?>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info"><span style="font-weight:700">Tuesday</span></div>

				<ul>
					<?php createTableElement(2); ?>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info"><span style="font-weight:700">Wednesday</span></div>

				<ul>
					<?php createTableElement(3); ?>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info"><span style="font-weight:700">Thursday</span></div>

				<ul>
						<?php createTableElement(4); ?>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info"><span style="font-weight:700">Friday</span></div>
				<ul>		
						<?php createTableElement(5); ?>					
				</ul>
			</li>
		</ul>
	</div>
	
	<!-- Pop Up Windows -->
	<div class="event-modal">
		<header class="header">
			<div class="content">
				<span class="event-date"></span>
				<h3 class="event-name"></h3>
			</div>

			<div class="header-bg"></div>
		</header>

		<div class="body">
			<div class="event-info"></div>
			<div class="body-bg"></div>
		</div>

		<a href="#0" class="close">Close</a>
	</div>
	<div class="cover-layer"></div>
	</div> 

	<!-- JavaScript Resources -->
	<script src="js/scheduler/modernizr.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script>
	if( !window.jQuery ) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
	</script>
	<script src="js/scheduler/main.js"></script> <!-- Resource jQuery -->
	
	</body>
</html>