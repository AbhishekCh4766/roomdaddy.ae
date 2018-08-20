<?php 
$db = new DBManager();
$error_msg="";
$chargeto="";
$date=$_REQUEST['empower_year']."-".$_REQUEST['empower_month']."-".$_REQUEST['empower_date'];
$desc=$_REQUEST['empower_desc'.$_REQUEST['empower_building']];
if($error_msg=="")
{
	$flag = $db->AddExpense(
							SG_Validate_Input($_REQUEST['empower_building'],INPUT_TYPE_TEXT),
							SG_Validate_Input('Utilities',INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['empower_amount'.$_REQUEST['empower_building']],INPUT_TYPE_TEXT),
							SG_Validate_Input($desc,INPUT_TYPE_TEXT),
							SG_Validate_Input('EMPOWER',INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['empower_payment_by'.$_REQUEST['empower_building']],INPUT_TYPE_TEXT),
							SG_Validate_Input($date,INPUT_TYPE_TEXT),
							SG_Validate_Input($chargeto,INPUT_TYPE_TEXT)
							);
							if(count($flag) > 0)
							{	
								echo  'Empower Bill paid';
							}
							else
							{
								echo '<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Error in saving Property</span></div>';
							}
}
else
{
	echo $error_msg;
}
?>