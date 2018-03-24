<?php

	require_once('setup.php');

	if (empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['name']) || empty($_POST['tel']) || !isset($_POST['is_person'])) {
		http_response_code(400);
		die('Empty name/email/password/telephone');
	}

	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$name = $_POST['name'];
	$tel = $_POST['tel'];
	$is_person = $_POST['is_person'];

	$stmt = $db_conn->prepare('select * from users where email = ?');
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result && $row = $result->fetch_assoc()) {
		http_response_code(400);
		die('Already registered');
	}

	$stmt2 = $db_conn->prepare('insert into users (name, email, pass, telephone, is_person) values (?, ?, ?, ?, ?)');
	$stmt2->bind_param("ssssi", $name, $email, $pass, $tel, $is_person);

	if (!$stmt2->execute()) {
		http_response_code(500);
		die('Could not register user');
	}

	$stmt->execute();
	$result = $stmt->get_result();

	if ($result && $row = $result->fetch_assoc()) {
		$_SESSION['user'] = $row;
	}


	header('Location: ./');

?>
