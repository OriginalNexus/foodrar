<?php

	require_once('setup.php');

	if (!isset($_SESSION['user'])) {
		http_response_code('401');
		die('Not logged in');
	}

  $pass = empty($_POST['pass']) ? $_SESSION['user']['pass'] : $_POST['pass'];
  $name = empty($_POST['name']) ? $_SESSION['user']['name'] : $_POST['name'];
  $tel = empty($_POST['tel']) ? $_SESSION['user']['telephone'] : $_POST['tel'];
  $is_person = !isset($_POST['is_person']) ? $_SESSION['user']['is_person'] : $_POST['is_person'];
	$email = $_SESSION['user']['email'];

  $stmt = $db_conn->prepare('update users set name = ?, pass = ?, telephone = ?, is_person = ? where email = ?');
  $stmt->bind_param("sssis", $name, $pass, $tel, $is_person, $email);

  if (!$stmt->execute()) {
    http_response_code(500);
    die('Could not update user');
  }

	$stmt = $db_conn->prepare('select * from users where email = ?');
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result && $row = $result->fetch_assoc()) {
		$_SESSION['user'] = $row;
	}

  header('Location: ./');


?>
