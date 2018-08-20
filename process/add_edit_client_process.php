<?php 
include_once("dbbridge/top.php");
$db = new DBManager();
$error_msg="";

// print_r($_REQUEST);
// die;
//$move_in=$_REQUEST['move_in_year']."-".$_REQUEST['move_in_month']."-".$_REQUEST['move_in_date'];
$move_in=$_REQUEST['date'];


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



	// $flag	=	$db->updateClient(
	// 							SG_Validate_Input($_REQUEST['tanentid'],INPUT_TYPE_TEXT),
	// 							SG_Validate_Input($_REQUEST['cname'],INPUT_TYPE_TEXT),
	// 							SG_Validate_Input($_REQUEST['email'],INPUT_TYPE_TEXT),
	// 							SG_Validate_Input($_REQUEST['nationality'],INPUT_TYPE_TEXT),
	// 							SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
	// 							SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
	// 							SG_Validate_Input($_REQUEST['number'],INPUT_TYPE_TEXT),
	// 							SG_Validate_Input($move_in,INPUT_TYPE_TEXT)
	// 							);
								if($flag>0)
		{
			

              echo "<div class='alert alert-success'>
                            <strong>Tanent Updated Successfully.</strong>
                            </div>";
			//echo "Tanent Updated Successfully";
		}
}
else
{
		// $flag = $db->add_client(
		// 						SG_Validate_Input($_REQUEST['cname'],INPUT_TYPE_TEXT),
		// 						SG_Validate_Input($_REQUEST['email'],INPUT_TYPE_TEXT),
		// 						SG_Validate_Input($_REQUEST['nationality'],INPUT_TYPE_TEXT),
		// 						SG_Validate_Input($_REQUEST['selectroom'],INPUT_TYPE_TEXT),
		// 						SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
		// 						SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
		// 						SG_Validate_Input($_REQUEST['number'],INPUT_TYPE_TEXT),
		// 						SG_Validate_Input($move_in,INPUT_TYPE_TEXT),
		// 						SG_Validate_Input($_REQUEST['bedspace_id'],INPUT_TYPE_TEXT)
		// 						);
                 
                 
                 if(!empty($_REQUEST['number']) && !empty($_REQUEST['deposit'])&& !empty($_REQUEST['number_of_occupants'])&& !empty($_REQUEST['minimum_stay'])&& !empty($_REQUEST['payment_due_date'])&& !empty($_REQUEST['rent']) )
                 {
                  $client = $db->getallclient($_REQUEST['number']);

                 
              
                  if(empty($client[0]))
                  {
                       $pass= 1234;
                 $password  =	ifish_encryptPassword($pass);

                

                        $flag = $db->add_client_new(
								SG_Validate_Input($_REQUEST['number'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['RoomId'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['bedspace_id'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['number_of_occupants'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['minimum_stay'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['payment_due_date'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['commission'],INPUT_TYPE_TEXT),
								SG_Validate_Input($move_in,INPUT_TYPE_TEXT),
								SG_Validate_Input($password,INPUT_TYPE_TEXT)
								);
                       if($flag > 0){
                        $db->BookRoom($_REQUEST['bedspace_id'],$flag);

                        $db->CreateTenenthistory($_REQUEST['RoomId'],$_REQUEST['bedspace_id'],$flag);
                       }
                  }

                  else {

                  	  // echo "<div class='alert alert-warning'>
                     //        <strong>Tennent Could Not Be Added! Number Already Exists.</strong>
                     //        </div>";

                  	 $pass= 1234;
                     $password  =	ifish_encryptPassword($pass);
                    
                     $id = $client[0]['fld_id'];

                         $flag = $db->updateClient(
								SG_Validate_Input($id,INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['RoomId'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['bedspace_id'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['deposit'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['number_of_occupants'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['minimum_stay'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['payment_due_date'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['rent'],INPUT_TYPE_TEXT),
								SG_Validate_Input($_REQUEST['commission'],INPUT_TYPE_TEXT),
								SG_Validate_Input($move_in,INPUT_TYPE_TEXT),
								SG_Validate_Input($password,INPUT_TYPE_TEXT)
								);
                  	$db->BookRoom($_REQUEST['bedspace_id'],$id);

                  	 $db->CreateTenenthistory($_REQUEST['RoomId'],$_REQUEST['bedspace_id'],$id);

                         echo "<div class='alert alert-warning'>
                            <strong>Tennent Updated Successfully!.</strong>
                            </div>"; exit;

                  }

                 }
                 else{
                 	  echo "<div class='alert alert-warning'>
                            <strong>Tennent Could Not Be Added! Please Fill All Details!</strong>
                            </div>";

                 }
		  
		// $checkRoomStatus=$db->checkNoticedRoom($_REQUEST['bedspace_id']);

		
		// if(!empty($checkRoomStatus[0]) )
		// {
		// 	// Put Rented 2 in this case
		// 	$flag2 = $db->BookRoom($_REQUEST['bedspace_id'],$flag,"A");
		// }
		// else
		// {
		// 	// Put Rented 1 in this case
		// 	$flag2 = $db->BookRoom($_REQUEST['bedspace_id'],$flag,"B");
		// }
		// //print_r($checkRoomStatus);
		
		if($flag>0)
		{
			  	  echo "<div class='alert alert-warning'>
                            <strong>Tennent Added Successfully!.</strong>
                            </div>";
		}                             
}
?>