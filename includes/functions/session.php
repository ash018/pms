<?php

	session_start();
        
        function authonticate(){
            if(!isset($_SESSION["UserName"])){
		header("Location: ../public/login.php");
		exit(); 
	}
        }
        
        function manage_admin_access(){
            if(!isset($_SESSION["UserTypeId"])){
		header("Location: ../public/login.php");
		exit(); 
            }
            
            if($_SESSION["UserTypeId"] != 1){
		header("Location: ../public/home.php");
		exit(); 
            }
        }
	
	function message() {
		if (isset($_SESSION["message"])) {
			$output = "<div class=\"message\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
	
?>