<!-- IT15018960 - D.U. Liyanage -->
<!-- CSRF Protection with Synchronizer Token Pattern -->

<!-- destroy the session and remove stored cookies -->

<?php
	//destroy the session
	session_start();
	session_unset(); 
	session_destroy();	
	//remove cookies
	unset($_COOKIE['session_cookie']);
	setcookie('session_cookie', '', time() - (86400 * 30), '/');
	
	//forward to index page
	header("Location: index.php");
	
?>