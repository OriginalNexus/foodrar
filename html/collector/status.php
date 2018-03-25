<?php

require_once('setup.php');


if (empty($_POST['action']) || !isset($_POST['id'])) {
	http_response_code(400);
	die('Empty action/id');
}

$action = $_POST['action'];
$id = $_POST['id'];

if ($action === 'start') {
	$stmt = $db_conn->prepare('update posts set status = \'in_progress\', collector_email = ? where id = ?');
	$stmt->bind_param("si", $_SESSION['user']['email'], $id);

	if (!$stmt->execute()) {
		http_response_code(500);
		die('Server error');
	}
} else if ($action === 'confirm') {
	if (!isset($_POST['quantity'])) {
		http_response_code(500);
		die('Empty final quantity');
	}

	$quantity = $_POST['quantity'];

	$stmt = $db_conn->prepare('update posts set status = \'complete\', quantity = ? where id = ?');
	$stmt->bind_param("si", $quantity, $id);

	if (!$stmt->execute()) {
		http_response_code(500);
		die('Server error');
	}

	$stmt = $db_conn->prepare('update users set quantity = quantity + ? where email = (select user_email from posts where id = ?)');
	$stmt->bind_param("si", $quantity, $id);

	if (!$stmt->execute()) {
		http_response_code(500);
		die('Server error');
	}
} else {
		http_response_code(400);
		die('Invalid action');
}


?>
