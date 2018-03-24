<?php

	require_once('setup.php');

	if (!isset($_SESSION['user'])) {
		http_response_code(401);
		die('Not logged in');
	}

	if (empty($_POST['from']) || empty($_POST['to']) || empty($_POST['kg']) || empty($_POST['address'])) {
		http_response_code(400);
		die('Empty from/to/kg/address');
	}

	$email = $_SESSION['user']['email'];
	$status = 'unprocessed';
	$from = $_POST['from'];
	$to = $_POST['to'];
	$kg = $_POST['kg'];
	$address = $_POST['address'];
	$notes = isset($_POST['notes']) ? $_POST['notes'] : "";


	$stmt = $db_conn->prepare('insert into posts (user_email, quantity, location, status, time_lower, time_upper, notes) values (?, ?, ?, ?, ?, ?, ?)');
	$stmt->bind_param("sssssss", $email, $kg, $address, $status, $from, $to, $notes);

	if (!$stmt->execute()) {
		http_response_code(500);
		die('Could not add new post');
	}

	header('Location: ./');

?>
