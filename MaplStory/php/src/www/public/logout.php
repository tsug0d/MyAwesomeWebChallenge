<?php
	ini_set("session.cookie_httponly", 1);
	session_start();
	
	if (!isset($_SESSION['user'])) {
		header("Location: ?page=login.php");
	} else if(isset($_SESSION['user'])!="") {
		header("Location: ?page=home.php");
	}
	
	if (isset($_GET['logout'])) {
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		header("Location: index.php");
		exit;
	}
