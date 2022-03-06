<?php
	$dbServer = "localhost";
	$dbUser = "root";
	$dbPassword = "";
	$dbName = "inventory_manager";

	$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);

	if (!$conn) {
		die("Database connection failed");
	}
?>