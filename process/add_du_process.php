<?php 
$db = new DBManager();
$error_msg="";
$chargeto="";
$date=$_REQUEST['du_year']."-".$_REQUEST['du_month']."-".$_REQUEST['du_date'];
$desc=$_REQUEST['du_desc'.$_REQUEST['du_building']];
if($error_msg=="")
{
	$flag = $db->AddExpense(
							SG_Validate_Input($_REQUEST['du_building'],INPUT_TYPE_TEXT),
							SG_Validate_Input('Utilities',INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['du_amount'.$_REQUEST['du_building']],INPUT_TYPE_TEXT),
							SG_Validate_Input($desc,INPUT_TYPE_TEXT),
							SG_Validate_Input('DU',INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['du_payment_by'.$_REQUEST['du_building']],INPUT_TYPE_TEXT),
							SG_Validate_Input($date,INPUT_TYPE_TEXT),
							SG_Validate_Input($chargeto,INPUT_TYPE_TEXT)
						);
							if(count($flag) > 0)
							{	
								echo  'DU Bill paid';
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