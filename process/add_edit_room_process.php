<?php 
include_once("../dbbridge/top1.php");
$db = new DBManager();
$error_msg="";



$building=base64_decode($_REQUEST['building']);
$getBuildinginfo=$db->GetNumofChqsByBuildingId($building);
$room=$getBuildinginfo[0]['fld_building']." ".$getBuildinginfo[0]['fld_apt_no'];

	if($error_msg=="")
	{
		for($i=1;$i<=$_REQUEST['num_of_beds'];$i++)
		{

			$flag =1;
		      $flag = $db->addRooms(SG_Validate_Input($building,INPUT_TYPE_TEXT),
							      SG_Validate_Input($room." Room ".$i,INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['room_name'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['room_rent'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['owner'],INPUT_TYPE_TEXT),						
								SG_Validate_Input($_REQUEST['avalability_date'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['balconices'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['metro_train'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['occupancy'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['gender'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['bath'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['common_room'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['wins'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['notes'.$i],INPUT_TYPE_TEXT),
								SG_Validate_Input($getBuildinginfo[0]['fld_tanent'],INPUT_TYPE_TEXT)
							);


							
						    if($flag != 0)
						    {           
						       $noOfBeds = $_REQUEST['no_of_bedspace'.$i]; 
								for($k=1;$k<=$noOfBeds;$k++)
								{

								  if($k==1)
									{
									$blocked =1;
                                    $type = 'R';
                                    
									}else{
									$blocked =0;
									$type = '';
									
									}

						             $bedspace= $db->addBedspace(
													        SG_Validate_Input($flag,INPUT_TYPE_TEXT),
									                        SG_Validate_Input($building,INPUT_TYPE_TEXT),
															SG_Validate_Input($_REQUEST['notes'.$k],INPUT_TYPE_TEXT),
															SG_Validate_Input($_REQUEST['owner'],INPUT_TYPE_TEXT),
															SG_Validate_Input($blocked,INPUT_TYPE_TEXT),
															SG_Validate_Input($type,INPUT_TYPE_TEXT)				 
		                                                );
								}



                                // $image = $_FILES['image'.$i]; 
                                $arrayProfileImg = array();
								$arrayProfileImg[] = "png";
								$arrayProfileImg[] = "jpg";
								$arrayProfileImg[] = "jpeg";


                               for($j=0;$j<count($_FILES['image'.$i]['name']);$j++)
                                {
                                      
                                  //print_r($_FILES['image'.$i]['name'][$j]);


                                  if(!empty($_FILES['image'.$i]['name'][$j]))
									{
									$file_ext  = strtolower(substr($_FILES['image'.$i]['name'][$j], strrpos($_FILES['image'.$i]['name'][$j], '.')+1));
									$tmpFilePath = $_FILES['image'.$i]['tmp_name'][$j];
                                  
									if ($tmpFilePath != "")
									{
									$target_path = '../rooms/ROOM_IMAGES/';
									if (!file_exists($target_path)) {
									mkdir($target_path, 0777, true);	
									}


									$source =$target_path.$_FILES['image'.$i]['name'][$j];
                                      
                                     
                                   /*  print_r($source);
                                     die;*/

									if(in_array($file_ext, $arrayProfileImg))
									{
                                      //die('fffff');

									if(copy($tmpFilePath, $source)) {
										
									chmod($target_path, 0777, true);
									}

									$path_parts = pathinfo($source);
									
									$p_image1='FILE_'.microtime().$i.$j;
									$file1 = $target_path.$p_image1.".".$path_parts['extension'];
									$file_name = $p_image1.".".$path_parts['extension'];



          //print_r($file_name);


									if(file_exists($file1))
									{
									//unlink($file1);
									}

									rename($source, $target_path.$p_image1.".".$path_parts['extension']);
									

									//$delete_pic = $db->DeletePicsById(SG_Validate_Input($imageId,INPUT_TYPE_TEXT));

									$upload_pic = $db->AddRoomPicsById(SG_Validate_Input($flag,INPUT_TYPE_TEXT),SG_Validate_Input($file_name,INPUT_TYPE_TEXT));

									
									}else{

									$error_msg .= '<div style="padding-left:38%;padding-top: 50px;"><span><a href="'.$back_link.'" style="text-decoration:none;"><span>Invalid image, image must be: .png,.jpg<br>Click to try Again</span></a></span>
									</div>';
									}
									}
									}
                                 
                                 /* $flag++;*/
                                }
                                 
                    
                              /* print_r(count($_FILES['image'.$i]['name']));
                               echo "<br/>";*/
                             /*  for($j=1;$j<=count($image))
                               print_r($image);
                               echo "<br/>";*/


         

						    }


						       
						     
		}

		$path=SERVER_PATH;
		header("Location:$path");
	 
	}else{
	  echo $error_msg;
	}




?>