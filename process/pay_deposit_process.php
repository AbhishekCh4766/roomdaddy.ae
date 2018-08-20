<?php 

// print_r($_REQUEST);
// die;
$db = new DBManager();
$error_msg="";
if($_REQUEST['deposit_pay']=="")
{
	$error_msg.="Please Enter Deposit Value";
}
$roomid=base64_decode($_REQUEST['roomid']);


//$getTanentid=$db->getTanentByRoom($roomid);
$date=$_REQUEST['payment_date'];
if($error_msg=="")
{
	$flag = $db->PayDeposit(
							SG_Validate_Input($_REQUEST['tenent_id'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['deposit_pay'],INPUT_TYPE_TEXT),
							SG_Validate_Input($date,INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['deposit_collect_by'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['deposit_desc'],INPUT_TYPE_TEXT)
							);
							if(count($flag) > 0)
							{	
								echo  'done-<span class="ico_success">'.$_REQUEST['deposit_pay'].' Collected</span>-';
							}
							else
							{
								echo '<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Error in Adding Deposit</span></div>';
							}
								$log = $db->Addlog(
												SG_Validate_Input($flag,INPUT_TYPE_INT),
												SG_Validate_Input("tbl_deposit_in",INPUT_TYPE_TEXT),
												SG_Validate_Input("ADD",INPUT_TYPE_TEXT),
												SG_Validate_Input("",INPUT_TYPE_TEXT)
											);
}
else
{
	echo $error_msg;
}
?>