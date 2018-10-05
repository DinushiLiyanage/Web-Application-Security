<?php
	//reply to the JSON request with the CSRF token saved in the server side
	session_start();
	if(isset($_POST["request"]))
	{
		$data["token"] = $_SESSION['csrf_token'];
		echo json_encode($data);	
	}
?>

