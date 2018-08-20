<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, Content-Type'); 
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

include_once("../api/apiManager.php");
include_once("../common/functions.php");

  function db_connect_filter()
  {

   $con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_roomdadd_roomdaddy_new");
  // $con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_leasing1");
   // Check connection
   if (mysqli_connect_errno())
   {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die('Failed to connect to MySQL');
    }
   return $con;
  }
 


 $action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}





switch ($action) {
    case 'price':
        price();
        break;

    case 'metro_distance':
        metro_distance();
        break;

    case 'price_range':
        price_range();
        break;

    case 'bedspace_or_room_filter':
          bedspace_or_room_filter();
          break;

    case 'login':
        login();
        break;

    case 'complaint_super':
        complaint_super();
        break;

    case 'complaint_super_view':
        complaint_super_view();
        break; 

    case 'complaint_admin_view':
        complaint_admin_view();
        break; 

    case 'complaint_assigned_admin':
        complaint_assigned_admin();
        break;     

    case 'complaint_admin':
        complaint_admin();
        break;

    case 'complaint_assign':
        complaint_assign();
        break;

    case 'complaint_resolve':
        complaint_resolve();
        break;

    case 'get_property_list_by_admin_id':
        get_property_list_by_admin_id();
        break;

    case 'get_bedspace_list_by_property_id':
        get_bedspace_list_by_property_id();
        break;

    case 'change_password':
          change_password();
          break;

    default:
        not_found();
}

 


   /*get_property_list_by_admin_id*/
  function get_bedspace_list_by_property_id()
  { 

    if(isset($_GET['buliding_id']))
    {  
        $buliding_id = $_GET['buliding_id'];

        $return = getBedspaceListByPropertyId($buliding_id);
        if(empty($return))
        {
        $result = array();
        }else{
        $result = $return['data'];
        }
       $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result); 

    }else{
       $jsonstring = array('status'=>false,'message'=>"Please Enter property ID."); 
    }
    echo json_encode($jsonstring);
  }
  

