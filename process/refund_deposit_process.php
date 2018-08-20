<?php 
$db = new DBManager();
$error_msg="";
//echo "Hello";exit;
if($_REQUEST['deposit_pay']=="")
{
	$error_msg.="Please Enter Deposit Value";
}
$roomid=base64_decode($_REQUEST['roomid']);
$getTanentid=$db->getTanentByRoom($roomid);
$date=$_REQUEST['deposit_year']."-".$_REQUEST['deposit_month']."-".$_REQUEST['deposit_date'];
if($error_msg=="")
{
	$flag = $db->RefundDeposit(
							SG_Validate_Input($getTanentid[0]['tanentid'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['deposit_pay'],INPUT_TYPE_TEXT),
							SG_Validate_Input($date,INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['deposit_refunded_by'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['deposit_out_desc'],INPUT_TYPE_TEXT)
							);
	// $RemoveTanenet = $db->RemoveTanenet($getTanentid[0]['tanentid'],$date);
	// if($getTanentid[0]['isrented']=='2')
	// {
		// $vacatRoom=$db->VacatRoom2($roomid);
	// }
	// if($getTanentid[0]['isrented']=='1')
	// {
		// $vacatRoom=$db->VacatRoom($roomid);
	// }
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
												SG_Validate_Input("tbl_deposit_out",INPUT_TYPE_TEXT),
												SG_Validate_Input("ADD",INPUT_TYPE_TEXT),
												SG_Validate_Input("",INPUT_TYPE_TEXT)
											);
}
else
{
	echo $error_msg;
}
?>