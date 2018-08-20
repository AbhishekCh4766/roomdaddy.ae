<?php
@session_start();
include_once("DBAccess.php");

Class EmailManager extends DBAccess
{
	function sendEmail($from, $to, $subject, $email_content)
	{
		$headers  = "From: Toyota Sargodha<$from>\r\n";
		$headers .= "Reply-To: $from\r\n";
		$headers .= "Return-Path: $from\r\n";
		$headers .= "X-Mailer: Drupal\n";
		$headers .= 'MIME-Version: 1.0' . "\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$result = mail($to,$subject,$email_content,$headers);
		return $result;
	}
	
}
?>