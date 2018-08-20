<?php 
include_once("dbbridge/top.php");
$db = new DBManager();
$error_msg="";
$roomid=base64_decode($_REQUEST['room']);
//function editRoom($id,$name,$expected_rent,$notes)
if($error_msg=="")
{
		$flag = $db->editRoom(
						SG_Validate_Input($roomid,INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['room_name'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['room_rent'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['notes'],INPUT_TYPE_TEXT)
						);
		echo "Room Details Updated";
	
}
else
{
	echo $error_msg;
}
?>