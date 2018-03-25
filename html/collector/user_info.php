<?php

	require_once('setup.php');

	$info = $_SESSION['user'];

	unset($info['pass']);

	print(json_encode($info));

?>
