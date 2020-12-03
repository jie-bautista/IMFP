<?php  
	$conn=mysqli_connect('localhost', 'root', '', 'lashopee');
	if (!$conn) {
		die("Ccould not connect to database: ".mysqli_connect_error());
	}
?>