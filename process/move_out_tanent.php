<?php 
$db = new DBManager();
$error_msg="";
//echo "Hello";exit;
$roomid=base64_decode($_REQUEST['roomid']);
$getTanentid=$db->getTanentByRoom($roomid);
$date=$_REQUEST['deposit_year']."-".$_REQUEST['deposit_month']."-".$_REQUEST['deposit_date'];
if($error_msg=="")
{
	
	$RemoveTanenet = $db->RemoveTanenet($getTanentid[0]['tanentid'],$date);
	$log=$db->Addlog(
					SG_Validate_Input($getTanentid[0]['tanentid'],INPUT_TYPE_INT),
					SG_Validate_Input("tbl_tanents",INPUT_TYPE_TEXT),
					SG_Validate_Input("Move Out",INPUT_TYPE_TEXT),
					SG_Validate_Input("",INPUT_TYPE_TEXT)
					);
	if($getTanentid[0]['isrented']=='2')
	{
		$vacatRoom=$db->VacatRoom2($roomid);
	}
	if($getTanentid[0]['isrented']=='1')
	{
		$vacatRoom=$db->VacatRoom($roomid);
	}
	//function Addlog($tbl_id,$tbl_name,$action,$edit_delete)
	
}
else
{
	echo $error_msg;
}
?>