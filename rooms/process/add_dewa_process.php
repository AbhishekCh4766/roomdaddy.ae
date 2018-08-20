<?php 
$db = new DBManager();
$error_msg="";
$chargeto="";
$date=$_REQUEST['dewa_year']."-".$_REQUEST['dewa_month']."-".$_REQUEST['dewa_date'];
$desc=$_REQUEST['dewa_desc'.$_REQUEST['dewa_building']];
if($error_msg=="")
{
	$flag = $db->AddExpense(
							SG_Validate_Input($_REQUEST['dewa_building'],INPUT_TYPE_TEXT),
							SG_Validate_Input('Utilities',INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['dewa_amount'.$_REQUEST['dewa_building']],INPUT_TYPE_TEXT),
							SG_Validate_Input($desc,INPUT_TYPE_TEXT),
							SG_Validate_Input('DEWA',INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['dewa_payment_by'.$_REQUEST['dewa_building']],INPUT_TYPE_TEXT),
							SG_Validate_Input($date,INPUT_TYPE_TEXT),
							SG_Validate_Input($chargeto,INPUT_TYPE_TEXT)
						);
							if(count($flag) > 0)
							{	
								echo  'Dewa Bill Paid';
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