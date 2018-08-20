<?php 
include_once("../dbbridge/top1.php");
$db = new DBManager();
$error_msg="";

//addRooms($buildingid,$room_name,$custom_room_name,$estimated_rent,$owner)
$building=base64_decode($_REQUEST['building']);
$getBuildinginfo=$db->GetNumofChqsByBuildingId($building);
$room=$getBuildinginfo[0]['fld_building']." ".$getBuildinginfo[0]['fld_apt_no'];
if($error_msg=="")
{
	for($i=1;$i<=$_REQUEST['num_of_beds'];$i++)
	{
		$flag = $db->addRooms(
						SG_Validate_Input($building,INPUT_TYPE_TEXT),
						SG_Validate_Input($room." Room ".$i,INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['room_name'.$i],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['room_rent'.$i],INPUT_TYPE_TEXT),
						SG_Validate_Input($getBuildinginfo[0]['fld_tanent'],INPUT_TYPE_TEXT)
						);
						$path="/roomdaddy/admin/";
						header("Location:$path");
	}

}
else
{
	echo $error_msg;
}
?>