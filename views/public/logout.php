<?php require_once("../../includes/functions/session.php"); ?>
<?php require_once("../../includes/functions/db_connection.php"); ?>
<?php require_once("../../includes/functions/functions.php"); ?>

<?php
	// v1: simple logout
	// session_start();
	$_SESSION["UserId"] = null;
	$_SESSION["UserName"] = null;
        session_destroy();
	//redirect_to("login.php");
        header("Location: login.php");
?>

<?php
	// v2: destroy session
	// assumes nothing else in session to keep
	// session_start();
	// $_SESSION = array();
	// if (isset($_COOKIE[session_name()])) {
	//   setcookie(session_name(), '', time()-42000, '/');
	// }
	// session_destroy(); 
	// redirect_to("login.php");
?>
