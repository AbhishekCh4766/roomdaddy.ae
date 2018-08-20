<?php 
$db = new DBManager();
$error_msg="";
$expense_type=$_REQUEST['new_expense_type'];
if($error_msg=="")
{
	$flag = $db->AddExpenseType(
							SG_Validate_Input($expense_type,INPUT_TYPE_TEXT)
						);
							if(count($flag) > 0)
							{	
								echo  'done-<span class="ico_success">Expense Type Added</span>-';
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