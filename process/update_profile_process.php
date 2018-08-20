<?php 
include_once("../dbbridge/top1.php");
$db = new DBManager();

$uid = $_SESSION['Enron FZE']['userid'];
$GetAdmins=$db->getAdminById($uid);

$admin_id = $_REQUEST['id'];


if(!empty($_FILES['profile_pic']['name']))
{

			$occupantpic="";
			$arrayProfileImg = array();
			$arrayProfileImg[] = "pdf";
			$arrayProfileImg[] = "png";
			$arrayProfileImg[] = "jpg";
			$arrayProfileImg[] = "jpeg";


			$file_ext  = strtolower(substr($_FILES['profile_pic']['name'], strrpos($_FILES['profile_pic']['name'], '.')+1));
			  $tmpFilePath = $_FILES['profile_pic']['tmp_name'];
			  if ($tmpFilePath != "")
			  {
				$target_path = '../img/profile/';
				if (!file_exists($target_path)) {
					
				   mkdir($target_path, 0777, true);
					
				}
			    $source = $target_path.$_FILES['profile_pic']['name'];
				if(in_array($file_ext, $arrayProfileImg)){
			    if(move_uploaded_file($tmpFilePath, $source)) {
			      chmod($target_path, 0777);
			    }
				$path_parts = pathinfo($source);
				$name = time();
				$p_image='PROFILE_'.$name;
				$file = $target_path.$p_image.".".$path_parts['extension'];
				$occupantpic = $p_image.".".$path_parts['extension'];
				if(file_exists($file))
				{
					unlink($file);
				}
				rename($source, $target_path.$p_image.".".$path_parts['extension']);
				}
			  }
}
elseif(!empty($GetAdmins[0]['fld_profile_pic']))  
{
	$occupantpic = $GetAdmins[0]['fld_profile_pic'];
}	

else 
{
	$occupantpic = null;
}
	
	 $flag = $db->update_profile(
		                    SG_Validate_Input($_REQUEST['name'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['email'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['number'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['id'],INPUT_TYPE_TEXT),
							SG_Validate_Input($occupantpic,INPUT_TYPE_TEXT)
							
							);

							$path=SERVER_PATH."edit-profile.php";
								header("Location:$path");
	

?>