function change_password()
 {

  $old_pass  = $_REQUEST['old_pass'];
  $new_pass = $_REQUEST['new_pass'];
  $conf_pass = $_REQUEST['conf_pass'];
  $id = $_REQUEST['id'];


  if(!empty($old_pass) && !empty($new_pass)&& !empty($id) && !empty($conf_pass))
  {   if($new_pass== $conf_pass)
       {
         if($old_pass == $new_pass)
       {
        echo json_encode('Oops!!! Old Password And New Password can not be same, Please enter different Password');
       }
       else {

       $result = getAdminDetails($id);
      

       // print_r($result);
       // die("hi");
        if(ifish_validatePassword($old_pass,$result['fld_password']))
      {  
        
        $pass  =  ifish_encryptPassword($new_pass);

        $change_pass = change_password_Admin($pass, $id);
        $jsonstring = array('status'=>true,'message'=>"Password Updated successfully."); 
       }else{
        $jsonstring = array('status'=>false,'message'=>"You Entered Wrong Password!!!"); 
       }         
                  
             }
       }
       else {
         $jsonstring = array('status'=>false,'message'=>"New Password And Confirm Password did't match!!! Please check");
       }
      
  }else{
    $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
  }
  echo json_encode($jsonstring);
 }



  /*get_property_list_by_admin_id*/
  function get_property_list_by_admin_id()
  { 
    if(isset($_GET['admin_id']))
    {  
        $admin_id = $_GET['admin_id'];

        $return = getPropertyListByAdminId($admin_id);
        if(empty($return))
        {
        $result = array();
        }else{
        $result = $return['data'];
        }
       $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result); 

    }else{
       $jsonstring = array('status'=>false,'message'=>"Please Enter Admin ID."); 
    }
    echo json_encode($jsonstring);
  }
  




  /*bedspace_or_room_filter filter*/
  function bedspace_or_room_filter()
  { 

    if(isset($_GET['type']) && isset($_GET['page']))
    { 
        $page  = $_GET['page'];
        $offset = ($page*20)-20;
        // when page no not 1.
        if($page!=1)
        {
        $offset =($page * 20)-20; 
        }
       
        $type =$_GET['type'];
        $return = bedspace_or_room($type,$offset);

        if(empty($return))
        {
        $result = array();
        }else{
        $result = $return['data'];
        $total_records = $return['total_records'];

        }

       $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result,'total_records'=>$total_records,'per_page'=>20); 

    }else{
       $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }
    echo json_encode($jsonstring);
  }


  /*Price filter*/
  function price()
  { 
    if(isset($_GET['order_by']) && isset($_GET['page']))
    {
        $page  = $_GET['page'];
        $offset = ($page*20)-20;
        // when page no not 1.
        if($page!=1)
        {
        $offset =($page * 20)-20; 
        }

       $order_by_price = $_GET['order_by'];
       $return = filterBy('price',$order_by_price,$offset);

        if(empty($return))
        {
        $result = array();
        }else{
        $result = $return['data'];
        $total_records = $return['total_records'];

        }
       $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result,'total_records'=>$total_records,'per_page'=>20); 
    }else{
       $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }
    echo json_encode($jsonstring);
  }





  /*metro_distance filter*/
  function metro_distance()
  { 
    if(isset($_GET['order_by']) && isset($_GET['page']))
    {

      $page  = $_GET['page'];
      $offset = ($page*20)-20;
        // when page no not 1.
       if($page!=1)
       {
        $offset =($page * 20)-20; 
       }

       $order_by_metro_distance = $_GET['order_by'];
       $return = filterBy('metro_distance',$order_by_metro_distance,$offset);

        if(empty($return))
        {
        $result = array();
        }else{
        $result = $return['data'];
        $total_records = $return['total_records'];

        }

       $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result,'total_records'=>$total_records,'per_page'=>20); 
    }else{
       $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }
    echo json_encode($jsonstring);
  }
 





   /*price_range filter*/
  function price_range()
  { 

    if(isset($_GET['start']) && isset($_GET['end']) && isset($_GET['page']))
    { 

        $page  = $_GET['page'];
        $offset = ($page*20)-20;
        // when page no not 1.
        if($page!=1)
        {
        $offset =($page * 20)-20; 
        }
       $startRange = $_GET['start'];
       $endRange = $_GET['end'];
       $return = price_range_filter($startRange,$endRange,$offset);

        if(empty($return['data']))
        {
        $result = array();
        }else{
        $result = $return['data'];
        $total_records = $return['total_records'];

        }
        
       $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result,'total_records'=>$total_records,'per_page'=>20); 

    }else{
       $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }
    echo json_encode($jsonstring);
  }


  /*login*/

  function login(){
    
    if(!empty($_REQUEST['email']) && !empty($_REQUEST['type']) && !empty($_REQUEST['password']))
   {

      //Login from admin side..
    if($_REQUEST['type'] =='A')
    {
       $email = $_REQUEST['email'];
       $password = $_REQUEST['password'];
       $result = getAdminValidate($_REQUEST['email']);

  
      if(ifish_validatePassword($password,$result['fld_password']))
        { 

           $data = array(
                        'id' => $result['fld_id'],
                        'Name' => $result['fld_name'],
                        'Official-Name' => $result['fld_official_name'],
                        'fld_number' => $result['fld_number'],
                        'fld_email' => $result['fld_email'],
                        'fld_last_login' => $result['fld_last_login'],
                        'fld_password' => $result['fld_password'],
                        'fld_type' => $result['fld_type'],
                        'fld_status' => $result['fld_status'],
                        'fld_created_by' => $result['fld_created_by'],
                        'fld_chat_availible' => $result['fld_chat_availible'],
                        'Roles' => $result['Roles'],
                        'fld_creation_date' => $result['fld_creation_date'],
                        'roleid' => $result['roleid']
                       );
         $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$data); 
       }else{
         $jsonstring = array('status'=>false,'message'=>"Invalid Login Credentials."); 
       }
    }


      //Login from client side. 
     if($_REQUEST['type'] =='C')
     {
       $result = getTanentsValidate($_REQUEST['email']);
      /* print_r($result);
       die;*/
       $password = $_REQUEST['password'];
       if(ifish_validatePassword($password,$result['fld_password']))
       { 
           $data = array(
                        'id' => $result['fld_id'],
                        'Name' => $result['fld_name'],
                        'Actual_Name' => $result['fld_actual_name'],
                        'Nationality' => $result['fld_nationality'],
                        'fld_room' => $result['fld_room'],
                        'fld_num_of_occupants' => $result['fld_num_of_occupants'],
                        'fld_email' => $result['fld_email'],
                        'fld_number_client' => $result['fld_number_client'],
                        'fld_old_bedspace_id' => $result['fld_old_bedspace_id'],
                        'fld_is_current_tanent' => $result['fld_is_current_tanent'],
                        'fld_is_notice' => $result['fld_is_notice'],
                        'fld_move_in_date' => $result['fld_move_in_date'],
                        'fld_tanent_move_date' => $result['fld_tanent_move_date'],
                        'fld_move_out_date' => $result['fld_move_out_date'],
                        'fld_deposit' => $result['fld_deposit'],
                        'fld_payment_due_date' => $result['fld_payment_due_date'],
                        'fld_last_login' => $result['fld_last_login'],
                        'fld_update_date' => $result['fld_update_date'],
                        'fld_rent' => $result['fld_rent'],
                        'fld_minimum_stay' => $result['fld_minimum_stay'],
                        'fld_comission' => $result['fld_comission'],
                        'fld_bedspace_id' => $result['fld_bedspace_id'],
                        'fld_is_setup_done' => $result['fld_is_setup_done'],
                        'fld_sex' => $result['fld_sex'],
                        'fld_is_approved' => $result['fld_is_approved'],
                        'fld_number' => $result['fld_number'],
                        'fld_whatsapp_no' => $result['fld_whatsapp_no'],
                        'custom_room_name' => $result['fld_custom_room_name'],
                        'room' => $result['fld_room_name'],
                        'building_name' => $result['fld_building'],
                        'Roles' =>'C',
                        'fld_profile_picture' => $result['fld_profile_picture'],
                       );
         $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$data); 
       }else{
         $jsonstring = array('status'=>false,'message'=>"Invalid Login Credentials."); 
       }
     }

    }else{
       $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }
     echo json_encode($jsonstring);
  }

