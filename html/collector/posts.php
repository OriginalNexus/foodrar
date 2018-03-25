<?php

require_once('setup.php');

$stmt = $db_conn->prepare('select * from posts where collector_email = ? or status = \'unprocessed\' order by status');
$stmt->bind_param("s", $_SESSION['user']['email']);

if (!$stmt->execute()) {
	http_response_code(500);
	die('Could not fetch posts');
}

$result = $stmt->get_result();

print(json_encode($result->fetch_all(MYSQLI_ASSOC)));

?>
