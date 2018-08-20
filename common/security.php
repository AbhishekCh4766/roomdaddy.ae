<?php 
	if(!isset($_SESSION[ADMIN_SESSION_NAME]['userid']))
	{
		header("Location: login.php");
	}
?>