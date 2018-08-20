<?php 
$db = new DBManager();
//function AddUser($name,$officialName,$number,$email,$createdby)
$flag = $db->AddUser(
						SG_Validate_Input($_REQUEST['user_name'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['official_name'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['number'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['email'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['add_by'],INPUT_TYPE_TEXT)
						);
						
foreach($_REQUEST['role'] as $role)
{
	$flag1 = $db->AddRoletoUser(
								SG_Validate_Input($flag,INPUT_TYPE_TEXT),
								SG_Validate_Input($role,INPUT_TYPE_TEXT)
								);
}	
if(isset($_REQUEST['user']))
{	
	foreach($_REQUEST['user'] as $user)
	{
		$flag2 = $db->AddAccessToSummary(
									SG_Validate_Input($flag,INPUT_TYPE_TEXT),
									SG_Validate_Input($user,INPUT_TYPE_TEXT)
									);
	}
}
?>