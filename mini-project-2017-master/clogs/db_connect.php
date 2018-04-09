<?php

	$server = '127.0.0.1';
	$username = 'root';
	$pass = '';
	$db_name = 'auction_bay';

	$link = mysqli_connect($server, $username, $pass, $db_name);

		if (!$link)
			die(mysqli_error($link));


?>
