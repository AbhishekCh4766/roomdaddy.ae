<?php 
$am = new AdminManager();
$error_msg = "";

if($_REQUEST['email'] =="")
{
	$error_msg = '<div id="fail" class="info_div" style="width:96%;"><span class="ico_cancel" id="error_msg">Please Enter Email</span></div>';
}
/*else
{
	if (!check_email_address($_REQUEST['email']))
	{
		$error_msg .= '<span class="ico_cancel" id="error_msg">Invalid Email Address</span>';
	}
}*/

if($error_msg == "")
{
	$chkemail		=	$am->checkEmailExistance($_REQUEST['email']);
//print_r($chkemail);exit;
	if($chkemail[0] != "")
	{
		$admin_id =  $chkemail[0]['fld_id'];
		$new_password = ifish_getLostPassword();
		
		$am->save_new_password($new_password, $admin_id);
		$admin_info = $am->getAdmin($admin_id);
		$from_email = $admin_info[0]['fld_email'];
		
		$to_email = $_REQUEST['email'];
		$subject  = "ApexTransports (Forgot Password)  ";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: <$from_email>\r\n";
		
		$msg = "Forgot Password (New Password Generated) <br>";
		$msg.="<h3>This is an autogenerated email So Please do not relpy to this mail.</h3><br><br>";
		$msg.="<h3>Your New Password:</h3><br><br>";
		$msg.="E-mail: ".$_REQUEST['email']."<br>";
		$msg.="Password: ".$new_password;
		//echo $msg; exit;
		// send mail to Student
		@mail($to_email,$subject,$msg,$headers);
		echo "done";
	}
	else
	{
		echo '<div id="fail" class="info_div" style="width:96%;"><span class="ico_cancel" id="error_msg">No admin is registered on this email.</span></div>';
	}	 
}	

echo $error_msg;	
?>