<?php   
	session_start();
	$_SESSION = array();
	setcookie("PHPSESSID", "", time() - 3600, "/");
	session_destroy();
	header('location: /index.php');
	exit();
?>