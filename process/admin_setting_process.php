<?php 

$am = new AdminManager();
$error_msg = "";

if($_REQUEST['uname'] =="")
{
	$error_msg = '<span class="ico_cancel" id="error_msg">Please specify Username</span>';
}

if($_REQUEST['email'] =="")
{
	$error_msg .= '<span class="ico_cancel" id="error_msg">Please specify Email</span>';
}
else
{
	if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_REQUEST['email']))
		{
			$error_msg.= "<span class='ico_cancel' id='error_msg'>Please Enter Valid Email Address</span>";
		}
}
if($_REQUEST['oldpass'] == "")
{
	$error_msg.= '<span class="ico_cancel" id="error_msg">Please enter old password.</span>';
}
else
{
	$chklogin =	$am->adminLogin($_REQUEST['email'], $_REQUEST['oldpass']);
	if(empty($chklogin))
	{
		$error_msg.= '<span class="ico_cancel" id="error_msg">Invalid old password, please enter correct old password.</span>';
	}	 
	else
	{
		if($_REQUEST['oldpass'] == $_REQUEST['pwd'])
		{
			$error_msg.= '<span class="ico_cancel" id="error_msg">Old password and new password are same.</span>';
		}
	}
}

if($_REQUEST['pwd'] !="")
{
	if($_REQUEST['cpwd'] =="")
	{
		$error_msg .= '<span class="ico_cancel" id="error_msg">Please Enter Confirm Password</span>';
	}
	else
	{
		if($_REQUEST['pwd'] != $_REQUEST['cpwd'])
		{
			$error_msg .= '<span class="ico_cancel" id="error_msg">Confirm Password does not match</span>';
		}	
	}
}
 


if($error_msg == "")
{
	$am->editAdminInfo($_REQUEST['uname'], $_REQUEST['email'], $_REQUEST['pwd'], $_SESSION[ADMIN_SESSION_NAME]['userid']);
	
	echo "done-Setting Changed Successfully";
}	

if($error_msg !="")
{
	echo '<div id="fail" class="info_div">'.$error_msg."</div>";	
}	

?>