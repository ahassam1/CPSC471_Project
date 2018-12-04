<html>
<!-- ----------------------------HEAD----------------------------------- -->
	<head>
		<title>Login</title>
		<link rel="stylesheet" type= "text/css" href= "css/bootstrap-lumen-theme.css">
		<style>
		
			.username {
				width: 275px;
				border_radius: 5px;
				padding: 10px;
				height: 50px;
				position: absolute;
				margin-top: -100px;
				margin-left: -400px;
				top: 50%;
				left: 68%;
			}
		
			.form-group {
				width: 275px;
				border_radius: 5px;
				padding: 10px;
				height: 50px;
				position: absolute;
				margin-top: -50px;
				margin-left: -400px;
				top: 50%;
				left: 68%;
			}
		
			.enter{
				width: 800px;
				border_radius: 5px;
				padding: 10px;
				height: 50px;
				position: absolute;
				margin-top: -0px;
				margin-left: -300px;
				top: 50%;
				left: 68%;
			}
		
			body {
				background-image: url("img/LoginOverlay.png");
				background-size: cover;
				background-position: left top;
				background-attachment: fixed;
				background-repeat: no-repeat;
			}
		
			h1 {
				color: #158CBA;
				font-family: sans-serif;
				font-size: 100;
				position: absolute;
				margin-top: -0px;
				margin-left: -305px;
				top: 20%;
				left: 60%;
			}
		
		</style>
	</head>
	
<!-- ----------------------------BODY----------------------------------- -->
	<body scroll="vertical" style="overflow: hidden"> 
		
		<?php
			require("DBinit.php");
		?>
		
		<h1>LOGIN</h1>
		
		<form action="userverify.php" method="post">
			<div class= "username">
				<input type="text" class="form-control" placeholder="Username" name="passu"> 
			</div>
			<br></br>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" name="passp">
				
			</div>
			<br></br>
			<div class= "enter">
				<input type="submit" onclick= "verify()" class="btn btn-outline-primary" value="Sign In" id= "Enter">
			</div>	
		</form>
	</body>
</html>