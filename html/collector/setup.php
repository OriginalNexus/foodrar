<?php

	session_start();

	$_SERVER['PHP_AUTH_USER'] = "gigel@gmail.com";

	if (!isset($_SERVER['PHP_AUTH_USER'])) {
	    die('Server error');
	}

	$db_conn = new mysqli('10.81.146.145', 'foodrar', 'alinarazvanx2', 'foodrar');
	if ($db_conn->connect_error) {
		die('Could not connect to database: ' . $db_conn->connect_error);
	}
	$db_conn->set_charset("utf8");

	$stmt = $db_conn->prepare('select * from collector where email = ?');
	$stmt->bind_param("s", $_SERVER['PHP_AUTH_USER']);

	if (!$stmt->execute()) {
		http_response_code(500);
		die('Server error');
	}

	$_SESSION['user'] = $stmt->get_result()->fetch_assoc();

?>
