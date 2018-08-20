<?php 
include_once("../dbbridge/top1.php");
$db = new DBManager();
$error_msg="";

//addRooms($buildingid,$room_name,$custom_room_name,$estimated_rent,$owner)

if($error_msg=="")
{

	$flag = $db->AddBeneficiary(
					SG_Validate_Input($_REQUEST['user_name'],INPUT_TYPE_TEXT),
					SG_Validate_Input($_REQUEST['add_by'],INPUT_TYPE_TEXT)
					);
					$path=SERVER_PATH."add_beneficiary.php";
					header("Location:$path");
}
else
{
	echo $error_msg;
}
?>