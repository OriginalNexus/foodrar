<?php

require_once('setup.php');

require_once('PHPMailer/PHPMailerAutoload.php');

function send_email($email, $subject, $body)
{
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = 'tls://smtp.gmail.com:587';
	$mail->Port = "587";
	$mail->isHTML();
	$mail->Username = "viand.foodrar@gmail.com";
	$mail->Password = "foodrar123";
	$mail->SetFrom("viand.foodrar@gmail.com");
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($email);
	$mail->Send();
}

if (empty($_POST['action']) || !isset($_POST['id'])) {
	http_response_code(400);
	die('Empty action/id');
}

$action = $_POST['action'];
$id = $_POST['id'];

$stmt = $db_conn->prepare('select email from users where email = (select user_email from posts where id = ?)');
$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
	http_response_code(500);
	die('Server error');
}
$email = $stmt->get_result()->fetch_assoc()['email'];

if ($action === 'start') {
	$stmt = $db_conn->prepare('update posts set status = \'in_progress\', collector_email = ? where id = ?');
	$stmt->bind_param("si", $_SESSION['user']['email'], $id);

	if (!$stmt->execute()) {
		http_response_code(500);
		die('Server error');
	}

	send_email($email, 'Collector is on the way', 'Your collector will pick up your waste any time soon.');

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

	send_email($email, 'Waste collected', 'Congratulation! Your collector picked up ' . $quantity . ' kg of waste!');

} else {
		http_response_code(400);
		die('Invalid action');
}


?>