// function complaint_assign()
// {
//   $admin_id = $_REQUEST['assigned_to'];
   
//   $admin_data =array('did'='sdsdfsd');

//   $date     = $_REQUEST['assigned_on'];
//   $Superadmin_id       = $_REQUEST['fld_id'];


//   $data_for_notification = array('name',sa'')

//    $message ="jksdhsad";
//    sendPushNotificationToFCMSever($admin_data,$zfsdf)


//   if(isset($_REQUEST['assigned_to']) && isset($_REQUEST['assigned_on']) && isset($_REQUEST['fld_id']) )
//   {
//         $con = db_connect_filter();
//       $sql = "update `tbl_sub_complaints` set `assigned_to`='".$admin_id."', `assigned_on`='".$date."' where `fld_id`=".$id;
//       $result = $con->query($sql);
//       if($result)
//       {
//           $jsonstring = array('status'=>true,'message'=>"complaint assign successfully"); 
//       }
//       else  
//       {
//        $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
//       }
//     echo json_encode($jsonstring);
//   }
// }



function complaint_assign()
{
  $admin_id    = $_REQUEST['assigned_to'];
  $date        = $_REQUEST['assigned_on'];
  $id          = $_REQUEST['fld_id'];
  $assigned_by = $_REQUEST['assigned_by'];

 

  if(isset($_REQUEST['assigned_to']) && isset($_REQUEST['assigned_on']) && isset($_REQUEST['fld_id']) )
  {
        $con = db_connect_filter();
      $sql = "update `tbl_sub_complaints` set `assigned_to`='".$admin_id."', `assigned_on`='".$date."', `assigned_by`='".$assigned_by."' where `fld_id`=".$id;
      $result = $con->query($sql);
      if($result)
      {
          $adminDetails = getAdminDetails($admin_id);

          $getAdminName = getAdminDetails($assigned_by);

          $getClientDetails = getClientDetails($id);

         $message = " Complaints assigned Successfully";

         $name = $adminDetails['fld_name'];

         $messageclient = "Your Complaint Assigned to :".$name;

         //print_r($messageclient);
         // print_r($getClientDetails);
         // print_r($adminDetails);

          sendPushNotificationToFCMSever($getClientDetails,$messageclient);
          sendPushNotificationToFCMSever($adminDetails,$message);
         


          $jsonstring = array('status'=>true,'message'=>"complaint assign successfully"); 
      }
      else  
      {
       $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
      }
    echo json_encode($jsonstring);
  }
}


