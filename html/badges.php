<?php

require_once('setup.php');

if (!isset($_SESSION['user'])) {
	http_response_code(401);
	die('Not logged in');
}

$result = $db_conn->query('select * from badges where is_person = ' . $_SESSION['user']['is_person']);

if (!$result) {
	http_response_code(500);
	die('Could not fetch badges');
}

print(json_encode($result->fetch_all(MYSQLI_ASSOC)));

?>
