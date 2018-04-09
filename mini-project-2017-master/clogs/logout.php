<?php

	session_start();
	
	if(session_destroy())
		header("location: /mini-project-2017/login");
	else{
		$_SESSION['username'] = null;
		$_SESSION["is_logged_in"] = 0;
	}

?>