function complaint_resolve()
{
  $admin_id = $_REQUEST['fld_is_resolved_by'];
  $remarks  = $_REQUEST['remarks'];
  $id       = $_REQUEST['fld_id'];

  if(isset($_REQUEST['fld_is_resolved_by']) && isset($_REQUEST['remarks']) && isset($_REQUEST['fld_id']) )
  {
       $con = db_connect_filter();
      $sql = "update `tbl_sub_complaints` set `fld_is_resolved_by`='".$admin_id."', `status`=1,`remarks`='".$remarks."' where `fld_id`=".$id;
      $result = $con->query($sql);
      if($result)
      {
              $adminDetails = getAdminDetails($admin_id);

          $name = $adminDetails['fld_name'];
          $getClientDetails = getClientDetails($id);
          $messageclient = "Your Complaint is Resolved by :".$name;
         // print_r($messageclient);
         // die;
         sendPushNotificationToFCMSever($getClientDetails,$messageclient);

          $jsonstring = array('status'=>true,'message'=>"complaint resolve successfully"); 
      }
      else  
      {
       $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
      }
    echo json_encode($jsonstring);
  }
}

// complaint 
function complaint_super(){
    $con = db_connect_filter();
        
  $sql="SELECT DISTINCT `tbl_complaints`.*, `tbl_sub_complaints`.`assigned_to` AS assigned, `tbl_tanents`.`fld_name` As TenentName,
       `tbl_tanents`.`fld_room` AS RoomId, `tbl_rooms`.`fld_building_id` AS BuildingId, `tbl_rooms`.`fld_room_name` As RoomName, `tbl_building`.`fld_area` As AreaName, `tbl_building`.`fld_building` As BuildingName, `tbl_rooms`.`fld_custom_room_name` As CustomRoom, `tbl_building`.`fld_apt_no` As ApartmentNumber 
     from `tbl_complaints`
   INNER JOIN `tbl_sub_complaints` ON `tbl_complaints`.`fld_id` = `tbl_sub_complaints`.`fld_complaint_id` 
   INNER JOIN `tbl_tanents` ON `tbl_complaints`.`fld_tenant_id` = `tbl_tanents`.`fld_id` 
   INNER JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
   INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
   WHERE `tbl_sub_complaints`.`assigned_to` =0 ";       
  $result = $con->query($sql);
  if ($result->num_rows > 0) 
  {
    // output data of each row
    $json = array();
    $target_path = 'http://roomdaddy.ae/roomdaddy/Complaint/Complain_DOCS/';

    if($row['fld_attachment_one'])
    {
       $attachment_one   = $target_path.$row['fld_attachment_one'];
    }else
    {
       $attachment_one  = '';
    }

    if($row['fld_attachment_two'])
    {
       $attachment_two   = $target_path.$row['fld_attachment_two'];
    }else
    {
       $attachment_one  = '';
    }

    if($row['fld_attachment_three'])
    {
       $attachment_three = $target_path.$row['fld_attachment_three'];
    }else
    {
       $attachment_three  = '';
    }
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    { 
    $bus = array(
                'fld_id'                    => $row['fld_id'],
                'fld_tenant_id'             => $row['fld_tenant_id'],
                'fld_complaint_description' => $row['fld_complaint_description'],
                'fld_prefer_time'           => $row['fld_prefer_time'],
                'fld_prefer_date'           => $row['fld_prefer_date'],
                'TenentName'                => $row['TenentName'],
                'RoomId'                    => $row['RoomId'],
                'BuildingId'                => $row['BuildingId'],
                'RoomName'                  => $row['RoomName'],
                'AreaName'                  => $row['AreaName'],
                'BuildingName'              => $row['BuildingName'],
                'fld_attachment_one'        => $attachment_one,
                'fld_attachment_two'        => $attachment_two,
                'fld_attachment_three'      => $attachment_three,
                'ApartmentNumber'           => $row['ApartmentNumber'],
                'CustomRoom'                => $row['CustomRoom'],
                'fld_update_date'           => $row['fld_update_date']);
    array_push($json, $bus);
    }
    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$json); 
      
  }
  else{
     $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
  }
  echo json_encode($jsonstring);
  }

  function complaint_admin(){
    $fld_tenant_id = $_GET['fld_tenant_id'];
    $con = db_connect_filter();
        
  $sql="SELECT DISTINCT `tbl_complaints`.*, `tbl_sub_complaints`.`assigned_to` AS assigned, `tbl_tanents`.`fld_name` As TenentName,
       `tbl_tanents`.`fld_room` AS RoomId, `tbl_rooms`.`fld_building_id` AS BuildingId, `tbl_rooms`.`fld_room_name` As RoomName, `tbl_building`.`fld_area` As AreaName, `tbl_building`.`fld_building` As BuildingName, `tbl_rooms`.`fld_custom_room_name` As CustomRoom, `tbl_building`.`fld_apt_no` As ApartmentNumber 
     from `tbl_complaints`
   INNER JOIN `tbl_sub_complaints` ON `tbl_complaints`.`fld_id` = `tbl_sub_complaints`.`fld_complaint_id` 
   INNER JOIN `tbl_tanents` ON `tbl_complaints`.`fld_tenant_id` = `tbl_tanents`.`fld_id` 
   INNER JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
   INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
   WHERE `tbl_sub_complaints`.`assigned_to` =".$fld_tenant_id;       
  $result = $con->query($sql);
  if ($result->num_rows > 0) 
  {
    // output data of each row
    $json = array();
    $target_path = 'http://roomdaddy.ae/roomdaddy/Complaint/Complain_DOCS/';

    if($row['fld_attachment_one'])
    {
       $attachment_one   = $target_path.$row['fld_attachment_one'];
    }else
    {
       $attachment_one  = '';
    }

    if($row['fld_attachment_two'])
    {
       $attachment_two   = $target_path.$row['fld_attachment_two'];
    }else
    {
       $attachment_one  = '';
    }

    if($row['fld_attachment_three'])
    {
       $attachment_three = $target_path.$row['fld_attachment_three'];
    }else
    {
       $attachment_three  = '';
    }
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {
    $bus = array(
                'fld_id'                    => $row['fld_id'],
                'fld_tenant_id'             => $row['fld_tenant_id'],
                'fld_complaint_description' => $row['fld_complaint_description'],
                'fld_prefer_time'           => $row['fld_prefer_time'],
                'fld_prefer_date'           => $row['fld_prefer_date'],
                'TenentName'                => $row['TenentName'],
                'RoomId'                    => $row['RoomId'],
                'BuildingId'                => $row['BuildingId'],
                'RoomName'                  => $row['RoomName'],
                'AreaName'                  => $row['AreaName'],
                'BuildingName'              => $row['BuildingName'],
                'fld_attachment_one'        => $attachment_one,
                'fld_attachment_two'        => $attachment_two,
                'fld_attachment_three'      => $attachment_three,
                'ApartmentNumber'           => $row['ApartmentNumber'],
                'CustomRoom'                => $row['CustomRoom'],
                'fld_update_date'           => $row['fld_update_date']);
    array_push($json, $bus);
    }
    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$json); 
      
  }
  else{
     $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
  }
  echo json_encode($jsonstring);
  }


