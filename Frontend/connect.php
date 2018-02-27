<?php
	// include("connect.php");
	$link=new mysqli("localhost","iot","salasana","iot");
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>
