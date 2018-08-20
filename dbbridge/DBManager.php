<?php
@session_start();
include_once("DBAccess.php");

Class DBManager extends DBAccess
{
	function getSuperAdmin()
	{
		$this->connectToDB();
		$sql="select * from tbl_admin";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}




	function getAdminById($id)
	{
		$this->connectToDB();
		$sql="select * from tbl_admin WHERE `fld_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}



 function addRooms($buildingid,$room_name,$custom_room_name,$expected_rent,$owner,$avalability_date,$balconices,$metro_train,$occupancy,$gender,$bath,$common_room,$wins,$notes,$fld_tanent)
	{

		$this->connectToDB();
		$table="tbl_rooms";
		$insert="`fld_building_id`,`fld_room_name`,`fld_custom_room_name`,`fld_expected_rent`,`fld_is_notice`,`fld_is_rented`, `fld_tanent`,`fld_owner`,`avalability_date`,`balconices`,`metro_train`,`occupancy`,`gender`,`common_room`,`bath`, `window`,`fld_notes`";
		$values="$buildingid,$room_name,$custom_room_name,$expected_rent,'0','0','0', $owner, $avalability_date, $balconices, $metro_train, $occupancy, $gender, $common_room, $bath, $wins, $notes ";

		 $result = $this->InsertRecord($table,$insert,$values);
		// echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		// die;
		$this->DBDisconnect();
		return $result;
	}



	 function addBedspace($room_id,$buildingid,$notes,$owner,$blocked,$type)
	{
		//print_r($_REQUEST);
		$this->connectToDB();
		$table="tbl_bedspace";

		$insert="`fld_room`,`fld_building_id`,`fld_notes`, `fld_tanent_id`,`fld_owner`,`fld_is_bs_model`,`fld_block_unblock`,`fld_is_notice`,`fld_type`";
		$values="$room_id,$buildingid,$notes,'0',$owner,'0',$blocked,'0',$type";
		
		$result = $this->InsertRecord($table,$insert,$values);
		// echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		// die;
		$this->DBDisconnect();
		return $result;
	}




	function add_property($area,$building,$num_of_beds,$apt_num,$user_id,$dewa,$du,$empower,$num_of_chqs,$rent,$deposit,$comission,$contract_start,$contract_end)
	{
		
		$this->connectToDB();
		$table = "tbl_building";
		$insert = "`fld_area`, `fld_building`, `fld_num_of_beds`, `fld_apt_no`, `fld_tanent`, `fld_dewa`, `fld_du`,`fld_empower`,`fld_num_of_chqs`,`fld_rent`,`fld_deposit`,`fld_comission`, `fld_contract_starting_date`, `fld_contract_ending_date`,`fld_approved`";
		$values = "$area,$building,$num_of_beds,$apt_num,$user_id,$dewa,$du,$empower,$num_of_chqs,$rent,$deposit,$comission,$contract_start,$contract_end,0";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		//die("djgh");
		
		$this->DBDisconnect();
		//die("kdg");

		return $result;	
	}



	function update_building($id,$area,$dewa,$du,$empower,$num_of_chqs,$rent,$deposit,$comission,$contract_start,$contract_end,$parking)
	{
		$this->connectToDB();
		$sql="update `tbl_building` set 
		`fld_area`=$area,
		`fld_contract_starting_date`=$contract_start,
		`fld_contract_ending_date`=$contract_end,
		`fld_rent`=$rent,
		`fld_deposit`=$deposit,
		`fld_comission`=$comission,
		`fld_dewa`=$dewa,
		`fld_du`=$du,
		`parking`=$parking,
		`fld_empower`=$empower,
		`fld_num_of_chqs`=$num_of_chqs
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}




	function DeleteChequeByProperties($id)
	{
		$this->connectToDB();
		$sql="delete from `tbl_chqs` where `fld_building_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

		function changePassword($id,$pass)
	{
		$this->connectToDB();
		$sql="update tbl_admin set fld_password=$pass WHERE fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}



	function getRoomsByBuilding($id)
	{
		$this->connectToDB();
		$sql="SELECT `tbl_bedspace`.*, `tbl_rooms`.`fld_room_name`, `tbl_rooms`.`fld_custom_room_name` FROM `tbl_bedspace` INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_building_id`='$id' WHERE `tbl_bedspace`.`fld_building_id`='$id' AND `fld_block_unblock`=1 GROUP BY `tbl_bedspace`.`fld_id` ORDER BY `tbl_bedspace`.`fld_id` ASC ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		//print_r($result); die;
		$this->DBDisconnect();
		return $result;
	}



	function getRoomsByBuildingToBook($id)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_rooms` WHERE `fld_building_id`='$id' AND `fld_is_rented`='0' OR (`fld_is_rented`='1' AND `fld_is_notice`=1 AND `fld_building_id`='$id')";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}





	function getRoomsById($id)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_rooms` WHERE `fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}




	function getRoomsByUserID($id)
	{
		$this->connectToDB();
		//$sql="select * from tbl_rooms WHERE fld_owner='$id'";
		$sql="SELECT `tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_apt_no` AS 'apt_no',
		`tbl_rooms`.`fld_room_name` AS 'room_name', 
		`tbl_rooms`.`fld_is_rented` AS 'is_rented', 
		`tbl_rooms`.`fld_is_notice` AS 'notice' 
		FROM `tbl_building` 
		INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_building_id`=`tbl_building`.`fld_id` 
		WHERE `tbl_building`.`fld_tanent`='$id'";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}



	function getRoomsByOwner($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_rooms` WHERE `fld_owner`=$id";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	

	function getAllBuildings($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_building` WHERE `fld_tanent`=$id AND `fld_approved` != 0";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}



	function getAllBuildingByOwner($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_building` WHERE `fld_tanent`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}


	function getAllBuilding()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_building` ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}



	function getExpensebyId($id)
	{

		// echo $id;
		// die;
		$this->connectToDB();
		$sql=" SELECT * from `tbl_expense` WHERE `fld_id` = '$id' ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}


	
	function add_client($name,$email,$nationality,$room,$deposit,$rent,$number,$movein,$bedspace_id)
	{
		$this->connectToDB();
		$table = "tbl_tanents";
		$insert = "`fld_name`, `fld_email`, `fld_number`, `fld_whatsapp_number`, `fld_sex`, `fld_password`, `fld_nationality`, `fld_room`, `fld_bedspace_id`, `fld_is_current_tanent`, `fld_is_notice`, `fld_minimum_stay`, `fld_move_in_date`, `fld_move_out_date`, `fld_deposit`, `fld_last_login`, `fld_setup_done`, `fld_update_date`, `fld_rent`, `fld_comission`, `fld_payment_due_date`,`fld_is_current_tanent`";
		$values = "$name,$email,$nationality,$room,$deposit,$rent,$number,$movein,'1',$bedspace_id,'1'";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}




	//`fld_number`, `fld_bedspace_id`, `fld_minimum_stay`, `fld_move_in_date`, `fld_deposit`,`fld_rent`,`fld_comission`,`fld_payment_due_date`,`fld_num_of_occupants`
	function add_client_new($number,$RoomId,$bedspace_id,$deposit,$number_of_occupants,$minimum_stay,$payment_due_date,$rent,$commission,$move_in,$password)
	{
		$this->connectToDB();
		$table = "tbl_tanents";
		$insert = "`fld_number`,`fld_room`, `fld_bedspace_id`,`fld_deposit`, `fld_num_of_occupants`, `fld_minimum_stay`, `fld_payment_due_date`,`fld_rent`,`fld_comission`,`fld_move_in_date`,`fld_password`,`fld_is_current_tanent`";
		$values = " $number,$RoomId,$bedspace_id,$deposit,$number_of_occupants,$minimum_stay,$payment_due_date,$rent,$commission,$move_in,$password,'1'";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}

	function getallclient($number){
      
      $this->connectToDB();
		$sql=" SELECT * from `tbl_tanents` WHERE `fld_number` = '$number' ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;

	  }



	function updateClient($id,$RoomId,$bedspace_id,$deposit,$number_of_occupants,$minimum_stay,$payment_due_date,$rent,$commission,$move_in,$password)
	{
  //       echo $id;
		// print_r($_REQUEST);
		// die;
		$this->connectToDB();
		$sql="update `tbl_tanents` set 
		`fld_room`=$RoomId,
		`fld_bedspace_id`=$bedspace_id,
		`fld_deposit`=$deposit,
		`fld_num_of_occupants`=$number_of_occupants,
		`fld_payment_due_date`=$payment_due_date,
		`fld_rent`=$rent,
		`fld_comission`=$commission,
		`fld_move_in_date`=$move_in,
		`fld_password`=$password,
		`fld_is_current_tanent`='1',
		`fld_minimum_stay`=$minimum_stay
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}



	function RemoveTanenet($id,$moveout)
	{
		$this->connectToDB();
		$sql="update `tbl_tanents` set 
		`fld_move_out_date`='$moveout',	
		`fld_is_current_tanent`='0'
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}



	function editRoom($id,$name,$expected_rent,$notes,$balconices,$metro_train,$occupancy,$gender,$wins,$bath,$common_room,$avalability_date)
	{


		$this->connectToDB();
		$sql="update `tbl_rooms` set
		`fld_custom_room_name`=$name,
		`fld_expected_rent`=$expected_rent,
		`fld_notes`=$notes,
		`balconices`=$balconices,
		`metro_train`=$metro_train,
		`occupancy`=$occupancy,
		`gender`=$gender,
		`window`=$wins,
		`bath`=$bath,
		`common_room`=$common_room,
		`avalability_date`=$avalability_date
		 where `fld_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
   

   
    function editBedSpace($type,$roomid,$totalPrice,$noOfBed)
	{
		

		$this->connectToDB();
		 
         $sql1 ="UPDATE tbl_bedspace SET `fld_block_unblock` = 0 ,`fld_expected_rent` = 0 ,`fld_type`=null where `fld_room`=$roomid";
         $this->CustomModify($sql1);
        /* echo $sql1;exit;*/
		
		 if($type =='Bedspace')
		 {
           $sql2="UPDATE tbl_bedspace SET `fld_block_unblock` = 1,`fld_expected_rent` = $totalPrice,
                 `fld_type`='B' where `fld_room`=$roomid ORDER BY `fld_block_unblock` DESC LIMIT $noOfBed";
		 }else{
          
           $sql2="UPDATE tbl_bedspace SET `fld_block_unblock` = 1,`fld_expected_rent` = $totalPrice, 
                   `fld_type`='R' where `fld_room`=$roomid ORDER BY `fld_block_unblock` DESC LIMIT $noOfBed";
		 }
		

		
		//echo $sql2;exit;
		$result=$this->CustomModify($sql2);
		$this->DBDisconnect();
		return $result;
	}






	function checkNoticedRoom($id)
	{ 
		$this->connectToDB();
		$sql = "SELECT * from `tbl_bedspace` WHERE `fld_id`='$id' AND `fld_is_notice`='1'";
		$result = $this->CustomQuery($sql);
		//echo $sql; exit;
		$this->DBDisconnect();
		return $result;
	}

	function BookRoom($id,$tanent)
	{
		$this->connectToDB();
		
		$sql="update `tbl_bedspace` set `fld_is_notice`=0, `fld_is_rented`=1, `is_booking_verified`=0,`fld_tanent_id`=$tanent where `fld_id` = $id";
		//echo $sql; exit;
		$result=$this->CustomModify($sql);

		$this->DBDisconnect();
		return $result;
	}




	function AddNotice($id)
	{
		$this->connectToDB();
		$sql="update `tbl_bedspace` set `fld_is_notice`='1' where fld_tanent_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}




	function GetPaymentHistory()
	{
		$this->connectToDB();
		$sql="SELECT `tbl_transactions`.*, `tbl_admin`.`fld_name` AS `transaction_by`  from `tbl_transactions`
        INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_transactions`.`fld_transaction_by`
		 WHERE `status`= '0' " 
		 ;
		//echo $sql;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}

    function GetBedspaceById($id)
    {
    	$this->connectToDB();
    	 $sql1= "SELECT * FROM `tbl_bedspace` WHERE `fld_id`='$id' ";
         
    	$result1=$this->CustomQuery($sql1); 
    	//print_r($result1); die("dkjfgh");
		$this->DBDisconnect();
		return $result1;
    }
    

      function GetBedspaceBytanentId($id)
    {
    	$this->connectToDB();
    	 $sql1= "SELECT * FROM `tbl_bedspace` WHERE `fld_tanent_id`='$id' ";
         
    	$result1=$this->CustomQuery($sql1); 
    	//print_r($result1); die("dkjfgh");
		$this->DBDisconnect();
		return $result1;
    }


	function AddNoticeToTanent($id)
	{
		$this->connectToDB();
		$sql="update `tbl_tanents` set `fld_is_notice`='1' where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}



	function addRent($room_id,$tenent_id,$rent_paid,$landlord_id,$building,$date,$payment_date,$desc)
	{    
        $uid = $_SESSION['Enron FZE']['userid'];
		//$tenent_id=($_REQUEST['tenent_id']);
		// echo $tenent_id;
        //print_r($_REQUEST);
       // die;
		$this->connectToDB();
		$table="tbl_rent_status";
		$insert="`fld_tanent_id`, `fld_rent_paid`, `fld_landlord_id`,`fld_date`,`fld_building_id`,`fld_paid_date`,`fld_collected_by`,`fld_income_type`,`fld_description`";
		$values=" $tenent_id,$rent_paid,$landlord_id,$date,$building,$payment_date,$uid,'rent',$desc";
		echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")"; 
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
		// echo $result;
		// die;
	}




	function UpdateRent($id,$rent,$balance)
	{
		$this->connectToDB();
		$sql="update `tbl_rent_status` set 
		`fld_rent_paid`=$rent,
		`fld_balance`=$balance
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}



	function getTanentById($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_tanents` WHERE `fld_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}



	function checkCurrentMonthRentStatusByID($id,$tanent_id)
	{
		$this->connectToDB();
		$date=date("Y-m");
		$sql="SELECT * from `tbl_rent_status` WHERE `fld_bedspace_id`='$id' AND `fld_date` LIKE '$date%' AND `fld_tanent_id`='$tanent_id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}



	
	function GetUniqueMonths()
	{
		$this->connectToDB();
		$sql="SELECT DISTINCT(`fld_date`) FROM `tbl_expense` WHERE 1";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	// function GetRecievedSummaryByMonth($date)
	// {
		// $this->connectToDB();
		// $sql=" SELECT * from `tbl_rent_status` WHERE `fld_date`='$date'";
		// $result=$this->CustomQuery($sql);
		// $this->DBDisconnect();
		// return $result;
	// }
	function GetRecievedSummaryByMonth($date,$id)
	{
		$this->connectToDB();
		$sql=" SELECT * from `tbl_rent_status` WHERE `fld_Paid_date` LIKE '$date%' AND `fld_room_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetRecievedSummaryByMonthAndTanent($date,$id)
	{
		$this->connectToDB();
		$sql=" SELECT * from `tbl_rent_status` WHERE `fld_date` = '$date' AND `fld_tanent_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetRecievedSummaryByMonthAndTanentAndRoom($date,$id,$room)
	{
		$this->connectToDB();
		$sql=" SELECT * from `tbl_rent_status` WHERE `fld_date`='$date' AND `fld_tanent_id`='$id' AND `fld_room_id`='$room'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetAllRooms()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_rooms` WHERE `fld_is_rented` <> '0'";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetAllRoom()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_rooms`";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetRoomsByOwnerRecievable($id)
	{
		$this->connectToDB();
        

		$sql="SELECT * from `tbl_rooms`
         INNER JOIN `tbl_bedspace` ON `tbl_bedspace`.`fld_room` = `tbl_rooms`.`fld_id`

		 WHERE (`tbl_bedspace`.`fld_is_notice`='1' OR `tbl_bedspace`.`fld_is_rented`='0')";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetAllRentedRoomsByBuildingId($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_rooms` WHERE `fld_is_rented` <> '0' AND `fld_building_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function TotalRecieved()
	{
		$this->connectToDB();
		$sql=" SELECT `fld_rent_paid` from `tbl_rent_status`";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function checkRecievableSummaryByMonth($id,$date)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_rent_status` WHERE `fld_date`='$date' AND `fld_tanent_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetRentSummaryByBuilding($id,$date)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_rent_status` WHERE `fld_date`='$date' AND `fld_building_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetRecievedSummaryMonthly($date)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_rent_status` WHERE `fld_date`='$date'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetRecievedSummaryMonthlyByOwner($date,$id)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_rent_status` WHERE `fld_date`='$date' AND `fld_landlord_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function AddExpense($expense_on,$expense_type,$expense,$description,$payment_to,$payment_by,$date,$chargeto,$assign_to)
	{
		$this->connectToDB();
		//die();
		//$date=date("Y-m");
		$table="tbl_expense";
		$insert="`fld_expense_on`, `fld_expense_type`, `fld_expense`, `fld_description`, `fld_date`, `fld_payment_to`, `fld_payment_by`,`fld_charge_to`,`is_approved`,`fld_assign_admin_id`";
		$values="$expense_on,$expense_type,$expense,$description,$date,$payment_to,$payment_by,$chargeto,'0',$assign_to";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
		function EditExpense($id,$expense_on,$expense_type,$expense,$description,$payment_to,$payment_by,$date,$chargeto)
	{
		 //print_r($_REQUEST);
		// $this->connectToDB();
		// //die();
		// //$date=date("Y-m");
		// $table="tbl_expense";
		// $insert="`fld_expense_on`, `fld_expense_type`, `fld_expense`, `fld_description`, `fld_date`, `fld_payment_to`,
		//  `fld_payment_by`,`fld_charge_to`,`is_approved`";
		// $values="$expense_on,$expense_type,$expense,$description,$date,$payment_to,$payment_by,$chargeto,'0'";
		// $sql= " update ".$table." set (".$insert.") VALUES (".$values.") WHERE `fld_id`='$id' ";exit;
		// $result=$this->CustomQuery($sql);
		// //$result = $this->InsertRecord($table,$insert,$values);
		// $this->DBDisconnect();
		// return $result;

		$this->connectToDB();
		$sql="update `tbl_expense` set 
		`fld_expense_on`=$expense_on,
		`fld_expense_type`=$expense_type,
		`fld_expense`=$expense,
		`fld_description`=$description,
		`fld_date`=$date,
		`fld_payment_to`=$payment_to,
		`fld_payment_by`=$payment_by,
		`fld_charge_to`=$chargeto
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function AddDewa($expense_on,$expense_type,$expense,$description,$payment_to,$payment_by,$date)
	{
		$this->connectToDB();
		//$date=date("Y-m");
		$table="tbl_expense";
		$insert="`fld_expense_on`, `fld_expense_type`, `fld_expense`, `fld_description`, `fld_date`, `fld_payment_to`, `fld_payment_by`";
		$values="$expense_on,$expense_type,$expense,$description,$date,$payment_to,$payment_by";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}

		function CreateTenenthistory($RoomId,$bedspace_id,$tenent_id)
	{
		$this->connectToDB();
		//$date=date("Y-m");
		$table="tbl_tenent_history";
		$insert="`fld_tenent_id`, `fld_room_id`, `fld_bedspace_id`, `fld_type` ";
		$values="$tenent_id,$RoomId,$bedspace_id,'0' ";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function GetRecievableGrandTotalByMonth($date,$id)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_rent_status` WHERE `fld_date`='$date' AND `fld_landlord_id`='$id' AND `fld_balance`<>'0'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetExpenseByMonthAndOwner($date,$id)
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_expense`.`fld_id` AS 'id',
		`tbl_expense`.`fld_expense_type` AS 'expense',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_expense`.`fld_expense_type` AS 'expense_type',
		`tbl_expense`.`fld_payment_to` AS 'payment_to',
		`tbl_expense`.`fld_expense` AS 'expense',
		`tbl_expense`.`fld_description` AS 'description'
		FROM
		`tbl_expense` INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_expense`.`fld_expense_on`
		WHERE `tbl_expense`.`fld_date` LIKE '%$date%'
		AND `tbl_building`.`fld_tanent`='$id'";
		//$sql="SELECT * FROM `tbl_expense` WHERE `fld_date`='$date'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetExpense($where)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_expense` WHERE $where";
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetExpenseByCondition($where,$type)
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_expense`.`fld_id` AS 'fld_id',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_expense`.`fld_expense_type` AS 'expense_type',
		`tbl_expense`.`fld_payment_to` AS 'payment_to',
		`tbl_expense`.`fld_expense_on` AS 'expense_on',
		`tbl_expense`.`fld_payment_by` AS 'payment_by',
		`tbl_expense`.`fld_expense` AS 'fld_expense',
		`tbl_expense`.`fld_description` AS 'description'
		FROM
		`tbl_expense` INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_expense`.`fld_expense_on`
		$where ORDER by `fld_expense`";
		$sql1="SELECT * FROM `tbl_expense` $where ORDER by `fld_expense`";
		//echo $sql; exit;
		if($type=="0")
		{
			//echo $sql1;exit;
			$result=$this->CustomQuery($sql1); 
		}
		else
		{
			//echo $sql;exit;
			$result=$this->CustomQuery($sql); 
		}
		$this->DBDisconnect();
		return $result;
	}
	function GetExpenseByMonth($date)
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_expense`.`fld_id` AS 'id',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_expense`.`fld_expense_type` AS 'expense_type',
		`tbl_expense`.`fld_payment_to` AS 'payment_to',
		`tbl_expense`.`fld_payment_by` AS 'payment_by',
		`tbl_expense`.`fld_expense` AS 'expense',
		`tbl_expense`.`fld_description` AS 'description'
		FROM
		`tbl_expense` INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_expense`.`fld_expense_on`
		WHERE `tbl_expense`.`fld_date`='$date'";
		//$sql="SELECT * FROM `tbl_expense` WHERE `fld_date`='$date'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetCommonPoolExpenseByMonth($date,$expense_type)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_expense` WHERE `fld_date`='$date' AND `fld_expense_on`='0' AND `fld_expense_type` LIKE '%$expense_type%'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function AddChqDetails($building,$owner,$chq_owner,$chq_date,$chq_num,$amount,$chq_date_till)
	{
		$this->connectToDB();
		//die("here");
		$table="tbl_chqs";
		$insert="`fld_building_id`, `fld_owner_id`, `fld_chq_owner`, `fld_chq_date`, `fld_chq_num`,`fld_chq_amount`,`fld_chq_date_till`";
		$values="$building,$owner,$chq_owner,$chq_date,$chq_num,$amount,$chq_date_till";
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function GetchqsyBuildingId($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_chqs` WHERE `fld_building_id`=$id";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetchqbyId($id)
	{	
		$this->connectToDB();
		$sql="SELECT * from `tbl_chqs` WHERE `fld_id`=$id";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetChqAmountForChqDetail($building,$month,$year)
	{
		$this->connectToDB();
		$date_parameter=$year."-".$month;
		if($building=="")
		{
			$sql="SELECT * from `tbl_chqs` WHERE `fld_chq_date` like '$date_parameter%'";
		}
		else
		{
			$sql="SELECT * from `tbl_chqs` WHERE `fld_building_id`='$building' AND `fld_chq_date` like '$date_parameter%'";
		}
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetSumOfChqAmountForChqDetailOwner($month,$year,$owner_id)
	{
		$this->connectToDB();
		$date_parameter=$year."-".$month;
		$sql="SELECT SUM(`fld_chq_amount`) AS 'amount' from `tbl_chqs` WHERE `fld_chq_date` like '$date_parameter%' AND `fld_owner_id`='$owner_id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetSumOfChqAmountForChqDetail($month,$year)
	{
		$this->connectToDB();
		$date_parameter=$year."-".$month;
		$sql="SELECT SUM(`fld_chq_amount`) AS 'amount' from `tbl_chqs` WHERE `fld_chq_date` like '$date_parameter%'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function updateChqById($id,$chq_owner,$chq_amount,$chq_date,$chq_date_till,$chq_num)
	{
		//`fld_chq_owner`=[value-4],`fld_chq_amount`=[value-5],`fld_chq_date`=[value-6],`fld_chq_date_till`=[value-7],`fld_chq_num`=[value-8]
		$this->connectToDB();
		$sql="update `tbl_chqs` set 
		`fld_chq_owner`=$chq_owner,
		`fld_chq_amount`=$chq_amount,
		`fld_chq_date`=$chq_date,
		`fld_chq_date_till`=$chq_date_till,
		`fld_chq_num`=$chq_num
		where fld_id=$id";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
		
	}
	function GetNumofChqsByBuildingId($id)
	{
		$this->connectToDB();
		$sql="SELECT `fld_num_of_chqs`,`fld_tanent`,`fld_num_of_beds`,`fld_building`,`fld_apt_no` FROM `tbl_building` WHERE `fld_id`=$id";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function getBuildingById($id)
	{
	
	 $this->connectToDB();



     $sql ="SELECT tbl_building.*,tbl_property_documents.fld_id as tbl_property_documents_id, tbl_property_documents.fld_name as image_name FROM tbl_building LEFT JOIN tbl_property_documents ON tbl_building.fld_id=tbl_property_documents.fld_property WHERE tbl_building.`fld_id`=$id";


		//$sql="SELECT * FROM `tbl_building` WHERE `fld_id`=$id";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}


	function GetRoomById($id)
	{
     

 	 $this->connectToDB();
         
     $sql ="SELECT tbl_rooms.*,tbl_rooms.window as wins,tbl_room_pics.fld_id as room_pics_id,tbl_room_pics.fld_name as image_name,COALESCE((SELECT count(tbl_bedspace.fld_room) FROM tbl_bedspace WHERE tbl_rooms.fld_id = tbl_bedspace.fld_room AND tbl_bedspace.fld_block_unblock=1))  AS total_bedspace FROM tbl_rooms LEFT JOIN tbl_room_pics ON tbl_rooms.fld_id=tbl_room_pics.fld_room_id WHERE tbl_rooms.`fld_id`=$id";
         //$sql = "SELECT `tbl_rooms`.* from tbl_rooms INNER"; 
		// $sql="SELECT `tbl_rooms`.*,`tbl_bedspace`.`fld_room`  FROM `tbl_rooms` 
		// 	  INNER JOIN `tbl_bedspace` ON `tbl_rooms`.`fld_id` = `tbl_bedspace`.`fld_room`
		// 	  WHERE `tbl_rooms`.`fld_id`=$id AND (`tbl_bedspace`.fld_is_rented=0 OR `tbl_bedspace`.`fld_is_notice`=1)
		// 	  GROUP BY `tbl_rooms`.`fld_id`";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
    
   

	function GetChqForDashboard()
	{
		$this->connectToDB();
		$sql="SELECT `tbl_building`.`fld_building` AS 'building',
						`tbl_building`.`fld_apt_no` AS 'apt'
						, `tbl_admin`.`fld_name` AS 'owner'
						, `tbl_chqs`.`fld_chq_owner` AS 'chq_owner'
						, `tbl_chqs`.`fld_chq_date` AS 'chq_date'
						, `tbl_chqs`.`fld_chq_num` AS 'chq_num',
						`tbl_chqs`.`fld_chq_amount` AS 'amount'
			FROM `tbl_admin`
			LEFT JOIN `tbl_building` ON `tbl_building`.`fld_tanent` = `tbl_admin`.`fld_id`
			LEFT JOIN `tbl_chqs` ON `tbl_building`.`fld_id`=`tbl_chqs`.`fld_building_id`
			 WHERE `tbl_chqs`.`fld_chq_date` >= NOW() AND `tbl_chqs`.`fld_chq_date` < NOW() + INTERVAL 1 MONTH";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	
	function GetChqForDashboards($month,$owner)
	{
		$this->connectToDB();
		$date=date("Y")."-".$month."%";
		$sql="SELECT `tbl_building`.`fld_building` AS 'building',
						`tbl_building`.`fld_apt_no` AS 'apt'
						, `tbl_admin`.`fld_name` AS 'owner'
						, `tbl_chqs`.`fld_chq_owner` AS 'chq_owner'
						, `tbl_chqs`.`fld_chq_date` AS 'chq_date'
						, `tbl_chqs`.`fld_chq_num` AS 'chq_num',
						`tbl_chqs`.`fld_chq_amount` AS 'amount'
			FROM `tbl_admin`
			LEFT JOIN `tbl_building` ON `tbl_building`.`fld_tanent` = `tbl_admin`.`fld_id`
			LEFT JOIN `tbl_chqs` ON `tbl_building`.`fld_id`=`tbl_chqs`.`fld_building_id`
			 WHERE 	`fld_chq_date` LIKE '$date' $owner ORDER by `fld_chq_date`";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetAllChqs()
	{
		$this->connectToDB();
		$sql="SELECT `tbl_building`.`fld_building` AS 'building',
						`tbl_building`.`fld_apt_no` AS 'apt'
						, `tbl_admin`.`fld_name` AS 'owner'
						, `tbl_chqs`.`fld_chq_owner` AS 'chq_owner'
						, `tbl_chqs`.`fld_chq_date` AS 'chq_date'
						, `tbl_chqs`.`fld_chq_num` AS 'chq_num',
						`tbl_chqs`.`fld_chq_amount` AS 'amount'
			FROM `tbl_admin`
			LEFT JOIN `tbl_building` ON `tbl_building`.`fld_tanent` = `tbl_admin`.`fld_id`
			LEFT JOIN `tbl_chqs` ON `tbl_building`.`fld_id`=`tbl_chqs`.`fld_building_id`
			";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function Renew_Contract($buildingid,$contract_start,$contract_end,$rent,$deposit,$comission,$num_of_chqs)
	{
		//`fld_id`, `fld_building_id`, `fld_contract_starting_date`, `fld_contract_ending_date`, `fld_rent`, `fld_deposit`, `fld_comission`, `fld_num_of_chqs`
		$this->connectToDB();
		$table = "tbl_contract_update";
		$insert = "`fld_building_id`, `fld_contract_starting_date`, `fld_contract_ending_date`, `fld_rent`, `fld_deposit`, `fld_comission`, `fld_num_of_chqs`";
		$values = "$buildingid,$contract_start,$contract_end,$rent,$deposit,$comission,$num_of_chqs";
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function update_renewed_building($id,$num_of_chqs,$rent,$deposit,$comission,$contract_start,$contract_end)
	{
		$this->connectToDB();
		$sql="update `tbl_building` set 
		`fld_contract_starting_date`=$contract_start,
		`fld_contract_ending_date`=$contract_end,
		`fld_rent`=$rent,
		`fld_deposit`=$deposit,
		`fld_comission`=$comission,
		`fld_num_of_chqs`=$num_of_chqs
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetVancancies()
	{

		

		$this->connectToDB();
		$sql="SELECT 
		`tbl_building`.`fld_area` AS 'area',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_id` AS 'building_id',
		`tbl_building`.`fld_apt_no` AS 'apt_no',		
		`tbl_building`.`fld_approved` AS 'approved',		
		`tbl_rooms`.`fld_room_name` AS 'room_name',
		`tbl_rooms`.`fld_id` AS 'room_id',
		`tbl_rooms`.`fld_custom_room_name` AS 'custom_room_name',
		`tbl_bedspace`.`fld_id` AS 'bedspace_id',
		`tbl_bedspace`.`fld_room` AS 'bedspace',
		`tbl_bedspace`.`fld_is_notice` AS 'notice',
		`tbl_bedspace`.`fld_is_rented` AS 'is_rented',
		`tbl_bedspace`.`fld_expected_rent` AS 'bedspace_expected_rent',
		`tbl_rooms`.`fld_id` AS 'room_id',
		`tbl_admin`.`fld_name` AS 'name',
		`tbl_rooms`.`fld_expected_rent` AS 'room_expected_rent'
		from `tbl_bedspace`
		INNER JOIN `tbl_rooms`
		ON `tbl_rooms`.`fld_id`=`tbl_bedspace`.`fld_room`
		INNER JOIN `tbl_building` 
		ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		INNER JOIN `tbl_admin`
		ON `tbl_building`.`fld_tanent`=`tbl_admin`.`fld_id`
		WHERE (`tbl_bedspace`.`fld_is_notice`='1' OR `tbl_bedspace`.`fld_is_rented`='0')
		
		AND `tbl_bedspace`.`fld_block_unblock`='1' order by `tbl_bedspace`.`fld_id` DESC";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		
		$this->DBDisconnect();
		return $result;
	}
	
	function DeleteExpenseById($id)
	{
		$this->connectToDB();
		$sql="delete from `tbl_expense` where `fld_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function PayDeposit($tanent,$deposit,$date,$collected_by,$desc)
	{
		$this->connectToDB();
		$table="tbl_deposit_in";
		$insert="`fld_tanent_id`, `fld_deposit`, `fld_date`, `fld_collected_by`, `fld_description`";
		$values="$tanent,$deposit,$date,$collected_by,$desc";
	    //echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function RefundDeposit($tanent,$deposit,$date,$refund_by,$desc)
	{
		$this->connectToDB();
		$table="tbl_deposit_out";
		$insert="`fld_tanent_id`, `fld_deposit`, `fld_date`, `fld_paid_by`, `fld_description`";
		$values="$tanent,$deposit,$date,$refund_by,$desc";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function getTanentByRoom($roomid)
	{
		$this->connectToDB();
		$sql="SELECT `tbl_tanents`.`fld_id` AS 'tanentid',
		`tbl_tanents`.`fld_name` AS 'tanentname',
		`tbl_tanents`.`fld_number` AS 'tanentnumber',
		`tbl_tanents`.`fld_email` AS 'tanentemail',
		`tbl_tanents`.`fld_move_in_date` AS 'tanentmovein',
		`tbl_tanents`.`fld_deposit` AS 'tanentdeposit',
		`tbl_rooms`.`fld_room_name` AS 'roomname',
		`tbl_rooms`.`fld_rent` AS 'tenantrent',
		`tbl_rooms`.`fld_is_rented` AS 'isrented'
		FROM `tbl_tanents`
		LEFT JOIN
		`tbl_rooms` ON `tbl_rooms`.`fld_tanent`=`tbl_tanents`.`fld_id`
		WHERE `tbl_rooms`.`fld_id`=$roomid";
	//	echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function getTanentByRoomS($roomid)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_tanents` WHERE `fld_room`='$roomid' AND `fld_is_current_tanent` !='0'";
	//	echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	// On condition 1
	function VacatRoom($id)
	{	
		$this->connectToDB();
		$sql="update `tbl_rooms` set 
		`fld_is_notice`='0',
		`fld_is_rented`='0',
		`fld_tanent`='0'
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	// On condition 2
	function VacatRoom2($id)
	{	
		$this->connectToDB();
		$sql="update `tbl_rooms` set 
		`fld_is_notice`='0',
		`fld_is_rented`='1'
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetDepositInByOwner($id,$date)
	{
		$this->connectToDB();
		$sql="SELECT `tbl_deposit_in`.`fld_deposit` AS 'deposit',
		`tbl_tanents`.`fld_name` AS 'tanentname',
		`tbl_rooms`.`fld_room_name` AS 'roomname',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_admin`.`fld_name` AS 'ownername'
		FROM `tbl_deposit_in`
		LEFT JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_deposit_in`.`fld_tanent_id`
		LEFT JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
		LEFT JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		LEFT JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`
		WHERE `tbl_admin`.`fld_id`=$id
		AND `tbl_deposit_in`.`fld_date` LIKE '$date%'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 

		$this->DBDisconnect();
		return $result;
	}
	function GetDepositOutByOwner($id,$date)
	{
		$this->connectToDB();
		$sql="SELECT `tbl_deposit_out`.`fld_deposit` AS 'deposit',
		`tbl_tanents`.`fld_name` AS 'tanentname',
		`tbl_rooms`.`fld_room_name` AS 'roomname',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_admin`.`fld_name` AS 'ownername'
		FROM `tbl_deposit_out`
		LEFT JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_deposit_out`.`fld_tanent_id`
		LEFT JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
		LEFT JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		LEFT JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`
		WHERE `tbl_admin`.`fld_id`=$id
		AND `tbl_deposit_out`.`fld_date` LIKE '$date%'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}



	function AddRoomPicsById($roomid,$pic)
	{  
				$this->connectToDB();

		$table="tbl_room_pics";
		//$insert="`fld_building_id`,`fld_room_name` ,`fld_is_notice`, `fld_is_rented`, `fld_tanent`,`fld_owner`";
		$insert="`fld_room_id`,`fld_name`";
		$values="$roomid,$pic";
		$result = $this->InsertRecord($table,$insert,$values);
        echo "INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";
		$this->DBDisconnect();
		return $result;
	}


	function AddPropertyPicsById($propertyid,$pic)
	{  
  //       print_r($propertyid);
		// print_r($_FILES['image']['name']);
		// echo "in db";
		// die;
		$this->connectToDB();

		$table="tbl_property_documents";
		//$insert="`fld_building_id`,`fld_room_name` ,`fld_is_notice`, `fld_is_rented`, `fld_tanent`,`fld_owner`";
		$insert="`fld_property`,`fld_name`";
		$values="$propertyid,$pic";
		$result = $this->InsertRecord($table,$insert,$values);
         
		$this->DBDisconnect();
		return $result;
	}

		function update_profile($name,$email,$number,$id,$occupantpic)
	{  
 
		$this->connectToDB();
		$sql="update `tbl_admin` set 
		`fld_name`=$name,	
		`fld_profile_pic`=$occupantpic,	
		`fld_email`=$email,	
		`fld_number`=$number	
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

			function update_contract($id,$contract_pic)
	{  
		$this->connectToDB();
		$sql="update `tbl_sub_tanents` set 
		`fld_contract_image`=$contract_pic	
		where fld_tanent_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}


	function DeletePicsById($image_id)
	{  
		$this->connectToDB();
		$sql="delete from `tbl_room_pics` where `fld_id`=$image_id";
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
		function DeletebuildingPicsById($image_id)
	{  
		$this->connectToDB();
		$sql="delete from `tbl_property_documents` where `fld_id`=$image_id";
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
    

    function DeletePropertyImageById($image_id)
	{  
		$this->connectToDB();
		$sql="delete from `tbl_property_documents` where `fld_id`=$image_id";
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}


  


  

	/*function UpdateRoomInfo($request_data)
	{   

		echo "<pre/>";
		print_r()
        $roomid=base64_decode($request_data['room']);
		$this->connectToDB();
		$sql = "UPDATE tbl_rooms SET balconices = '".$_REQUEST['balconices']."' , metro_train='".$_REQUEST['metro_train']."',
		        occupancy= '".$_REQUEST['occupancy']."',gender= '".$_REQUEST['gender']."'  WHERE fld_id = '".$roomid."'";
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
*/

	function getpropPicByRoomId($id)
	{
		$this->connectToDB();
		$sql="SELECT DISTINCT `tbl_property_documents`.`fld_name` AS propertyImage from `tbl_room_pics` INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_id` = `tbl_room_pics`.`fld_room_id` INNER JOIN `tbl_property_documents` ON `tbl_property_documents`.`fld_property`=`tbl_rooms`.`fld_building_id` WHERE `fld_room_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}


	function getRoomPicByRoomId($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_room_pics` WHERE `fld_room_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetUtilitiesStatus($apt,$payment_to,$date)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_expense` WHERE `fld_expense_on`=$apt AND `fld_payment_to`='$payment_to' AND `fld_date` LIKE '$date%'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetAllTanents()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_tanents`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
		function GetRooms()
	{
		$this->connectToDB();
		$sql="SELECT `tbl_rooms`.*, `tbl_building`.`fld_building` AS Building, `tbl_admin`.`fld_name` AS Admin, `tbl_bedspace`.`fld_id` AS bedspace_id from `tbl_rooms` INNER JOIN `tbl_building` ON `tbl_rooms`.`fld_building_id`= `tbl_building`.`fld_id` INNER JOIN `tbl_admin` ON `tbl_rooms`.`fld_owner`= `tbl_admin`.`fld_id` INNER JOIN `tbl_bedspace` ON `tbl_rooms`.`fld_id` = `tbl_bedspace`.`fld_room` WHERE (`tbl_bedspace`.`fld_is_rented`=0 OR `tbl_bedspace`.`fld_is_notice`=1) AND `tbl_bedspace`.`fld_block_unblock`=1 GROUP BY `tbl_rooms`.`fld_id`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}

			function GetBookedRooms()
	{
		$this->connectToDB();
		$sql="SELECT `tbl_rooms`.`fld_id`, `tbl_bedspace`.`fld_is_notice`, `tbl_bedspace`.`fld_is_rented`, `tbl_bedspace`.`fld_block_unblock` FROM `tbl_rooms` INNER JOIN `tbl_bedspace` ON `tbl_bedspace`.`fld_room`=`tbl_rooms`.`fld_id` WHERE (`tbl_bedspace`.`fld_is_rented`=1) AND `tbl_bedspace`.`fld_block_unblock`=1 GROUP BY `tbl_rooms`.`fld_id`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}


	function GetrentTotalByMonth($id,$date)
	{
		$this->connectToDB();
		$sql="SELECT sum(`fld_rent_paid`) AS 'rent' FROM  `tbl_rent_status`  WHERE `fld_landlord_id`=$id AND `fld_date`='$date'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}

		function GetUnapprovedNotice()
	{
		//die("sjdgh");
		$this->connectToDB();
		$sql="SELECT * FROM  `tbl_notice` 
        INNER JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_notice`.`tenent_id`
		  WHERE `status`='0' ORDER BY id DESC ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetrentTotalByMonthandAppartment($id)
	{
		$this->connectToDB();
		//$date=date("Y-m");
		$sql="SELECT sum(`fld_rent_paid`) AS 'rent' FROM  `tbl_rent_status`  WHERE `fld_building_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		//print_r($result); die;
		$this->DBDisconnect();
		return $result;
	}
	function GetDepositTotalByMonthandAppartment($id)
	{
		$this->connectToDB();
		$date=date("Y-m");
		$sql="SELECT sum(`fld_deposit_in`) AS 'rent' FROM  `tbl_deposit_in`  WHERE `fld_building_id`=$id AND `fld_date` LIKE '$date%'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetDepoitTotalByMonth($id)
	{

		$this->connectToDB();
		//$date=date("Y-m");
		$sql="SELECT sum(`tbl_deposit_in`.`fld_deposit`) AS 'deposit_in'
		FROM `tbl_deposit_in`
		LEFT JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_deposit_in`.`fld_tanent_id`
		LEFT JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
		LEFT JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		LEFT JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`
		WHERE `tbl_building`.`fld_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 

		$this->DBDisconnect();
		return $result;
	}
	function GetBreakDownForCashFlowByTanentandDate($date,$tanent)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_rent_status` WHERE `fld_paid_date` LIKE '$date%' AND `fld_tanent_id`='$tanent'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetDepoitoutTotalByMonth($id)
	{
		$this->connectToDB();
		$date=date("Y-m");
		$sql="SELECT sum(`tbl_deposit_out`.`fld_deposit`) AS 'deposit_out'
		FROM `tbl_deposit_out`
		LEFT JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_deposit_out`.`fld_tanent_id`
		LEFT JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
		LEFT JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		LEFT JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`
		WHERE `tbl_building`.`fld_id`=$id";
		//AND `tbl_deposit_out`.`fld_date` LIKE '$date%'
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		
		$this->DBDisconnect();
		return $result;
	}
	function GetCurrentExpenseByApt($id)
	{
		$this->connectToDB();
		$date=date("Y-m");
		//$sql="SELECT sum(`fld_expense`) AS 'expense' FROM `tbl_expense` WHERE `fld_expense_on`='$id' AND `fld_date` LIKE '$date%'";
		$sql="SELECT sum(`fld_expense`) AS 'expense' FROM `tbl_expense` WHERE `fld_expense_on`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 

		$this->DBDisconnect();
		return $result;
	}
	function GetCurrentTanentsId()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_rooms`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetRentStatusOfCurrentMonth($id)
	{
		$this->connectToDB();
		$current_month=date("Y-m");
		$sql="SELECT SUM(fld_rent_paid) AS 'rent' FROM `tbl_rent_status` WHERE `fld_date`='$current_month' AND `fld_tanent_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function UploadDocuments($property,$custom_name,$file_name)
	{
		$this->connectToDB();
		$table = "tbl_property_documents";
		$insert = " `fld_property`, `fld_custom_name`, `fld_name`";
		$values = "$property,$custom_name,$file_name";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function AddBeneficiary($name,$addBy)
	{
		$this->connectToDB();
		$table="tbl_beneficiary";
		//$insert="`fld_building_id`,`fld_room_name` ,`fld_is_notice`, `fld_is_rented`, `fld_tanent`,`fld_owner`";
		$insert="`fld_name`,`fld_added_by`";
		$values="$name,$addBy";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;	
	}
	function GetAllBeneficiary()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_beneficiary`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetRentStatusByCollectedBy($collected_by)
	{	
		$this->connectToDB();
		$sql="SELECT * from `tbl_rent_status` WHERE `fld_collected_by` = '$collected_by'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetDepositinByCollectedBy($collected_by)
	{	
		$this->connectToDB();
		$sql="SELECT * from `tbl_deposit_in` WHERE `fld_collected_by` = '$collected_by'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetDepositoutBypaidBy($paidby)
	{	
		$this->connectToDB();
		$sql="SELECT * from `tbl_deposit_out` WHERE `fld_paid_by` = '$paidby'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetExpenseBypaidBy($paidby)
	{	
		$this->connectToDB();
		$sql="SELECT * from `tbl_expense` WHERE `fld_payment_by` = '$paidby'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetTransin($transin)
	{	
		$this->connectToDB();
		$sql="SELECT * from `tbl_transactions` WHERE `fld_payment_to` = '$transin'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetTransout($transout)
	{	
		$this->connectToDB();
		$sql="SELECT * from `tbl_transactions` WHERE `fld_payment_by` = '$transout'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function AddTransaction($form,$to,$date,$description,$payment,$tby)
	{
		$this->connectToDB();
		$table="tbl_transactions";
		//$insert="`fld_building_id`,`fld_room_name` ,`fld_is_notice`, `fld_is_rented`, `fld_tanent`,`fld_owner`";
		$insert="`fld_payment_by`, `fld_payment_to`, `fld_payment_date`, `fld_description`, `fld_payment`, `fld_transaction_by`";
		$values="$form,$to,$date,$description,$payment,$tby";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function GetAllTransactions()
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_transactions` WHERE 1";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetAllTransactionByFilters($from,$to)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_transactions` WHERE (`fld_payment_by`='$from' AND `fld_payment_to`='$to') or (`fld_payment_by`='$to' AND `fld_payment_to`='$from')";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
		function GetAllTransactionByID($from,$to)
	{
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_transactions` WHERE (`fld_payment_by`='$from' AND `fld_payment_to`='$to') or (`fld_payment_by`='$to' AND `fld_payment_to`='$from') AND `fld_transaction_by`= '$uid' ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetAllTransactionByDateFilters($from,$to)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_transactions` WHERE `fld_payment_date`>='$from' AND `fld_payment_date`<='$to'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	/*Recent Activities*/
	function GetExpenseForRecentActivities($where)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_expense` $where order by `fld_id` DESC LIMIT 10";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	/*Recent Activities*/
	
	/*Expense Filters*/
	function GetAllExpensesByCondition($where)
	{
		
		$this->connectToDB();
		$sql="SELECT * from `tbl_expense` $where order by `fld_date`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	
	}
	function GetDistinctExpenseOn()
	{
		$this->connectToDB();
		$sql="SELECT DISTINCT(`fld_expense_on`) FROM `tbl_expense` WHERE 1";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetDistinctExpenseType()
	{
		$this->connectToDB();
		$sql="SELECT DISTINCT(`fld_expense_type`) FROM `tbl_expense` WHERE 1";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	/*Expense Filters*/
	
	/*Get Recovery Status Start*/
	function GetRecoveryofCurrentMonth()
	{
		$this->connectToDB();
		$sql="";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	/*Get Recovery Status End*/
	
	/*Extraction */
	function ExpenseFilter($from,$to)
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_expense`.`fld_date` AS 'date',
        `tbl_admin`.`fld_name` AS 'name',
		`tbl_expense`.`fld_expense_type` AS 'expense_type',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_expense`.`fld_payment_to` AS 'payment_to',
		`tbl_expense`.`fld_payment_by` AS 'payment_by',
		`tbl_expense`.`fld_expense` AS 'expense',
		`tbl_expense`.`fld_description` AS 'description'
		FROM
		`tbl_expense` INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_expense`.`fld_expense_on`
        INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`
		WHERE `tbl_expense`.`fld_date` >= '$from' AND `tbl_expense`.`fld_date` <= '$to'
		";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function CommonPoolExpenseFilter($from,$to)
	{
		$this->connectToDB();
		
		$sql="SELECT
		`tbl_expense`.`fld_date` AS 'date',
		`tbl_expense`.`fld_expense_type` AS 'expense_type',
		`tbl_expense`.`fld_payment_to` AS 'payment_to',
		`tbl_expense`.`fld_payment_by` AS 'payment_by',
		`tbl_expense`.`fld_expense` AS 'expense',
		`tbl_expense`.`fld_charge_to` AS 'owner',
		`tbl_expense`.`fld_description` AS 'description'
		FROM `tbl_expense`
		WHERE `tbl_expense`.`fld_date` >= '$from' AND `tbl_expense`.`fld_date` <= '$to' AND `tbl_expense`.`fld_expense_on`='0'";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function DepositinFilter($from,$to)
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_deposit_in`.`fld_date` AS 'date',
		`tbl_admin`.`fld_name` AS 'name',
		`tbl_deposit_in`.`fld_deposit` AS 'amount',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_tanents`.`fld_name` AS 'client',
		`tbl_deposit_in`.`fld_collected_by` AS 'collected_by',
		`tbl_deposit_in`.`fld_description` AS 'description',
		`tbl_rooms`.`fld_custom_room_name` AS 'room_name'
		FROM
		`tbl_deposit_in` INNER JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_deposit_in`.`fld_tanent_id`
		INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_id`=`tbl_tanents`.`fld_room`
		INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`
		WHERE `tbl_deposit_in`.`fld_date` >= '$from' AND `tbl_deposit_in`.`fld_date` <= '$to'
		
		";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function DepositOutFilter($from,$to)
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_deposit_out`.`fld_date` AS 'date',
		`tbl_admin`.`fld_name` AS 'name',
		`tbl_deposit_out`.`fld_deposit` AS 'amount',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_tanents`.`fld_name` AS 'client',
		`tbl_deposit_out`.`fld_paid_by` AS 'paid',
		`tbl_deposit_out`.`fld_description` AS 'description',
		`tbl_rooms`.`fld_custom_room_name` AS 'room_name'
		FROM
		`tbl_deposit_out` INNER JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_deposit_out`.`fld_tanent_id`
		INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_id`=`tbl_tanents`.`fld_room`
		INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`
		WHERE `tbl_deposit_out`.`fld_date` >= '$from' AND `tbl_deposit_out`.`fld_date` <= '$to'
		
		";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function IncomeFilter($from,$to)
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_rent_status`.`fld_paid_date` AS 'paid_date',
		`tbl_rent_status`.`fld_date` AS 'date',
		`tbl_admin`.`fld_name` AS 'name',
		`tbl_rent_status`.`fld_rent_paid` AS 'amount',
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_id` AS 'building_id',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_tanents`.`fld_name` AS 'client',
		`tbl_rent_status`.`fld_collected_by` AS 'collected_by',
		`tbl_rent_status`.`fld_description` AS `description`,
		`tbl_rooms`.`fld_custom_room_name` AS 'room_name'
		FROM `tbl_rent_status`
		INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rent_status`.`fld_building_id`
		INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`
        INNER JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_rent_status`.`fld_tanent_id`
		INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_id`=`tbl_tanents`.`fld_room`
		WHERE `tbl_rent_status`.`fld_paid_date` >= '$from' AND `tbl_rent_status`.`fld_paid_date` <= '$to'
		";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function AddExpenseType($expense_type)
	{
		$this->connectToDB();
		$table="tbl_expense_type";
		$insert="`fld_expense_type`";
		$values="$expense_type";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function GetExpenseType()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_expense_type`";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function DeleteExpenseTypebyId($id)
	{
		$this->connectToDB();
		$sql="delete from `tbl_expense_type` where `fld_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetUniquePayBy()
	{
		$this->connectToDB();
		$sql="SELECT DISTINCT(`fld_payment_by`) AS 'payby' FROM `tbl_expense` WHERE 1";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetTransfer($from,$to)
	{
		$this->connectToDB();
		$sql="SELECT *  FROM `tbl_transactions` WHERE `fld_payment_date` >= '$from' AND `fld_payment_date` <= '$to'";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetUniquePayto()
	{
		$this->connectToDB();
		$sql="SELECT DISTINCT(`fld_payment_to`) AS 'payto' FROM `tbl_expense` WHERE 1";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}



     function GetUnapprovedBooking()
	{
		$this->connectToDB();
		$sql = "SELECT `tbl_bedspace`.*, `tbl_rooms`.`fld_room_name` AS RoomName, `tbl_rooms`.`fld_custom_room_name` AS CustomRoomName,
		`tbl_building`.`fld_area`  AS Area,`tbl_building`.`fld_building`  AS BuildingName, `tbl_tanents`.`fld_name` AS tenent_name, `tbl_tanents`.`fld_move_in_date`

		from `tbl_bedspace` 
        INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_id` = `tbl_bedspace`.`fld_room`
        INNER JOIN `tbl_building` ON `tbl_building`.`fld_id` = `tbl_bedspace`.`fld_building_id`
        INNER JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id` = `tbl_bedspace`.`fld_tanent_id`
		WHERE `tbl_bedspace`.`is_booking_verified`='0' AND `tbl_bedspace`.`fld_is_rented`='1'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

     function GetUnapprovedClient()
	{
		$this->connectToDB();
		$sql = "SELECT `tbl_tanents`.*, `tbl_building`.`fld_building`,`tbl_building`.`fld_area`, `tbl_rooms`.`fld_room_name`,`tbl_rooms`.`fld_custom_room_name` FROM `tbl_tanents` INNER JOIN `tbl_rooms`ON `tbl_rooms`.`fld_id`= `tbl_tanents`.`fld_room` INNER JOIN `tbl_building` ON `tbl_building`.`fld_id` = `tbl_rooms`.`fld_building_id` WHERE `fld_is_setup_done`='1' AND `fld_is_approved`='0' ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

	   function GetUnappClient($id)
	{

		$this->connectToDB();
		$sql = "SELECT * FROM `tbl_tanents` INNER JOIN `tbl_rooms`ON `tbl_rooms`.`fld_id`= `tbl_tanents`.`fld_room` 
		LEFT JOIN `tbl_building` ON `tbl_building`.`fld_id` = `tbl_rooms`.`fld_building_id`
		LEFT JOIN `tbl_sub_tanents` ON `tbl_tanents`.`fld_id` = `tbl_sub_tanents`.`fld_tanent_id`
		LEFT JOIN `tbl_bedspace` ON `tbl_tanents`.`fld_id` = `tbl_bedspace`.`fld_tanent_id`
		 WHERE `fld_is_setup_done`='1' AND `fld_is_approved`='0' AND `tbl_tanents`.`fld_id`='$id' LIMIT 1 ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

	   function GetALLClientBYid($id)
	{

		$this->connectToDB();
		$sql = "SELECT * FROM `tbl_tanents` INNER JOIN `tbl_rooms`ON `tbl_rooms`.`fld_id`= `tbl_tanents`.`fld_room` 
		LEFT JOIN `tbl_building` ON `tbl_building`.`fld_id` = `tbl_rooms`.`fld_building_id`
		LEFT JOIN `tbl_sub_tanents` ON `tbl_tanents`.`fld_id` = `tbl_sub_tanents`.`fld_tanent_id`
		LEFT JOIN `tbl_bedspace` ON `tbl_tanents`.`fld_id` = `tbl_bedspace`.`fld_tanent_id`
		 WHERE `tbl_tanents`.`fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

	// 	   function GetAllClientdocs($start_from, $limit)
	// {

	// 	$this->connectToDB();
	// 	$sql = "SELECT `tbl_tanents`.`fld_name`,`tbl_tanents`.`fld_actual_name`,`tbl_tanents`.`fld_id`,`tbl_tanents`.`fld_is_current_tanent`,`tbl_tanents`.`fld_email` AS tenent_email, `tbl_sub_tanents`.*  FROM `tbl_tanents` 
	// 	 LEFT JOIN `tbl_sub_tanents` ON `tbl_tanents`.`fld_id`= `tbl_sub_tanents`.`fld_tanent_id` 
 //         ORDER BY `tbl_sub_tanents`.`fld_id` ASC LIMIT $start_from, $limit
	// 	  ";
	// 	//echo $sql;exit;
	// 	$result=$this->CustomQuery($sql);
	// 	$this->DBDisconnect();
	// 	return $result;
	// }   

		   function GetAllClientdocs()
	{

		$this->connectToDB();
		$sql = "SELECT `tbl_tanents`.`fld_name`,`tbl_tanents`.`fld_actual_name`,`tbl_tanents`.`fld_id`,`tbl_tanents`.`fld_is_current_tanent`,`tbl_tanents`.`fld_email` AS tenent_email,`tbl_tanents`.`fld_number` AS tanent_num,`tbl_tanents`.`fld_whatsapp_no` AS tanent_whatsapp, `tbl_sub_tanents`.*, `tbl_rooms`.`fld_custom_room_name`, `tbl_building`.`fld_area`, `tbl_building`.`fld_building`   FROM `tbl_tanents` 
		 LEFT JOIN `tbl_sub_tanents` ON `tbl_tanents`.`fld_id`= `tbl_sub_tanents`.`fld_tanent_id`
		 LEFT JOIN `tbl_bedspace` ON `tbl_tanents`.fld_id = `tbl_bedspace`.`fld_tanent_id` 
		 LEFT JOIN `tbl_rooms` ON `tbl_bedspace`.`fld_room`= `tbl_rooms`.`fld_id`
		 LEFT JOIN `tbl_building` ON `tbl_bedspace`.`fld_building_id` = `tbl_building`.`fld_id`
          WHERE `tbl_bedspace`.`fld_block_unblock`=1 ORDER BY `tbl_sub_tanents`.`fld_id` DESC";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

		function search_all_clients($data)
	{
		$this->connectToDB();
		$sql = "SELECT `tbl_tanents`.`fld_name`,`tbl_tanents`.`fld_actual_name`,`tbl_tanents`.`fld_id`,`tbl_tanents`.`fld_is_current_tanent`,`tbl_tanents`.`fld_email` AS tenent_email, `tbl_sub_tanents`.*  FROM `tbl_tanents` 
		 LEFT JOIN `tbl_sub_tanents` ON `tbl_tanents`.`fld_id`= `tbl_sub_tanents`.`fld_tanent_id` 
		 WHERE `tbl_tanents`.`fld_email` like $data OR `tbl_tanents`.`fld_name` like $data OR `tbl_tanents`.`fld_number` like $data
         ORDER BY `tbl_sub_tanents`.`fld_id` ASC LIMIT $start_from, $limit
		  ";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}


		   function countAllClientdocs()
	{

		$this->connectToDB();
		  $sql = "SELECT COUNT(fld_id) as counting_data FROM tbl_sub_tanents";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

	function getRecovery($id)
	{
		$this->connectToDB();
		$sql="SELECT `tbl_building`.`fld_building` AS 'building',
		`tbl_admin`.`fld_name` AS 'owner',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_rooms`.`fld_custom_room_name` AS 'room',
		`tbl_tanents`.`fld_name` AS 'tanents',
		`tbl_tanents`.`fld_number` AS 'num'
		FROM `tbl_tanents` INNER JOIN `tbl_rooms`
		ON `tbl_tanents`.`fld_id`=`tbl_rooms`.`fld_tanent` 
		INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		INNER JOIN `tbl_admin` ON `tbl_building`.`fld_tanent`=`tbl_admin`.`fld_id`
		WHERE `tbl_tanents`.`fld_id`='$id'";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetTenents()
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_tanents`.`fld_name` AS 'tenent',
		`tbl_rooms`.`fld_room_name` AS 'room',
		`tbl_tanents`.`fld_rent` AS 'rent',
		`tbl_tanents`.`fld_deposit` AS 'deposit',
		`tbl_admin`.`fld_name` AS 'owner'
		FROM `tbl_building` INNER JOIN `tbl_rooms` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		INNER JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_rooms`.`fld_tanent`
		INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetAllRoomsforReport()
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_building`.`fld_building` AS 'building',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_rooms`.`fld_id` AS 'id',
		`tbl_rooms`.`fld_room_name` AS 'room',
		`tbl_admin`.`fld_name` AS 'owner'
		FROM `tbl_rooms` INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_building`.`fld_tanent`";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}



	/*Extraction */
	function Addlog($tbl_id,$tbl_name,$action,$edit_delete)
	{
		$this->connectToDB();
		$table="tbl_log";
		$insert="`fld_tbl_id`, `fld_tbl_name`, `fld_action`, `fld_edit_delete_entry`";
		$values="$tbl_id,$tbl_name,$action,$edit_delete";
//		echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}

	
	
	function updateTenanatsbedspace()
	{
		$this->connectToDB();
		$sql="Update `tbl_tanents` set `fld_bedspace`='$bedspace' WHERE `fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function GetTanents()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_tanents`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
		function GetTanentsByowner()
	{
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="SELECT * from `tbl_tanents` 
        INNER JOIN `tbl_rooms` ON   `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
        WHERE 	`tbl_rooms`.`fld_owner` ='$uid'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	/*New Code on 14/03/2018*/
	
	function blockunblockbedspace($id,$bedspace)
	{
		$this->connectToDB();
		$sql="Update `tbl_bedspace` set `fld_is_bedspace`='$bedspace' WHERE `fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetBedspacess()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_bedspace`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetBedspaceByTenant($tenantId)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_bedspace` WHERE `fld_tanent_id`='$tenantId'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetComplaints()
	{
		$this->connectToDB();
		$sql="SELECT DISTINCT `tbl_complaints`.*, `tbl_sub_complaints`.`assigned_to` AS assigned from `tbl_complaints` INNER JOIN `tbl_sub_complaints` ON `tbl_complaints`.`fld_id` = `tbl_sub_complaints`.`fld_complaint_id` WHERE `tbl_sub_complaints`.`assigned_to` =0 ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

		function GetComplaintById($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_complaints` WHERE `fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
		function getSubComplaintsByComplaint($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_sub_complaints` WHERE `fld_complaint_id`='$id' AND `tbl_sub_complaints`.`assigned_to` = 0 ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

	function GetUnapprovedData()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_building` where `fld_approved` = '0'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);

		$this->DBDisconnect();
		return $result;
	}

	function updateComplainStatus()
	{
		
         // print_r($_REQUEST);
	      //die("sdgksdjg");
       $uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
	
      //  $date1  = date('Y-m-d',strtotime($_POST['date_assigned']));
 
      //  echo $date1;
      // die;
		$sql="update `tbl_sub_complaints` set 
		`assigned_to` = '".$_REQUEST['admin_id']."',
		`assigned_by` = '".$uid."',
		`assigned_on` = '".$_REQUEST['date']."'
		where `fld_id`= '".$_REQUEST['field_id']."'";
		//echo $sql;exit;

		// print_r($sql);
		// die;
		$result=$this->CustomQuery($sql);


		$this->DBDisconnect();
		return $result;
	}

	function ComplainsAssigned()
	{

		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="update `tbl_sub_complaints` set
		`status`= '1',
		`fld_is_resolved_by`= ' ".$uid." ',
		`remarks`= '".$_REQUEST['remarks']."' 
		WHERE `fld_id`='".$_REQUEST['field_id']."' 
		AND `fld_complaint_id`='".$_REQUEST['complain_id']."'  ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);

		$this->DBDisconnect();
		return $result;
	}
     
     function getadminname()
     {
     	
     	$this->connectToDB();
		$sql="SELECT * from `tbl_admin` ";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);

		$this->DBDisconnect();
		return $result;
     }

		function GetUnapprovedExpenseData()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_expense` where `is_approved` = '0'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
			function GetDisapprovedExpenseData()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_expense` where `is_approved` = '2'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
			function GetUnapprovedRentData()
	{
		$this->connectToDB();
		$sql="SELECT `tbl_tanents`.`fld_name` As `tenent_name`, `tbl_admin`.`fld_name` As `admin_name`, `tbl_rent_status`.*, `tbl_building`.`fld_area` As `building_area`,`tbl_building`.`fld_building` As `building_name`  from `tbl_rent_status`
	     INNER JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_rent_status`.`fld_tanent_id`
	     INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_rent_status`.`fld_landlord_id`
	     INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rent_status`.`fld_building_id`
		 where `tbl_rent_status`.`status` = '0'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}


	function GetBuildingByRoomId($id)
	{
		$this->connectToDB();
		$sql="SELECT `tbl_building`.`fld_building` AS 'bname',
				`tbl_building`.`fld_apt_no` AS 'aptno', `tbl_property_documents`.`fld_name` as property_documents_image	
		FROM `tbl_building` LEFT JOIN `tbl_rooms` ON `tbl_rooms`.`fld_building_id`=`tbl_building`.`fld_id` 
        LEFT JOIN `tbl_property_documents` ON `tbl_property_documents`.`fld_property`= `tbl_building`.`fld_id`
		WHERE `tbl_rooms`.`fld_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		/*echo "<pre/>";
		print_r($result);
		die;*/
		$this->DBDisconnect();
		return $result;
	}

	function GetSubComplaintById($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_sub_complaints` WHERE `fld_id`='$id'";
		// echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function getChatByComplaint($complaintId)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_chats` WHERE `fld_sub_complain_id`='$complaintId'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function getAdminNamebyId($id)
	{
		$this->connectToDB();
		$sql="SELECT `fld_name` from `tbl_admin` WHERE `fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function addComment($subcomplain,$sender,$senderid,$message)
	{
		$this->connectToDB();
		$table = "tbl_chats";
		$insert = "`fld_sub_complain_id`, `fld_sender`, `fld_sender_id`, `fld_message`";
		$values = "'$subcomplain','$sender','$senderid','$message'";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function GetRoles()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_roles` WHERE `fld_id` <=7";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
		function getallassignedroles($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_role_assign` WHERE `fld_admin_id` =$id";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetAllRoles()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_roles` WHERE `fld_id` !=8";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	//`fld_name`, `fld_number`, `fld_email`
	
	function AddUser($name,$officialName,$number,$email,$createdby)
	{
		//die("in db manager");
		$this->connectToDB();
		$table="tbl_admin";
		$insert="`fld_name`, `fld_number`, `fld_email`,`fld_official_name`,`fld_created_by`,`fld_password`";
		$values="$name,$number,$email,$officialName,$createdby,'c0627649924ac6c9bb0ab1d3db1b1cea:d3'";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
		function deletePreviousRole($userid)
	{   
		//echo $userid;
	    $this->connectToDB();
		$sql="DELETE FROM `tbl_role_assign` WHERE `fld_admin_id`=$userid";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
			function EditRole($userid,$role)
	{   
	   $this->connectToDB();
		$table="tbl_role_assign";
		$insert="`fld_admin_id`, `fld_role`";
		$values="$userid,$role";
//		echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function AddRoletoUser($userid,$role)
	{
		$this->connectToDB();
		$table="tbl_role_assign";
		$insert="`fld_admin_id`, `fld_role`";
		$values="$userid,$role";
//		echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function AddAccessToSummary($admin,$giveaccess)
	{
		$this->connectToDB();
		$table="tbl_summary_access";
		$insert="`fld_admin_id`, `fld_admin_to_give_access`";
		$values="$admin,$giveaccess";
//		echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function GetRoleByUser($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_role_assign` WHERE `fld_admin_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetTenantForApproval()
	{
		$this->connectToDB();
		$sql="SELECT 
		`tbl_tanents`.`fld_actual_name` AS 'name',
		`tbl_rooms`.`fld_custom_room_name` AS 'room_name',
		`tbl_building`.`fld_building` AS 'building_name',
		`tbl_building`.`fld_apt_no` AS 'apt'
		from `tbl_tanents` 
		INNER JOIN `tbl_bedspace` ON `tbl_bedspace`.`fld_id`=`tbl_tanents`.`fld_bedspace_id`
		INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_id`=`tbl_bedspace`.`fld_room`
		INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		WHERE `tbl_tanents`.`fld_is_setup_done`='1' AND `tbl_tanents`.`fld_is_approved`='0'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetBuildingAndRoomByBedspace($id)
	{
		$this->connectToDB();
		$sql="SELECT
		`tbl_building`.`fld_building` AS 'building_name',
		`tbl_building`.`fld_apt_no` AS 'apt',
		`tbl_rooms`.`fld_custom_room_name` AS 'room_name',
		`tbl_bedspace`.`fld_room` AS 'room_id',
		`tbl_bedspace`.`fld_id` AS 'bedspace_id'
		FROM `tbl_bedspace`
		INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_id`=`tbl_bedspace`.`fld_room`
		INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		WHERE `tbl_bedspace`.`fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetBedspacebyRoom($room)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_bedspace` WHERE `fld_room`='$room'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

	function updateTenentStatus($id)
	{
		$this->connectToDB();
		$sql="update `tbl_tanents` set 
		`fld_is_approved`='1'
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
		
	}

	function getSubComplaintsByAdmin()
	{
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="SELECT `tbl_sub_complaints`.`fld_complaint_type` AS 'complain',
		`tbl_sub_complaints`.`assigned_by` AS 'assigned',
		`tbl_sub_complaints`.`fld_id` AS 'field',
		`tbl_sub_complaints`.`fld_complaint_id` AS 'complaintId',
		`tbl_sub_complaints`.`assigned_on` AS 'date',
		`tbl_admin`.`fld_name` AS 'name',
		`tbl_complaints`.`fld_prefer_date` AS 'preferredDate',
		`tbl_complaints`.`fld_complaint_description` AS 'complaintDescription',
		`tbl_complaints`.`fld_attachment_one` AS 'attachment_one',
		`tbl_complaints`.`fld_attachment_two` AS 'attachment_two',
		`tbl_complaints`.`fld_tenant_id` AS 'tenant_id',
        `tbl_tanents`.`fld_room` As 'Room_id',
        `tbl_tanents`.`fld_number` As 'tenentNumber',
        `tbl_rooms`.`fld_room_name` As 'RoomName',
        `tbl_rooms`.`fld_building_id` As 'BuildingId',
		`tbl_tanents`.`fld_name` AS 'Tenantname',
        `tbl_building`.`fld_building` AS 'BuildingName',
        `tbl_building`.`fld_area` As 'BulidingArea',
		`tbl_complaints`.`fld_attachment_three` AS 'attachment_three'
		FROM `tbl_sub_complaints`
	    INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_sub_complaints`.`assigned_by` 
	    INNER JOIN `tbl_complaints` ON `tbl_complaints`.`fld_id`=`tbl_sub_complaints`.`fld_complaint_id`
        INNER JOIN `tbl_tanents` ON `tbl_complaints`.`fld_tenant_id`=`tbl_tanents`.`fld_id`
        INNER JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
        INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
        
		WHERE `tbl_sub_complaints`.`assigned_to`=$uid 
		AND `tbl_sub_complaints`.`status`='0'";
		//echo $sql;
		$result=$this->CustomQuery($sql);
		//print_r($result);
		$this->DBDisconnect();
		return $result;
	}

		function getSubComplaintsStatusByAdmin()
	{
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="SELECT `tbl_sub_complaints`.`fld_complaint_type` AS 'complain',
		`tbl_sub_complaints`.`assigned_by` AS 'assigned',
		`tbl_sub_complaints`.`fld_id` AS 'field',
		`tbl_sub_complaints`.`fld_complaint_id` AS 'complaintId',
		`tbl_sub_complaints`.`assigned_on` AS 'date',
		`tbl_sub_complaints`.`status` AS 'stat',
		`tbl_sub_complaints`.`is_closed` AS 'isclosed',
		`tbl_admin`.`fld_name` AS 'name',
		`tbl_complaints`.`fld_prefer_date` AS 'preferredDate',
		`tbl_complaints`.`fld_complaint_description` AS 'complaintDescription',
		`tbl_complaints`.`fld_attachment_one` AS 'attachment_one',
		`tbl_complaints`.`fld_attachment_two` AS 'attachment_two',
		`tbl_complaints`.`fld_tenant_id` AS 'tenant_id',
        `tbl_tanents`.`fld_room` As 'Room_id',
        `tbl_tanents`.`fld_number` As 'tenentNumber',
        `tbl_rooms`.`fld_room_name` As 'RoomName',
        `tbl_rooms`.`fld_building_id` As 'BuildingId',
		`tbl_tanents`.`fld_name` AS 'Tenantname',
        `tbl_building`.`fld_building` AS 'BuildingName',
        `tbl_building`.`fld_area` As 'BulidingArea',
		`tbl_complaints`.`fld_attachment_three` AS 'attachment_three'
		FROM `tbl_sub_complaints`
	    INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_sub_complaints`.`assigned_by` 
	    INNER JOIN `tbl_complaints` ON `tbl_complaints`.`fld_id`=`tbl_sub_complaints`.`fld_complaint_id`
        INNER JOIN `tbl_tanents` ON `tbl_complaints`.`fld_tenant_id`=`tbl_tanents`.`fld_id`
        INNER JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
        INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		WHERE `tbl_sub_complaints`.`status`='0' OR `tbl_sub_complaints`.`status`='1'";
		//echo $sql;
		$result=$this->CustomQuery($sql);
		//print_r($result);
		$this->DBDisconnect();
		return $result;
	}

	function getClosedComplaints()
	{
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="SELECT `tbl_sub_complaints`.`fld_complaint_type` AS 'complain',
		`tbl_sub_complaints`.`assigned_by` AS 'assigned',
		`tbl_sub_complaints`.`fld_id` AS 'field',
		`tbl_sub_complaints`.`is_closed` AS 'closed',
		`tbl_sub_complaints`.`fld_complaint_id` AS 'complaintId',
		`tbl_sub_complaints`.`assigned_on` AS 'date',
		`tbl_admin`.`fld_name` AS 'name'
		FROM `tbl_sub_complaints`
	    INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_sub_complaints`.`assigned_by` 
		WHERE `tbl_sub_complaints`.`assigned_to`='$uid' 
		AND `tbl_sub_complaints`.`status`='1'";
		//echo $sql;
		$result=$this->CustomQuery($sql);
		//print_r($result);
		$this->DBDisconnect();
		return $result;
	}

		function getAllComplaints()
	{
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="SELECT `tbl_sub_complaints`.`fld_complaint_type` AS 'complain',
		`tbl_sub_complaints`.`assigned_by` AS 'assigned',
		`tbl_sub_complaints`.`fld_id` AS 'field',
		`tbl_sub_complaints`.`is_closed` AS 'closed',
		`tbl_sub_complaints`.`fld_complaint_id` AS 'complaintId',
		`tbl_sub_complaints`.`assigned_on` AS 'date',
		`tbl_admin`.`fld_name` AS 'name'
		FROM `tbl_sub_complaints`
	    INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_sub_complaints`.`assigned_by` 
		
		AND `tbl_sub_complaints`.`status`='1'";
		//echo $sql;
		$result=$this->CustomQuery($sql);
		//print_r($result);
		$this->DBDisconnect();
		return $result;
	}
	function checkbedspaceorRoom($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_bedspace` WHERE `fld_room`='$id' AND `fld_block_unblock`='1'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
}
?>