//View complaint of super admin 
function complaint_super_view(){
     $con = db_connect_filter();
        
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
  $result = $con->query($sql);
  if ($result->num_rows > 0) 
  {
    // output data of each row
    $json = array();
    $target_path = 'http://roomdaddy.ae/roomdaddy/Complaint/Complain_DOCS/';

    if($row['attachment_one'])
    {
       $attachment_one   = $target_path.$row['attachment_one'];
    }else
    {
       $attachment_one  = '';
    }

    if($row['attachment_two'])
    {
       $attachment_two   = $target_path.$row['attachment_two'];
    }else
    {
       $attachment_one  = '';
    }

    if($row['attachment_three'])
    {
       $attachment_three = $target_path.$row['attachment_three'];
    }else
    {
       $attachment_three  = '';
    }
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    { 

    	if($row['isclosed'] == 0)
    	{
    		$close = "Pending";
    	}else
    	{
    		$close = "Close";
    	}
    	if($row['stat'] == 0)
    	{
    		$status = "Pending";
    	}else
    	{
    		$status = "Close";
    	}
    $bus = array(
                'complain'                    => $row['complain'],
                'assigned'                    => $row['assigned'],
                'field'                       => $row['field'],
                'complaintId'                 => $row['complaintId'],
                'date'                        => $row['date'],
                'stat'                        => $status,
                'isclosed'                    => $close,
                'name'                        => $row['name'],
                'preferredDate'               => $row['preferredDate'],
                'complaintDescription'        => $row['complaintDescription'],
                'AreaName'                  => $row['AreaName'],
                'BuildingName'              => $row['BuildingName'],
                'fld_attachment_one'        => $attachment_one,
                'fld_attachment_two'        => $attachment_two,
                'fld_attachment_three'      => $attachment_three,
                'tenant_id'           => $row['tenant_id'],
                'tenentNumber'                => $row['tenentNumber'],
                'BuildingId'           => $row['BuildingId'],
                'Tenantname'                => $row['Tenantname'],
                'BulidingArea'           => $row['BulidingArea'],
                'RoomName'           => $row['RoomName']);
    array_push($json, $bus);
    }
    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$json); 
      
  }
  else{
     $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
  }
  echo json_encode($jsonstring);
  }

