<?php 
$db = new DBManager();
// print_r($_REQUEST);
// die;
$error_msg="";
if($_REQUEST['expense_on']=="")
{
	$error_msg.='<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Please Select Apartment</span></div>';
}
if($_REQUEST['expense_type']=="")
{
	$error_msg.='<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Please Select Expense Type</span></div>';
}
if($_REQUEST['expense']=="")
{
	$error_msg.='<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Please Enter Expense Amount</span></div>';	
}
else if($_REQUEST['expense']<=0)
{
	$error_msg.='<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Expense Amount should be Greater then ZERO</span></div>';
}
if($_REQUEST['paymentto']=="")
{
	$error_msg.='<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Please Enter Payment to</span></div>';	
}
if($_REQUEST['expense_on']!=0)
{
	$_REQUEST['charge_to']="";
}
$date=$_REQUEST['year']."-".$_REQUEST['month']."-".$_REQUEST['date'];
if($error_msg=="")
{
	$flag = $db->EditExpense(
		                    SG_Validate_Input($_REQUEST['id'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['expense_on'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['expense_type'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['expense'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['description'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['paymentto'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['paymentby'],INPUT_TYPE_TEXT),
							SG_Validate_Input($date,INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['charge_to'],INPUT_TYPE_TEXT)
							);
							if(count($flag) > 0)
							{	
								echo  'done-<span class="ico_success">Expense Added</span>-';
							}
							else
							{
								echo '<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Error in saving Expense</span></div>';
							}
}
else
{
	echo $error_msg;
}
?>