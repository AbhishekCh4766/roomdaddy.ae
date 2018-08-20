<?php 
include_once("../dbbridge/top1.php");
$db = new DBManager();
$error_msg="";
$contract_start=$_REQUEST['start_year']."-".$_REQUEST['start_month']."-".$_REQUEST['start_date'];
$contract_end=$_REQUEST['end_year']."-".$_REQUEST['end_month']."-".$_REQUEST['end_date'];
if($error_msg=="")
{
	if($_REQUEST['bid']=="NULL")
	{

		//die('here 1');
	$flag = $db->add_property(
							SG_Validate_Input($_REQUEST['area'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['building'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['num_of_beds'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['apt_num'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_SESSION[ADMIN_SESSION_NAME]['userid'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['dewa_num'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['du_num'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['empower_num'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['num_of_chqs'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['comission'],INPUT_TYPE_TEXT),
							SG_Validate_Input($contract_start,INPUT_TYPE_TEXT),
							SG_Validate_Input($contract_end,INPUT_TYPE_TEXT)
							);
							if(count($flag) > 0)
							{
								$buid=$flag;
								$path="../add_cheques.php?bid=".base64_encode($flag);
								header("Location:$path");
							}
							else
							{
								echo '<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Error in saving Property</span></div>';
							}
	}
	if($_REQUEST['bid']!="NULL" && $_REQUEST['purpose']=="NULL")
	{	
		

		//die('here 2');
		$bid=base64_decode($_REQUEST['bid']);
		$buid=$bid;
		$numofchqs=$db->GetNumofChqsByBuildingId($bid);
		if($numofchqs[0]['fld_num_of_chqs']==$_REQUEST['num_of_chqs'])
		{
			//No Redirection
			$flag = $db->update_building(
										SG_Validate_Input($bid,INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['area'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['dewa_num'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['du_num'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['empower_num'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['num_of_chqs'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['comission'],INPUT_TYPE_TEXT),
										SG_Validate_Input($contract_start,INPUT_TYPE_TEXT),
										SG_Validate_Input($contract_end,INPUT_TYPE_TEXT)
										);
										if(count($flag) > 0)
										{
											$path=SERVER_PATH."properties.php";
											header("Location:$path");
										}
										else
										{
											echo '<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Error in saving Property</span></div>';
										}
		}
		//Update Property with chq
		else
		{
			$flag = $db->update_building(
										SG_Validate_Input($bid,INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['area'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['dewa_num'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['du_num'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['empower_num'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['num_of_chqs'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['comission'],INPUT_TYPE_TEXT),
										SG_Validate_Input($contract_start,INPUT_TYPE_TEXT),
										SG_Validate_Input($contract_end,INPUT_TYPE_TEXT)
										);
										if(count($flag) > 0)
										{
											$flag2	=	$db->DeleteChequeByProperties($bid);
											if(count($flag2) > 0)
											{
												$path=SERVER_PATH."add_cheques.php?bid=".base64_encode($bid)."&rid=0bf421521eb70023a3b26e3af381551e";
												header("Location:$path");
											}
										}
										else
										{
											echo '<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Error in saving Property</span></div>';
										}
		}
	}
	if($_REQUEST['purpose']!="NULL")
	{
		$getBuildingData=$db->getBuildingById(base64_decode($_REQUEST['bid']));
		$flag	=	$db->Renew_Contract(
										SG_Validate_Input($getBuildingData[0]['fld_id'],INPUT_TYPE_TEXT),
										SG_Validate_Input($getBuildingData[0]['fld_contract_starting_date'],INPUT_TYPE_TEXT),
										SG_Validate_Input($getBuildingData[0]['fld_contract_ending_date'],INPUT_TYPE_TEXT),
										SG_Validate_Input($getBuildingData[0]['fld_rent'],INPUT_TYPE_TEXT),
										SG_Validate_Input($getBuildingData[0]['fld_deposit'],INPUT_TYPE_TEXT),
										SG_Validate_Input($getBuildingData[0]['fld_comission'],INPUT_TYPE_TEXT),
										SG_Validate_Input($getBuildingData[0]['fld_num_of_chqs'],INPUT_TYPE_TEXT)
										);
		//function update_renewed_building($id,$num_of_chqs,$rent,$deposit,$comission,$contract_start,$contract_end)
		$flag2	=	$db->update_renewed_building(
												
										SG_Validate_Input(base64_decode($_REQUEST['bid']),INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['num_of_chqs'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
										SG_Validate_Input($_REQUEST['comission'],INPUT_TYPE_TEXT),
										SG_Validate_Input($contract_start,INPUT_TYPE_TEXT),
										SG_Validate_Input($contract_end,INPUT_TYPE_TEXT));
				if(count($flag2) > 0)
				{
					$path=SERVER_PATH."add_cheques.php?bid=".$_REQUEST['bid']."&rid=0bf421521eb70023a3b26e3af381551e";
					header("Location:$path");
				}
	}
}

/****/

if($_REQUEST['bid']!="NULL")
{
	$back_link=SERVER_PATH."add_property.php?rid=".$_REQUEST['bid'];
}
else
{
	$back_link=SERVER_PATH."add_property.php";
}
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";
$i=0;
$total = count($_FILES['image']['name']);
for($i=0; $i<$total; $i++) 
{
	$custom_name=$_REQUEST['file_name'][$i];
	$file_ext  = strtolower(substr($_FILES['image']['name'][$i], strrpos($_FILES['image']['name'][$i], '.')+1));
  $tmpFilePath = $_FILES['image']['tmp_name'][$i];
  if ($tmpFilePath != "")
  {
	$target_path = '../Documents/PROPERTY_DOC/';
	if (!file_exists($target_path)) {
		
	   mkdir($target_path, 0777, true);
		
	}
    $source = $target_path.$_FILES['image']['name'][$i];
	if(in_array($file_ext, $arrayProfileImg)){
    if(move_uploaded_file($tmpFilePath, $source)) {
      chmod($target_path, 0777);
    }
	$path_parts = pathinfo($source);
	$name1 = time();
	$p_image1= 'FILE_'.$name1.$i;
	$file1 = $target_path.$p_image1.".".$path_parts['extension'];
	$file_name = $p_image1.".".$path_parts['extension'];
	if(file_exists($file1))
	{
		unlink($file1);
	}
	rename($source, $target_path.$p_image1.".".$path_parts['extension']);
	//$custom_name   function UploadDocuments($property,$custom_name,$file_name)
	$upload_docs = $db->UploadDocuments(
										SG_Validate_Input($buid,INPUT_TYPE_TEXT),
										SG_Validate_Input($custom_name,INPUT_TYPE_TEXT),
										SG_Validate_Input($file_name,INPUT_TYPE_TEXT)
										);
	}
	else
	{
		$error_msg .= ' 
					<div style="padding-left:38%;padding-top: 50px;">
					<span><a href="'.$back_link.'" style="text-decoration:none;"><span>Invalid image, image must be: .png,.jpg<br>Click to try Again</span></a></span>
					</div>
		';
	}
}
}
/****/

?>