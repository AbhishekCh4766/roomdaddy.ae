<?php
include_once("DBAccess.php");

Class AdminManager extends DBAccess
{
	/* ADMIN SITE FUNCTIONS */
	function adminLogin($username,$password)
	{
		$this->connectToDB();
	/*	$sql="select fld_id, fld_name, fld_email, fld_last_login, fld_password,fld_type, fld_status  
		from ".DB_PREFIX."admin WHERE fld_email='".$username."'";*/

		$sql="select tbl_admin.fld_id, tbl_admin.fld_name, tbl_admin.fld_email, tbl_admin.fld_last_login, tbl_admin.fld_password,tbl_admin.fld_type, tbl_admin.fld_status ,`tbl_roles`.`fld_role` AS role
		from ".DB_PREFIX."admin INNER JOIN `tbl_role_assign` ON `tbl_admin`.`fld_id`=`tbl_role_assign`.`fld_admin_id` INNER JOIN `tbl_roles` ON `tbl_role_assign`.`fld_role`=`tbl_roles`.`fld_id` WHERE fld_email='".$username."'";

		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		if($result[0])
		{
			if($result[0] && ifish_validatePassword($password, $result[0]['fld_password']))
			{
			
				return $result[0];
			}	
			else
			{
				return array();
			}		
		}
	}
	
	function saveAdminUser($admin_name,$admin_location,$address, $phone, $map_url, $admin_email,$password)
	{
		
		$this->connectToDB();
		$table  = "tbl_admin";
		$insert = "fld_name,fld_address,fld_phone_no,fld_google_map_url, fld_email, fld_password,fld_type,fld_creation_date, fld_status";
		$values = $admin_name.",".$address.",".$phone.",".$map_url.",".$admin_email.",".$password.",1".",NOW(),1";	
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;		      	   	      	   
		$result = $this->InsertRecord($table, $insert, $values);
		return $result;
	}
	
	
	function updateAdminUser($user_id,$admin_name,$admin_location, $address, $phone,$map_url, $admin_email,$password )
	{
		
		$this->connectToDB();
		if(strlen($password)>0 && $password!='')
		{
			
			$sql="update ".DB_PREFIX."admin set fld_name=$admin_name,fld_address=$address, fld_phone_no=$phone,fld_google_map_url=$map_url, fld_email=$admin_email, fld_password = '$password'
			 where fld_id = '$user_id'";
		}
		else
		{
			$sql="update ".DB_PREFIX."admin set fld_name=$admin_name,fld_address=$address, fld_phone_no=$phone,fld_google_map_url=$map_url, fld_email=$admin_email where fld_id='$user_id'";
		}
		//echo $sql; exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function ActivateAdminById($user_id )
	{
		$this->connectToDB();
			$sql="update ".DB_PREFIX."admin set fld_status='1' where fld_id='$user_id'";
		
		//echo $sql; exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function BlockAdminById($user_id )
	{
		$this->connectToDB();
		
			$sql="update ".DB_PREFIX."admin set fld_status='0' where fld_id='$user_id'";
		
		//echo $sql; exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function DeleteAdminById($user_id )
	{
		$this->connectToDB();
			$sql="delete from ".DB_PREFIX."admin where fld_id='$user_id'";
		
		//echo $sql; exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	
	function getAdmin($adminid)
	{
		$this->connectToDB();
		$sql="select * from tbl_admin where fld_id='$adminid'";
		//echo $sql;
		$result = $this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function getAdminName($adminid)
	{
		$this->connectToDB();
		$sql="select `fld_name` from tbl_admin where fld_id='$adminid'";
		//echo $sql;
		$result = $this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function getAllUsersLocations()
	{
		$this->connectToDB();
		$sql="select * from tbl_admin where fld_status='1' and fld_type='1'";
		//echo $sql;
		$result = $this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function getAdminInformation()
	{
		$this->connectToDB();
		$sql="select * from tbl_admin";
		//echo $sql;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function getAllAdminUsers()
	{
		$this->connectToDB();
		$sql="select * from tbl_admin WHERE fld_type>0 ";
		//echo $sql;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function editAdminInfo($uname,$email,$pwd, $id)
	{
		$this->connectToDB();
		if($pwd == "")
		{
			$sql="update tbl_admin set fld_name ='$uname', fld_email='$email' where fld_id='".$id."'";
		}
		else
		{
		   $encrypted_pwd = ifish_encryptPassword($pwd);
		   $sql="update tbl_admin set fld_name ='$uname', fld_email='$email', fld_password ='".$encrypted_pwd."' where fld_id='".$id."'";
		}	
		//echo $sql; exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function save_last_login($id)
	{
		$this->connectToDB();
		$sql="update ".DB_PREFIX."admin set fld_last_login ='".time()."' where fld_id='".$id."'";
		//echo $sql;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	function save_new_password($new_pwd, $id)
	{
		$encrypted_pwd = ifish_encryptPassword($new_pwd);
		$this->connectToDB();
		$sql="update ".DB_PREFIX."admin set fld_password ='".$encrypted_pwd."' where fld_id='".$id."'";
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	
	//************************************************************* 
	// Get All Admins
	function getAllAdmins($where='', $start=0, $end=0)
	{
		$limit = '';
		if($end > 0)
			$limit = "LIMIT $start, $end";
		
		$this->connectToDB();
	    if($_SESSION['WHITE_CLEANING']['role_id'] == 1)  // means super admin
		{
			$result=$this->CustomQuery("SELECT * FROM ".DB_PREFIX."admin WHERE fld_id != ".$_SESSION['WHITE_CLEANING']['userid']." ORDER BY fld_id desc  $limit");
		}
		else
		{
			$result=$this->CustomQuery("SELECT * FROM ".DB_PREFIX."admin WHERE created_by='".$_SESSION['WHITE_CLEANING']['userid']."' ORDER BY fld_id desc  $limit");
		}	
		$this->DBDisconnect();
		
		if(!$result[0])
			return array();
		else
			return $result;	
	}

	function getalluserroles(){
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="select * from tbl_role_assign WHERE fld_admin_id = ".$uid;
		//echo $sql;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

	function updateBuildingStatus($id){
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="update `tbl_building` set 
		`fld_approved`='1',
		`approved_by` = $uid
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

		function updateRentStatus($id){

			

		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="update `tbl_rent_status` set 
		`status`='1',
		`approved_by` = $uid
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

		function updateBookingStatus($id){

		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="update `tbl_bedspace` set 
		`is_booking_verified`='1',
		`booking_verified_by` = $uid
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

			function DisapproveBooking($id){

		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="update `tbl_bedspace` set 
		`is_booking_verified`='2',
		`fld_is_rented`=0,
		`booking_verified_by` = $uid
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

			function updatePaymentStatus($id){
				//print_r($_REQUEST);
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="update `tbl_transactions` set 
		`status`='1',
		`approved_by` = $uid
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

		function updateNoticeStatus(){

			
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$notice_approval="update `tbl_notice` set 
		`status`='".$_REQUEST['status']."',
		`remarks`= '".$_REQUEST['remarks']."',
		`approved_by` = $uid
		where `id`='".$_REQUEST['id']."' ";
		//echo $notice_approval;

        // Make Room Available for Booking
		$notice_approved=$this->CustomModify($notice_approval);

        if($notice_approved == 1 && $_REQUEST['status']== 1)
        {
		$book_room_again="update `tbl_bedspace` set 
		`fld_is_notice`= '1' 
		where `fld_tanent_id`= '".$_REQUEST['TenentId']."' ";
      //echo $book_room_again; 
       $result=$this->CustomModify($book_room_again);
           $tenent = "update `tbl_tanents` set fld_is_current_tanent=0 where `fld_id`= '".$_REQUEST['TenentId']."' ";
        
           $tenent_new=$this->CustomModify($tenent);


          //  updateTenentHistory 

           $RoomId = $_REQUEST['RoomId'];
           $bedspace_id = $_REQUEST['BedSpaceId'];
           $tenent_id = $_REQUEST['TenentId'];

        $table="tbl_tenent_history";
		$insert="`fld_tenent_id`, `fld_room_id`, `fld_bedspace_id`, `fld_type` ";
		$values="$tenent_id,$RoomId,$bedspace_id,'1' ";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
          }
          else {
          	echo "Something Went Wrong"; 
          }
		$this->DBDisconnect();
		return $result;
	}


			function updateExpense(){

			//  print_r($_REQUEST);
			// // echo $remarks;
			//  die;
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="update `tbl_notice` set 
		`status`='".$_REQUEST['status']."',
		`remarks`= '".$_REQUEST['remarks']."',
		`approved_by` = $uid
		where `id`='".$_REQUEST['id']."' ";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

		function updateExpenseStatus($id){
		$uid = $_SESSION['Enron FZE']['userid'];
		$this->connectToDB();
		$sql="update `tbl_expense` set 
		`is_approved`='1',
		`approved_by` = $uid
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

	function getBuildDetailsById($id){
		$this->connectToDB();
		$sql="select * from tbl_building WHERE fld_id = ".$id;
		//echo $sql;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	
		function getNoticeDetailsById($id)
	{
		$this->connectToDB();
		$sql="SELECT * FROM  `tbl_notice` 
        LEFT JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_notice`.`tenent_id`
		  WHERE `id`= ".$id;
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}

			function DeleteExpense($id)
	{
		
        //die("Hello");
		$this->connectToDB();
		$sql="update `tbl_expense` set
		  `is_approved` = '2' 
		  WHERE `fld_id`= ".$id;
		echo $sql;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
}