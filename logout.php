<?php
	include_once("dbbridge/top.php");
	$am = new AdminManager();
	/* $am->save_last_login($_SESSION['WHITE_CLEANING']['userid']);
	unset($_SESSION['WHITE_CLEANING']['userid']);
	unset($_SESSION['WHITE_CLEANING']['username']);
	unset($_SESSION['WHITE_CLEANING']['email']);
	unset($_SESSION['WHITE_CLEANING']['last_login']);
	unset($_SESSION['WHITE_CLEANING']['modified_on']);
	unset($_SESSION['WHITE_CLEANING']['role_id']); */
	$am->save_last_login($_SESSION[ADMIN_SESSION_NAME]['userid']);
	unset($_SESSION[ADMIN_SESSION_NAME]['userid']);
	unset($_SESSION[ADMIN_SESSION_NAME]['username']);
	unset($_SESSION[ADMIN_SESSION_NAME]['email']);
	unset($_SESSION[ADMIN_SESSION_NAME]['last_login']);
	unset($_SESSION[ADMIN_SESSION_NAME]['modified_on']);
	unset($_SESSION[ADMIN_SESSION_NAME]['role_id']);
?>
<script language="javascript">
	window.location.href="/login.php";
</script>