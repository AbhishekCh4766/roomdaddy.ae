<?php 
include_once("../dbbridge/top1.php");
$db = new DBManager();
$error_msg="";

$building=base64_decode($_REQUEST['building']);
if($error_msg=="")
{
	for($i=1;$i<=$_REQUEST['num_of_chqs'];$i++)
	{
		if($_REQUEST['rid']=="NULL")
		{
				$flag = $db->AddChqDetails(
								SG_Validate_Input($building,INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['owner'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_owner'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_year'.$i]."-".$_REQUEST['chq_month'.$i]."-".$_REQUEST['chq_date'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_num'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_amount'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_year_till'.$i]."-".$_REQUEST['chq_month_till'.$i]."-".$_REQUEST['chq_date_till'.$i],INPUT_TYPE_TEXT)
								);
								$path=SERVER_PATH."add_rooms.php?bid=".$_REQUEST['building'];
								header("Location:$path");
		}
		else
		{
			$flag = $db->AddChqDetails(
								SG_Validate_Input($building,INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['owner'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_owner'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_year'.$i]."-".$_REQUEST['chq_month'.$i]."-".$_REQUEST['chq_date'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_num'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_amount'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['chq_year_till'.$i]."-".$_REQUEST['chq_month_till'.$i]."-".$_REQUEST['chq_date_till'.$i],INPUT_TYPE_TEXT)
								);
								$path=SERVER_PATH."properties.php";
								header("Location:$path");
		}
	}
	
	
}

else
{
	echo $error_msg;
}

?>