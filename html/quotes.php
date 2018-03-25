<?php

require_once('setup.php');

print(json_encode($db_conn->query('select text from motivational')->fetch_all(MYSQLI_ASSOC)));

?>
