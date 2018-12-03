
	<?php
		
		$Username = $_POST['username'];
		$Password = $_POST['pass'];
		
		session_start(); //Never forget this line when using $_SESSION
		
		$_SESSION['username'] = $Username;
		$_SESSION['password'] = $Password;
		
		$sql = "SELECT L.Username, L.Password, L.User_SIN
			   From Login as L
			   Where $Username = L.Username and $Password = L.Password";
			   
		$conn->query($sql);

		

		

		
		
		//header('location:index.php');
	?>
