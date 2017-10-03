<?php
	//session_start();
	if(!isset($_SESSION["UserName"])){
		header("Location: ../views/public/login.php");
		exit(); 
	}
?>