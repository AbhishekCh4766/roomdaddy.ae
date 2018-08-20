<?php 

print_r($_REQUEST);

$db = new DBManager();
$error_msg="";
$rent_month=$_REQUEST['rent_year']."-".$_REQUEST['rent_month'];
$date=$_REQUEST['rent_date'];
if($_REQUEST['rent']=="")
{
	$error_msg.='<span class="ico_cancel" id="error_msg">Please Enter Rent.</span>';
}
$roomid=base64_decode($_REQUEST['roomid']);
$getRoomInfo=$db->GetBedspaceBytanentId($_REQUEST['tenent_id']);
print_r($getRoomInfo);

//if($_REQUEST['rent_id']=='0' || $_REQUEST['rent_id']==0)
{
	if($error_msg=="")
	{
		$flag = $db->addRent(
								SG_Validate_Input($roomid,INPUT_TYPE_INT),
								SG_Validate_Input($_REQUEST['tenent_id'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
								SG_Validate_Input($getRoomInfo[0]['fld_owner'],INPUT_TYPE_TEXT),
								SG_Validate_Input($getRoomInfo[0]['fld_building_id'],INPUT_TYPE_TEXT),
								SG_Validate_Input($rent_month,INPUT_TYPE_TEXT),
								SG_Validate_Input($date,INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['rent_desc'],INPUT_TYPE_TEXT)
								
							);
							
		//function Addlog($tbl_id,$tbl_name,$tbl_action,$edit_delete)
		
								if(count($flag) > 0)
								{	
									echo  'done-<span class="ico_success">'.$_REQUEST['rent'].' Collected for '.$getRoomInfo[0]['fld_room_name'].'</span>-';
								}
								else
								{
									echo '<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Error in Adding Rent</span></div>';
								}
								$log = $db->Addlog(
												SG_Validate_Input($flag,INPUT_TYPE_INT),
												SG_Validate_Input("tbl_rent_status",INPUT_TYPE_TEXT),
												SG_Validate_Input("ADD",INPUT_TYPE_TEXT),
												SG_Validate_Input("",INPUT_TYPE_TEXT)
											);
	}
	else
	{
		echo $error_msg;
	}
}
// else
// {
	// $flag	=	$db->updateRent(
								// SG_Validate_Input($_REQUEST['rent_id'],INPUT_TYPE_TEXT),
								// SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
								// SG_Validate_Input($_REQUEST['balance'],INPUT_TYPE_TEXT)
								// );
								// if(count($flag) > 0)
								// {	
									// echo "Rent Status Updated";
								// }
// }
?>