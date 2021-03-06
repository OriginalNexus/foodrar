<?php

require_once('setup.php');

$stmt = $db_conn->prepare('select posts.*, users.name as user_name, users.telephone as user_telephone, status.display_name as status_display_name from posts
													inner join status on status.name=posts.status
													inner join users on users.email=posts.user_email
													where posts.collector_email = ? or posts.status = \'unprocessed\'
													order by field(posts.status, \'in_progress\', \'unprocessed\', \'complete\')');

$stmt->bind_param("s", $_SESSION['user']['email']);

if (!$stmt->execute()) {
	http_response_code(500);
	die('Could not fetch posts');
}

$result = $stmt->get_result();

print(json_encode($result->fetch_all(MYSQLI_ASSOC)));

?>
