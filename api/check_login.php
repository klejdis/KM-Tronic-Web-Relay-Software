<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {

	if ( time() - $_SESSION['user'] > 1800 ) {
		// last request was more than 30 minutes ago
		session_unset($_SESSION['user']);      
		session_destroy($_SESSION['user']);   
	} 

    header('Location:login.php');

}


?>







