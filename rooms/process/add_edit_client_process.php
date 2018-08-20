<?php 
include_once("dbbridge/top.php");
$db = new DBManager();
$error_msg="";
$move_in=$_REQUEST['move_in_year']."-".$_REQUEST['move_in_month']."-".$_REQUEST['move_in_date'];
if($_REQUEST['tanentid']!=0)
{

	//function Addlog($tbl_id,$tbl_name,$action,$edit_delete)
	$getTanentDetails = $db->getTanentById($_REQUEST['tanentid']);
	$name="";
	$email="";
	$nationality="";
	$deposit="";
	$rent="";
	$number="";
	$move_in_log="";
	if($_REQUEST['cname']!=$getTanentDetails[0]['fld_name'])
	{
		$name.=" Name was ".$getTanentDetails[0]['fld_name']." Updated to ".$_REQUEST['cname']."<br>";
	}
	if($_REQUEST['email']!=$getTanentDetails[0]['fld_email'])
	{
		$email.=" Email was ".$getTanentDetails[0]['fld_email']." Updated to ".$_REQUEST['email']."<br>";
	}
	if($_REQUEST['nationality']!=$getTanentDetails[0]['fld_nationality'])
	{
		$nationality.=" Nationality was ".$getTanentDetails[0]['fld_nationality']." Updated to ".$_REQUEST['nationality']."<br>";
	}
	if($_REQUEST['deposit']!=$getTanentDetails[0]['fld_deposit'])
	{
		$deposit.=" Deposit was ".$getTanentDetails[0]['fld_deposit']." Updated to ".$_REQUEST['deposit']."<br>";
	}
	if($_REQUEST['rent']!=$getTanentDetails[0]['fld_rent'])
	{
		$rent.=" Rent was ".$getTanentDetails[0]['fld_rent']." Updated to ".$_REQUEST['rent']."<br>";
	}
	if($_REQUEST['number']!=$getTanentDetails[0]['fld_number'])
	{
		$mumber.=" Number was ".$getTanentDetails[0]['fld_number']." Updated to ".$_REQUEST['number']."<br>";
	}
	if($move_in!=$getTanentDetails[0]['fld_move_in_date'])
	{
		$move_in_log.=" Move in was ".$getTanentDetails[0]['fld_move_in_date']." Updated to ".$move_in."<br>";
	}
	$edit_summary=$name.$email.$nationality.$deposit.$rent.$number.$move_in_log;
	$log = $db->AddLog(
						SG_Validate_Input($_REQUEST['tanentid'],INPUT_TYPE_INT),
						SG_Validate_Input("tbl_tanents",INPUT_TYPE_TEXT),
						SG_Validate_Input("Update",INPUT_TYPE_TEXT),
						SG_Validate_Input($edit_summary,INPUT_TYPE_TEXT)
					);
	$flag	=	$db->updateClient(
								SG_Validate_Input($_REQUEST['tanentid'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['cname'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['email'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['nationality'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['number'],INPUT_TYPE_TEXT),
								SG_Validate_Input($move_in,INPUT_TYPE_TEXT)
								);
								if($flag>0)
		{
			echo "Tanent Updated Successfully";
		}
}
else
{
	
	if($error_msg=="")
	{
		$flag = $db->add_client(
								SG_Validate_Input($_REQUEST['cname'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['email'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['nationality'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['selectroom'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['number'],INPUT_TYPE_TEXT),
								SG_Validate_Input($move_in,INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['bedspace_id'],INPUT_TYPE_TEXT)
								);
		$checkRoomStatus=$db->checkNoticedRoom($_REQUEST['selectroom']);
		if($checkRoomStatus[0]!="")
		{
			// Put Rented 2 in this case
			$flag2 = $db->BookRoom($_REQUEST['selectroom'],$flag,"A");
		}
		else
		{
			// Put Rented 1 in this case
			$flag2 = $db->BookRoom($_REQUEST['selectroom'],$flag,"B");
		}
		//print_r($checkRoomStatus);
		
		if($flag>0)
		{
			echo "Tanent Added Successfully";
		}
	}
	else
	{
		echo $error_msg;

	}
}
?>