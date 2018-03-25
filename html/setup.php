<?php

	session_start();

	$db_conn = new mysqli('localhost', 'foodrar', 'alinarazvanx2', 'foodrar');
	if ($db_conn->connect_error) {
		die('Could not connect to database: ' . $db_conn->connect_error);
	}
	$db_conn->set_charset("utf8");

?>
