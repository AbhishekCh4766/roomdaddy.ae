<?php
require_once("class.phpmailer.php");

function sendMail($toEmail,$toName,$subject,$msg,$returnMessage)
{
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "relay-hosting.secureserver.net";
	//$mail->SMTPAuth = true; 
	//$mail->SMTPSecure = "ssl";
	//$mail->Port = "465" 
	$mail->Username = "no-reply@hazara.com.pk";
	$mail->Password = "Hazara1";
	
	$mail->From = "no-reply@hazara.com.pk";
	$mail->FromName = "HCP Support"; 
	$mail->AddAddress($toEmail, $toName);
	$mail->AddAddress("shoaib.iqbal@hazara.com.pk", "Shoaib Iqbal");
	$mail->Subject = $subject;
	$mail->IsHTML();
	$mail->Body = $msg;

	if ($mail->Send() == true)
	{
		echo $returnMessage;
	}
	else 
	{
		echo "<p>The email message has <strong>NOT</strong> been sent for some reasons. Please try again later.</p>";
	}
}

// Used to send an email.
function sendMailEx($to, $toName, $from, $fromName, $subject, $msg)
{
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "relay-hosting.secureserver.net";
	//$mail->SMTPAuth = true; 
	//$mail->SMTPSecure = "ssl";
	//$mail->Port = "465" 
	//$mail->Username = "no-reply@hazara.com.pk";
	//$mail->Password = "Hazara1";
	
	if (strlen($toName) == 0)
		$toName = $to;
		 
	$mail->From = $from;
	$mail->FromName = $fromName; 
	$mail->AddAddress($to, $toName);
	$mail->Subject = $subject;
	$mail->IsHTML();
	$mail->Body = $msg;

	if ($mail->Send() == true)
	{
		return 1;
	}
	
	return 0;
}

?>