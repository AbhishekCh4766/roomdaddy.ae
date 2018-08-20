<?php 
include_once("../dbbridge/top1.php");
$db = new DBManager();
$error_msg="";
$roomid=base64_decode($_REQUEST['room']);
$back_link=SERVER_PATH."edit_room.php?rid=".$_REQUEST['room'];
$arrayProfileImg = array();
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";
$i=0;
$total = count($_FILES['image']['name']);
for($i=0; $i<$total; $i++) 
{
	$file_ext  = strtolower(substr($_FILES['image']['name'][$i], strrpos($_FILES['image']['name'][$i], '.')+1));
  $tmpFilePath = $_FILES['image']['tmp_name'][$i];
  if ($tmpFilePath != "")
  {
	$target_path = '../rooms/ROOM_IMAGES/';
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
	$p_image1= 'room_'.$name1.$i;
	$file1 = $target_path.$p_image1.".".$path_parts['extension'];
	$file_name = $p_image1.".".$path_parts['extension'];
	if(file_exists($file1))
	{
		unlink($file1);
	}
	rename($source, $target_path.$p_image1.".".$path_parts['extension']);
	
	$upload_pic = $db->AddRoomPicsById(
										SG_Validate_Input($roomid,INPUT_TYPE_TEXT),
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
if($error_msg=="")
{
$flag = $db->editRoom(
						SG_Validate_Input($roomid,INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['room_name'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['room_rent'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['notes'],INPUT_TYPE_TEXT)
						);
		if(count($flag) > 0)
		{
			
			header("Location:$back_link");	
		}
}
else
{
	echo $error_msg;
}
?>