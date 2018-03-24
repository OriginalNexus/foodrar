<?php

	require_once('setup.php');

	if (empty($_POST['email']) || empty($_POST['pass'])) {
		http_response_code(400);
		die("Empty email/password");
	}

	$email = $_POST['email'];
	$pass = $_POST['pass'];

	$stmt = $db_conn->prepare('select * from users where email = ? and pass = ?');
	$stmt->bind_param("ss", $email, $pass);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result && $row = $result->fetch_array()) {
		$_SESSION['user'] = $row;
	} else {
		http_response_code(401);
		die("Invalid email/password");
	}

	header("Location: /");

?>
