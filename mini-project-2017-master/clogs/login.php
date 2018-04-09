<?php
	
	session_start();
	require_once('db_connect.php');
	require_once('functions.php');

	$username = $pass = null;
	global $user_login;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['username_']))
			$username = clean($link, $_POST['username_']);
		if (isset($_POST['pass_']))
			$pass = clean($link, $_POST['pass_']);

		if (isset($pass) && isset($username)) {
			$q = "SELECT COUNT(*) AS num FROM $user_login WHERE username = '$username' AND pass = '$pass'";
			$exec = mysqli_query($link, $q);
			if ($exec){
				$x = mysqli_fetch_object($exec);
				if ($x->num == 1) {
					// user found
					if (is_email_varified($link, $username)){
						$_SESSION['username_'] = $username;
						$_SESSION['is_logged_in'] = 1;
						echo 1;
					}
					else {
						echo "Please verify your email to login.";
					}
				}
				else{
					echo "Wrong Username or password.";
				}

			}
		}
	}
		
	
	else
		echo "Wrong Method!";

	mysqli_close($link);

?>