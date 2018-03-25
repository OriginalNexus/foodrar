<?php

require_once('setup.php');

if (!isset($_SESSION['user'])) {
	http_response_code(401);
	die('Not logged in');
}

$result = $db_conn->query('select name, quantity from users where is_person = 0 order by quantity desc');

if (!$result) {
	http_response_code(500);
	die('Could not fetch restaurants');
}

print(json_encode($result->fetch_all(MYSQLI_ASSOC)));

?>