// View complaint of admin admin 
function complaint_admin_view(){
  $admin_id = $_GET['admin_id'];
     $con = db_connect_filter();
        
  $sql="SELECT `tbl_sub_complaints`.`fld_complaint_type` AS 'complain',
		`tbl_sub_complaints`.`assigned_by` AS 'assigned',
		`tbl_sub_complaints`.`fld_id` AS 'field',
		`tbl_sub_complaints`.`is_closed` AS 'closed',
		`tbl_sub_complaints`.`fld_complaint_id` AS 'complaintId',
		`tbl_sub_complaints`.`assigned_on` AS 'date',
		`tbl_admin`.`fld_name` AS 'name'
		FROM `tbl_sub_complaints`
	    INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_sub_complaints`.`assigned_by` 
		WHERE `tbl_sub_complaints`.`assigned_to`='$admin_id' 
		AND `tbl_sub_complaints`.`status`='1'";       
  $result = $con->query($sql);
  if ($result->num_rows > 0) 
  {
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    { 
    if($row['closed'] == 0)
    {
    		$close = "Pending";
    }else
    	{
    		$close = "Close";
    	}
    $bus = array(
                'complain'              => $row['complain'],
                'assigned'              => $row['assigned'],
                'field'                 => $row['field'],
                'closed'                => $close,
                'complaintId'           => $row['complaintId'],
                'date'                  => $row['date'],
                'name'                  => $row['name']);
    array_push($json, $bus);
    }
    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$json); 
      
  }
  else{
     $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
  }
  echo json_encode($jsonstring);
  }

  //Complaint assigned to admin 
function complaint_assigned_admin(){


  $admin_id = $_GET['admin_id'];
     $con = db_connect_filter();
        
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
        
		WHERE `tbl_sub_complaints`.`assigned_to`=$admin_id 
		AND `tbl_sub_complaints`.`status`='0'";  

   // echo $sql; exit;     
  $result = $con->query($sql);
// $row = mysqli_fetch_array ($result);
//   echo "<pre/>";
//   print_r($row);
//   die;
  if ($result->num_rows > 0) 
  {
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    { 
     if($row['closed'] == 0)
    {
    		$close = "Pending";
    }else
    	{
    		$close = "Close";
    	}
    $bus = array(
                'complain'              => $row['complain'],
                'assigned'              => $row['assigned'],
                'field'                 => $row['field'],
                'closed'                => $close,
                'complaintId'           => $row['complaintId'],
                'date'                  => $row['date'],
                'name'                  => $row['name'],
                'preferredDate'         => $row['preferredDate'],
                'complaintDescription'  => $row['complaintDescription'],
                'tenant_id'             => $row['tenant_id'],
                'Room_id'               => $row['Room_id'],
                'tenentNumber'          => $row['tenentNumber'],
                 'BuildingId'           => $row['BuildingId'],
                'Tenantname'            => $row['Tenantname'],
                'BuildingName'          => $row['BuildingName'],
                'BulidingArea'          => $row['BulidingArea'],
                'attachment_one'          => $row['attachment_one'],
                'RoomName'              => $row['RoomName']);
    array_push($json, $bus);
    }
    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$json); 
      
  }
  else{
     $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
  }
  echo json_encode($jsonstring);
  }

  /*Not found*/
  function not_found() {
    $bind = [];
    $bind['status'] = 0;
    $bind['message'] = 'The requested action not found';
    $json = json_encode($bind);
    header('HTTP/1.1 400 Not Found');
    header('Content-Type: application/json');
    echo $json;
    die;
}

?>