<?php

require_once('setup.php');

if (!isset($_SESSION['user'])) {
	http_response_code(401);
	die('Not logged in');
}

$stmt = $db_conn->prepare('select posts.*, status.display_name as status_display_name from posts inner join status on status.name=posts.status where posts.user_email = ?');
$stmt->bind_param("s", $_SESSION['user']['email']);

if (!$stmt->execute()) {
	http_response_code(500);
	die('Could not fetch posts');
}

$result = $stmt->get_result();

print(json_encode($result->fetch_all(MYSQLI_ASSOC)));

?>
