<?php
	
	require_once('db_connect.php');
	require_once('functions.php');

	$f_name = $l_name = $email = $pass = null;
	// with 'extra' random-ness Mwhahaha!!
	$user_id = $user_prefix."-".rand(1,10000)."-".rand(1,1000);
	$user_hash = md5(rand(1,800));

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['f_name']))
			$f_name = clean($link, $_POST['f_name']);

		if(isset($_POST['l_name']))
			$l_name = clean($link, $_POST['l_name']);

		if(isset($_POST['email']))
			$email = clean($link, $_POST['email']);

		if(isset($_POST['pass']))
			$pass = clean($link, $_POST['pass']);

		if (isset($f_name) && isset($l_name)
				&& isset($email) && isset($pass)) {

			if (!user_present($link, $email)){
				$q = "INSERT INTO $users_info (id, f_name, l_name, email) VALUES ('$user_id','$f_name','$l_name','$email')";
			
				if (mysqli_query($link, $q)) {
					$q_ = "INSERT INTO $user_login VALUES ('$email', '$pass', '$default_email_sign', '$user_hash')";
					if (mysqli_query($link, $q_)) {
							
							$_SESSION['email'] = $username;
						// registered successfully.. send the email now.. and redirect! 
						
							/*$to      = $e_mail; 
					    $subject = 'Signup | Verification'; 
					    $message = '
					     
					    Thanks for signing up!
					    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
					     
					    ------------------------
					    Username: '.$username.'
					    Password: '.$pass.'
					    ------------------------
					     
					    Please click this link to activate your account:
					    http://realhappiness.org/email-verification.php?email='.$e_mail.'&hash='.$user_hash.'';                          
					    $headers = 'From:noreply@realhappiness.org' . "\r\n"; 
					    mail($to, $subject, $message, $headers);*/

					    echo "666";
						
					}
						
					else{
						if (!drop_user($link, $email))
							echo "Error in storing";
						else
							echo "Please Try Agin!";
					}
				}
				else
					echo $q;
			}
			else
				echo "User already present!";
		}
		else
			echo "Isset failed";
	}
	else
		echo "Wrong Method!";

	mysqli_close($link);
?>