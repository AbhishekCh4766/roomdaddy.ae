<?php
include "../dbbridge/DBManager.php";
include "../common/functions.php";
$db = new DBManager();



 $userid= $_REQUEST['userid'];
 $role = $_REQUEST['role'];

  $flag = $db->deletePreviousRole(SG_Validate_Input($userid,INPUT_TYPE_TEXT));
  
foreach($_REQUEST['role'] as $role)
{
	$flag1 = $db->EditRole(
								SG_Validate_Input($userid,INPUT_TYPE_TEXT),
								SG_Validate_Input($role,INPUT_TYPE_TEXT)
								);
}
?>