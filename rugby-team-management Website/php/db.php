<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "simplyrugby";

	// Connect to DB
	$con = mysqli_connect($servername, $username, $password, $dbname);
	
	if(mysqli_connect_errno()){
		echo "Connection to DB error: " . mysqli_connect_errno();
	}
?>

	
