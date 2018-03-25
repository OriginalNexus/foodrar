<?php

	require_once('setup.php');

	$stmt = $db_conn->prepare('select * from users where email = ?');
	$stmt->bind_param("s", $_SESSION['user']['email']);
	if (!$stmt->execute())
	{
		http_response_code(500);
		die('Unknown error');
	}

	$result = $stmt->get_result();
	$_SESSION['user'] = $result->fetch_assoc();

	$info = $_SESSION['user'];

	unset($info['pass']);

	print(json_encode($info));

?>
