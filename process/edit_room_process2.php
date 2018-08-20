<?php 

// print_r($_REQUEST);
// die;
 include_once("../dbbridge/top1.php");
 $db = new DBManager();
 $error_msg="";

 $roomid=base64_decode($_REQUEST['room']);
 $back_link=SERVER_PATH."room_list.php";
 $arrayProfileImg = array();
 $arrayProfileImg[] = "png";
 $arrayProfileImg[] = "jpg";
 $arrayProfileImg[] = "jpeg";
 $i=0;
 $total = count($_FILES['image']['name']);


 $image_id = $_REQUEST['image_id'];

	if(!empty($image_id))
	{
	    for($k=0;$k<=count($image_id);$k++)
	     {
		       $imageId = $image_id[$k];
	     }
	}



	for($i=0; $i<$total; $i++) 
	{
		if(!empty($_FILES['image']['name'][$i]))
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
				
				if(in_array($file_ext, $arrayProfileImg))
				{
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
					 $imageId = $image_id[$i];
				    
				     $delete_pic = $db->DeletePicsById(SG_Validate_Input($imageId,INPUT_TYPE_TEXT));
					
					 $upload_pic = $db->AddRoomPicsById(SG_Validate_Input($roomid,INPUT_TYPE_TEXT),SG_Validate_Input($file_name,INPUT_TYPE_TEXT));
				}else{
					 
					 $error_msg .= '<div style="padding-left:38%;padding-top: 50px;"><span><a href="'.$back_link.'" style="text-decoration:none;"><span>Invalid image, image must be: .png,.jpg<br>Click to try Again</span></a></span>
								</div>';
				}
		    }
		}
	}





	if($error_msg=="")
	{

/*      $roomid
		echo "<pre/>";
		print_r($_REQUEST);
		die;*/

	    $flag = $db->editRoom(
							SG_Validate_Input($roomid,INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['room_name'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['room_rent'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['notes'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['balconices'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['metro_train'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['occupancy'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['gender'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['wins'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['bath'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['common_room'],INPUT_TYPE_TEXT),
							SG_Validate_Input($_REQUEST['avalability_date'],INPUT_TYPE_TEXT)
							);

		     if($_REQUEST['type'] =='Bedspace')
		     {
                $roomRent = $_REQUEST['room_rent'];
                $noOfBed = $_REQUEST['no_of_bedspace'];
                $totalPrice = $roomRent/$noOfBed;
               

             }else{
             	$roomRent = $_REQUEST['room_rent'];
                $noOfBed = 1;
                $totalPrice = $roomRent;
             }
              
              $type = $_REQUEST['type'];
       
		      $db->editBedSpace(
		      	              SG_Validate_Input($type),
		      	              SG_Validate_Input($roomid),
							  SG_Validate_Input($totalPrice),
							  SG_Validate_Input($noOfBed)
						     );


			if(count($flag) > 0)
			{
			 header("Location:$back_link");	
			}
	}else{
		echo $error_msg;
	}




?>