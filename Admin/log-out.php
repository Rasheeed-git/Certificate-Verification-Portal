<?php
	include_once('connection/connection_db.php');
	
	session_start();
	session_destroy();
	session_unset();

	header("Location: login.php");
?>

