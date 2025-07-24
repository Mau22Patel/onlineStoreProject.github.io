<?php
	session_start();
	//Distroy the session
	unset($_SESSION ["email"]); 
	session_destroy(); 
	//Redirect user back to the login page
	header("Location:index.php");
   	exit;

?>
