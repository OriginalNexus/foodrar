<?php
	
	require_once("PHPMailer/PHPMailerAutoLoad.php");
	
	$mail = new PHPMailer();
	$mail->SMTPDebug = 2;
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = 'tls://smtp.gmail.com:587';
	$mail->Port = "587";
	$mail->isHTML();
	$mail->Username = "viand.foodrar@gmail.com";
	$mail->Password = "foodrar123";
	$mail->SetFrom("no-reply@viand.org");
	$mail->Subject = "Collector is coming";
	$mail->Body = "Your request is being processed.
	The collector is on the way.";
	$mail->AddAddress("alina.valentina98@gmail.com");
	if($mail->Send()) echo "Sent.";
	else $mail->ErrorInfo;
	
?>