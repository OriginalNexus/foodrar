<?php

	require_once('setup.php');

	if (empty($_POST['from']) || empty($_POST['to']) || empty($_POST['kg']) || empty($_POST['address'])) {
		http_response_code(400);
		die('Empty from/to/kg/address');
	}

	$email = ...
	$date = ...
	$status = ...
	$from = $_POST['from'];
	$to = $_POST['to'];
	$kg = $_POST['kg'];
	$address = $_POST['address'];
	$notes = $_POST['notes'];

	// $stmt = $db_conn->prepare('select * from users where email = ?');
	// $stmt->bind_param("s", $email);
	// $stmt->execute();
	// $result = $stmt->get_result();

	// if ($result && $row = $result->fetch_assoc()) {
	// 	http_response_code(400);
	// 	die('Already registered');
	// }

	$stmt2 = $db_conn->prepare('insert into posts (user_email, date, quantity, location, status, time_lower, time_upper, notes) values (?, ?, ?, ?, ?, ?, ?, ?)');
	$stmt2->bind_param("ssssssss", $email, $date, $kg, $address, $status, $from, $to, $notes);

	if (!$stmt2->execute()) {
		http_response_code(500);
		die('Could not add new post');
	}

	$stmt->execute();
	$result = $stmt->get_result();

	if ($result && $row = $result->fetch_assoc()) {
		$_SESSION['user'] = $row;
		unset($_SESSION['user']['pass']);
	}


	header('Location: /');

?>
