<?php
        //define( 'SCRIPT_ROOT', 'http://localhost:81/pppro/' );
	$link = mysqli_connect("localhost", "root", "", "pppro");	
	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
		
?>