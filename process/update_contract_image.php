<?php

include_once("../dbbridge/top1.php");
$db = new DBManager();

if(!empty($_FILES['contract_pic']['name']))
{

			$contract_pic="";
			$arrayProfileImg = array();
			$arrayProfileImg[] = "pdf";
			$arrayProfileImg[] = "png";
			$arrayProfileImg[] = "jpg";
			$arrayProfileImg[] = "jpeg";


			$file_ext  = strtolower(substr($_FILES['contract_pic']['name'], strrpos($_FILES['contract_pic']['name'], '.')+1));
			  $tmpFilePath = $_FILES['contract_pic']['tmp_name'];
			  if ($tmpFilePath != "")
			  {
				$target_path = '../img/contract/';
				if (!file_exists($target_path)) {
					
				   mkdir($target_path, 0777, true);
					
				}
			    $source = $target_path.$_FILES['contract_pic']['name'];
				if(in_array($file_ext, $arrayProfileImg)){
			    if(move_uploaded_file($tmpFilePath, $source)) {
			      chmod($target_path, 0777);
			    }
				$path_parts = pathinfo($source);
				$name = time();
				$p_image='CONTRACT_'.$name;
				$file = $target_path.$p_image.".".$path_parts['extension'];
				$contract_pic = $p_image.".".$path_parts['extension'];
				if(file_exists($file))
				{
					unlink($file);
				}
				rename($source, $target_path.$p_image.".".$path_parts['extension']);
				}
			  }
} 

				 $flag = $db->update_contract(  
				 	SG_Validate_Input($_REQUEST['id'],INPUT_TYPE_TEXT),
				 	SG_Validate_Input($contract_pic,INPUT_TYPE_TEXT) 
				 );
              

							$path=SERVER_PATH."client-docs.php";
								header("Location:$path");
?>