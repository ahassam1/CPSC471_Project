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
		$_SESSION['start'] = "08:00"; 	switch($time){
		$_SESSION['end']   = "09:30"; 	case "8":
		break;                        		$_SESSION['start'] = "08:00";
	case "8.5"=                           		$_SESSION['end']   = "09:00";
		$_SESSION['start'] = "8:30";  		break;
		$_SESSION['end']   = "10:00"; 	case "9":
		break;                        		$_SESSION['start'] = "09:00";
	case "9":                             		$_SESSION['end']   = "10:00";
		$_SESSION['start'] = "09:00"; 		break;
		$_SESSION['end']   = "10:30"; 	case "10":
		break;                        		$_SESSION['start'] = "10:00";
	case "9.5"=                           		$_SESSION['end']   = "11:00";
		$_SESSION['start'] = "9:30";  		break;
		$_SESSION['end']   = "11:00"; 	case "11":
		break;	                		$_SESSION['start'] = "11:00";
	case "10":                            		$_SESSION['end']   = "12:00";
		$_SESSION['start'] = "10:00"; 		break;
		$_SESSION['end']   = "11:30"; 	case "12.5":
		break;                        		$_SESSION['start'] = "12:30";
	case "10.5"=                          		$_SESSION['end']   = "13:30";
		$_SESSION['start'] = "10:30"; 		break;
		$_SESSION['end']   = "12:00"; 	case "13.5":
		break;                        		$_SESSION['start'] = "13:30";
	case "11":                            		$_SESSION['end']   = "14:30";
		$_SESSION['start'] = "11:00"; 		break;
		$_SESSION['end']   = "12:30"; 	case "14.5":
		break;                        		$_SESSION['start'] = "14:30";
	case "11.5":                          		$_SESSION['end']   = "15:30";
		$_SESSION['start'] = "11:30"; 		break;
		$_SESSION['end']   = "13:00"; 	case "15.5":
		break;                        		$_SESSION['start'] = "15:30";
	case "12":                            		$_SESSION['end']   = "16:30";
		$_SESSION['start'] = "12:00"; 		break;
		$_SESSION['end']   = "13:30"; 	case "16.5":
		break;                        		$_SESSION['start'] = "16:30";
	case "12.5":                          		$_SESSION['end']   = "17:30";
		$_SESSION['start'] = "12:30"; 		break;
		$_SESSION['end']   = "14:00"; 	default:
		break;                        		break;
	case "13":                            	}
		$_SESSION['start'] = "13:00"; 	return;
		$_SESSION['end']   = "14:30"; }
		break;
	case "13.5":                          function createTableElement($day){
		$_SESSION['start'] = "13:30"; 	
		$_SESSION['end']   = "15:00"; 	$servername = "localhost";
		break;                        	$username = "admin";
	case "14":                            	$password = "password";
		$_SESSION['start'] = "14:00"; 	
		$_SESSION['end']   = "15:30"; 	$dbName = "TutorScheduleDB";
		break;
	case "14.5":                          	// Create connection
		$_SESSION['start'] = "14:30"; 	$conn = new mysqli($servername, $username, $password, $dbName);
		$_SESSION['end']   = "16:00"; 	// Check connection
		break;                        	if ($conn->connect_error) 
	case "15":                            	{
		$_SESSION['start'] = "15:00"; 		die("Connection failed: " . $conn->connect_error);
		$_SESSION['end']   = "16:30"; 	} 
		break;                        	
	case "15.5":                          	$userSin = $_SESSION['sin1'];
		$_SESSION['start'] = "15:30"; 	
		$_SESSION['end']   = "17:00"; 	$sql = "SELECT *
		break;                        			FROM booked_session B, program P, Employee T
	case "16":                            			WHERE '$userSin' = B.Teacher_ID AND '$day' = B.Day
		$_SESSION['start'] = "16:00"; 			AND B.Program_ID = P.ID
		$_SESSION['end']   = "17:30"; 			ORDER BY B.Hour";
                                              	
	case "16.5":                          	$result = $conn->query($sql);
		$_SESSION['start'] = "16:30"; 	
		$_SESSION['end']   = "18:00"; 	if($result->num_rows != 0){
		
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
