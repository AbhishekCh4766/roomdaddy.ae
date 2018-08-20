 <?php 

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, Content-Type'); 
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

  function db_connect()
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
 

function sendPushNotificationToFCMSever($notification_for_user,$message) {
     
// print_r($notification_for_user);
// print_r($message);
   
    $regID = $notification_for_user['device_id'];

  
    $registrationIds = array($regID);
  
    define('API_ACCESS_KEY', 'AAAAtZVN4KY:APA91bER55Jdp8akdKDih69VRRq5nRomMZ8nARI0yEMVSXttnsK7P64ZuzxzdwF8JmF7OvoMEgR_aHtpno8B36ssTeukTAvqysqvCxP44667irzxnWJh1z-uKAeiX13Q7Ls9ug43OcXgtjnBWO4Iiv-0kzBJQHPjvg');
// prep the bundle
    //---------
   // print_r($message);
$fields = array(
        'registration_ids' => $registrationIds,
        'data' => array(
                            'message' => $message,
                            'click_action' => "FCM_PLUGIN_ACTIVITY",
                            'sound'=>'default',
                            'vibrate' => 1,
                            "time_to_live"  => 10,
                            'sound' => 1,
                            "priority" => "high",
                            "title" => "1 new message",                
                            'noti_type' => 'Complaints_assigned',
                            "sound" => "default",
                            "icon" => "http://roomdaddy.ae/roomdaddy/admin/img/room.png'",   
                      ),
        'notification'=>array(
                            'message' => $message,
                            'click_action' => "FCM_PLUGIN_ACTIVITY",
                            'sound'=>'default',
                            'vibrate' => 1,
                            "time_to_live"  => 10,
                            'sound' => 1,
                            "priority" => "high",
                            "title" => "1 new message",              
                            'noti_type' => 'Complaints_assigned',
                            "sound" => "default",
                            "icon" => "http://roomdaddy.ae/roomdaddy/admin/img/room.png'",   
                          ),
        'priority'=> "high"
    );
    //-------------------------
       
    //----------
    // $msg = array
    //     (
    //         'data' => array (
    //       "message" => $message,
    //   ),
    //     'alert' => $message,
    //     'vibrate' => 1,
    //     "time_to_live"  => 10,
    //     'sound' => 1,
    //     "priority" => "high",      
    //     "content_available"=> true,
    //     "content-available" => 1,
    //     "notification" => array(
    //         "title" => "RoomDaddy",
    //         'noti_type' => 'Complaints_assigned',
    //         "sound" => "default",
    //         "icon" => "myicon",
    //     ),
    // );

    // $fields = array
    //     (
    //     'registration_ids' => $registrationIds,
    //     'data' => $msg
    // );

    $headers = array
    (
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    
   // print_r($result);
    return 'sent';
}

  function getClientDetails($id)
  {

    $con = db_connect();
    $sql = "SELECT `tbl_sub_complaints`.*, `tbl_tanents`.* FROM `tbl_sub_complaints` INNER JOIN `tbl_complaints` ON `tbl_sub_complaints`.`fld_complaint_id` = `tbl_complaints`.`fld_id` LEFT JOIN `tbl_tanents` ON `tbl_complaints`.`fld_tenant_id` = `tbl_tanents`.`fld_id` WHERE `tbl_sub_complaints`.`fld_id`=$id";
     
        $result = $con->query($sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $result = array(
        'fld_id' => $row['fld_id'],
        'fld_name' => $row['fld_name'],
        'fld_email' => $row['fld_email'],
        'fld_password' => $row['fld_password'],
        'device_id' => $row['device_id']
                      );
         return $row;

  } 

  function getBedspaceListByPropertyId($buliding_id)
 {
   
   $data = array();
   $con = db_connect();
   $sql="SELECT `tbl_bedspace`.*,`tbl_rooms`.`fld_room_name`,`tbl_rooms`.`fld_custom_room_name` FROM tbl_bedspace 
         INNER JOIN `tbl_building` ON `tbl_bedspace`.`fld_building_id`=`tbl_building`.`fld_id`
         INNER JOIN `tbl_rooms` ON `tbl_bedspace`.`fld_room`=`tbl_rooms`.`fld_id` 
         where `tbl_bedspace`.`fld_building_id` =".$buliding_id." AND `fld_block_unblock` =1 ";
  
   $result = mysqli_query ($con, $sql);

    while($row = mysqli_fetch_array ($result))
    {
          $sql="SELECT `fld_name`,`fld_actual_name` FROM `tbl_tanents` WHERE `fld_id`='".$row['fld_tanent_id']."'";

          $tanent_name = mysqli_query ($con, $sql);
          $tanent_name = $tanent_name->fetch_assoc();
          
          if(!empty($tanent_name['fld_name']))
          {
            $fld_name = $tanent_name['fld_name'];
          }else{
            $fld_name = "";
          }


          if(!empty($tanent_name['fld_actual_name']))
          {
            $fld_actual_name = $tanent_name['fld_actual_name'];
          }else{
            $fld_actual_name = "";
          }


          if(!empty($fld_actual_name) &&  !empty($fld_name))
          {
            $rent_status = "Booked";
          }else{
            $rent_status = "Vaccant";
          }

        $property = array('fld_id'=>$row['fld_id'],
                        'fld_building_id'=>$row['fld_building_id'],
                        'fld_notes'=>$row['fld_notes'],
                        'fld_is_notice'=>$row['fld_is_notice'],
                        'fld_expected_rent'=>$row['fld_expected_rent'],
                        'fld_is_rented'=>$row['fld_is_rented'],
                        'fld_tanent_id'=>$row['fld_tanent_id'],
                        'is_booking_verified'=>$row['is_booking_verified'],
                        'booking_verified_by'=>$row['booking_verified_by'],
                        'fld_owner'=>$row['fld_owner'],
                        'fld_update_date'=>$row['fld_update_date'],
                        'fld_is_bs_model'=>$row['fld_is_bs_model'],
                        'fld_block_unblock'=>$row['fld_block_unblock'],
                        'fld_type'=>$row['fld_type'],
                        'fld_room_name'=>$row['fld_room_name'],
                        'fld_custom_room_name'=>$row['fld_custom_room_name'],
                        'fld_name'=>$fld_name,
                        'fld_actual_name'=>$fld_actual_name,
                        'rent_status'=>$rent_status

                       );
      array_push($data, $property);
    }

    return array('data'=>$data);
 }


  function getPropertyListByAdminId($admin_id)
  {
   $data = array();
   $con = db_connect();
   $sql="SELECT * FROM `tbl_building` where fld_tanent=".$admin_id." ORDER BY `tbl_building`.`fld_id`";
 
   $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))
    {
      $property = array('fld_id'=>$row['fld_id'],
                        'fld_account_code'=>$row['fld_account_code'],
                        'fld_area'=>$row['fld_area'],
                        'parking'=>$row['parking'],
                        'fld_building'=>$row['fld_building'],
                        'fld_contract_starting_date'=>$row[' fld_contract_starting_date'],
                        'fld_contract_ending_date'=>$row['fld_contract_ending_date'],
                        'fld_rent'=>$row['fld_rent'],
                        'fld_deposit'=>$row['fld_deposit'],
                        'fld_comission'=>$row['fld_comission'],
                        'fld_du'=>$row['fld_du'],
                        'fld_empower'=>$row['fld_empower'],
                        'fld_num_of_beds'=>$row['fld_num_of_beds'],
                        'fld_num_of_chqs'=>$row['fld_num_of_chqs'],
                        'fld_apt_no'=>$row['fld_apt_no'],
                        'fld_update_date'=>$row['fld_update_date'],
                        'fld_tanent'=>$row['fld_tanent'],
                        'fld_approved'=>$row['fld_approved'],
                        'approved_by'=>$row['approved_by']
                       );
      array_push($data, $property);
    }

    return array('data'=>$data);
  }



  function filterBy($type,$order_by,$offset)
  {
   if($type =='price')
   {
    $order_by = "ORDER BY `tbl_bedspace`.`fld_expected_rent` ".$order_by." ";
   }

   if($type=='metro_distance')
   {
     $order_by = "ORDER BY `tbl_rooms`.`metro_train` ".$order_by." ";
   }

   $con = db_connect();
 

   $sql_count="SELECT count(tbl_bedspace.`fld_id`) as total_records from tbl_bedspace where tbl_bedspace.`fld_block_unblock`=1";
   $count_result = mysqli_query ($con, $sql_count);
   $room_image_row = $count_result->fetch_assoc();
          
    if(!empty($room_image_row))
    {
      $total_records = $room_image_row['total_records'];
    }else{
       $total_records =0;
    } 

    $sql="SELECT 
        `tbl_building`.`fld_area` AS 'area',
        `tbl_building`.`fld_id` AS 'tbl_building_fld_id',
        `tbl_building`.`fld_building` AS 'building',
        `tbl_building`.`fld_id` AS 'building_id',
        `tbl_building`.`fld_apt_no` AS 'apt_no',        
        `tbl_building`.`fld_approved` AS 'approved', 

        `tbl_building`.`parking` AS 'parking',    
        `tbl_rooms`.`fld_room_name` AS 'room_name',
        `tbl_rooms`.`fld_id` AS 'room_id',
        `tbl_rooms`.`fld_custom_room_name` AS 'custom_room_name',
        `tbl_rooms`.`balconices` AS 'balconices',
        `tbl_rooms`.`metro_train` AS 'metro_train',
        `tbl_rooms`.`occupancy` AS 'occupancy',
        `tbl_rooms`.`gender` AS 'gender',
        `tbl_rooms`.`avalability_date` AS 'avalability_date',
        `tbl_rooms`.`common_room` AS 'common_room',
        `tbl_rooms`.`window` AS 'window',
        `tbl_rooms`.`bath` AS 'bath',

        `tbl_rooms`.`fld_room_name` AS 'room_name',
        `tbl_rooms`.`fld_id` AS 'room_id',
        `tbl_rooms`.`fld_custom_room_name` AS 'custom_room_name',
        `tbl_bedspace`.`fld_id` AS 'bedspace_id',
        `tbl_bedspace`.`fld_room` AS 'bedspace',
        `tbl_bedspace`.`fld_is_notice` AS 'notice',
        `tbl_bedspace`.`fld_is_rented` AS 'is_rented',
        `tbl_rooms`.`fld_id` AS 'room_id',
        `tbl_admin`.`fld_name` AS 'name',
        `tbl_bedspace`.`fld_expected_rent` AS 'expected_rent'
        from `tbl_bedspace`
        INNER JOIN `tbl_rooms`
        ON `tbl_bedspace`.`fld_room`=`tbl_rooms`.`fld_id`
        INNER JOIN `tbl_building` 
        ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
        INNER JOIN `tbl_admin`
        ON `tbl_building`.`fld_tanent`=`tbl_admin`.`fld_id`
        WHERE (`tbl_bedspace`.`fld_is_notice`='1' OR `tbl_bedspace`.`fld_is_rented`='0')
        
        AND `tbl_bedspace`.`fld_block_unblock`='1' 

       ".$order_by." ";

      $result = $con->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {



   $sql="SELECT `fld_name` FROM `tbl_room_pics` WHERE `fld_room_id`='".$row['room_id']."'";
    // $result = $conn->query($sql);
    $result_room_image = mysqli_query ($con, $sql);
    if ($result_room_image->num_rows > 0) {
    // output data of each row
    while($room_image_row = $result_room_image->fetch_assoc()) {
    //echo "id:". $row['fld_name']. "<br>";
     $target_path = 'http://roomdaddy.ae/roomdaddy/admin/rooms/ROOM_IMAGES/';
     $room_image[] = $target_path.$room_image_row['fld_name'];
    }
    } else {
    $room_image = array();
    }


    $sql="SELECT `fld_name` FROM `tbl_property_documents` WHERE `fld_property`='".$row['tbl_building_fld_id']."'";
    // $result = $conn->query($sql);
    $result_buliding_image = mysqli_query ($con, $sql);
    if ($result_buliding_image->num_rows > 0) {
    // output data of each row
    while($buliding_image_row = $result_buliding_image->fetch_assoc()) {
    //echo "id:". $row['fld_name']. "<br>";
     $target_path = 'http://roomdaddy.ae/roomdaddy/admin/Documents/PROPERTY_DOC/';
     $buliding_room_image[] = $target_path.$buliding_image_row['fld_name'];
    }
    } else {
    $buliding_room_image = array();
    }



    $bus = array(
        'room_id' => $row['room_id'],
        'Area' => $row['area'],
        'Building' => $row['building'],
        'Building-id' => $row['building_id'],
        'Apartment-no' => $row['apt_no'],
        'Is-approved' => $row['approved'],
        'Room_Name' => $row['room_name'], 

          'parking' => $row['parking'],

        'Custom_room_name' => $row['custom_room_name'],
        'Bedspace_id' => $row['bedspace_id'],
        'Bedspace' => $row['bedspace'],
        'Notice' => $row['notice'],
        'Type' => $row['is_rented'],
        'Name' => $row['name'],
         'Room_image' => $room_image,
        'Buliding_image' => $buliding_room_image,
         'balconices' => $row['balconices'],
        'metro_train' => $row['metro_train'],
        'occupancy' => $row['occupancy'],
        'gender' => $row['gender'],
        'avalability_date' => $row['avalability_date'],
         'window' => $row['window'],
        'bath' => $row['bath'],
        'common_room' => $row['common_room'],

        'Expected_rent' => $row['expected_rent'],
        //'icon' => './images/' . $row['busColor'] . '.png'
    );
    array_push($json, $bus);
    }
    //echo json_encode("[Status:True, Msg:Successfull]");
} 

  return array('data'=>$json,'total_records'=>$total_records);



 }






 function price_range_filter($startRange,$endRange,$offset)
 {
    $con = db_connect();
    $between = "AND `tbl_bedspace`.`fld_expected_rent` BETWEEN ".$startRange." AND ".$endRange."";



     $sql_count="SELECT count(tbl_bedspace.`fld_id`) as total_records from tbl_bedspace where tbl_bedspace.`fld_block_unblock`=1  ".$between."";
      $count_result = mysqli_query ($con, $sql_count);
      $room_image_row = $count_result->fetch_assoc();
          
      if(!empty($room_image_row))
      {
        $total_records = $room_image_row['total_records'];
      }else{
         $total_records =0;
      } 

    $sql="SELECT 
        `tbl_building`.`fld_area` AS 'area',
        `tbl_building`.`fld_id` AS 'tbl_building_fld_id',
        `tbl_building`.`fld_building` AS 'building',
        `tbl_building`.`fld_id` AS 'building_id',
        `tbl_building`.`fld_apt_no` AS 'apt_no',        
        `tbl_building`.`fld_approved` AS 'approved', 

        `tbl_building`.`parking` AS 'parking',    
        `tbl_rooms`.`fld_room_name` AS 'room_name',
        `tbl_rooms`.`fld_id` AS 'room_id',
        `tbl_rooms`.`fld_custom_room_name` AS 'custom_room_name',
        `tbl_rooms`.`balconices` AS 'balconices',
        `tbl_rooms`.`metro_train` AS 'metro_train',
        `tbl_rooms`.`occupancy` AS 'occupancy',
        `tbl_rooms`.`gender` AS 'gender',
        `tbl_rooms`.`avalability_date` AS 'avalability_date',
        `tbl_rooms`.`common_room` AS 'common_room',
        `tbl_rooms`.`window` AS 'window',
        `tbl_rooms`.`bath` AS 'bath',

        `tbl_rooms`.`fld_room_name` AS 'room_name',
        `tbl_rooms`.`fld_id` AS 'room_id',
        `tbl_rooms`.`fld_custom_room_name` AS 'custom_room_name',
        `tbl_bedspace`.`fld_id` AS 'bedspace_id',
        `tbl_bedspace`.`fld_room` AS 'bedspace',
        `tbl_bedspace`.`fld_is_notice` AS 'notice',
        `tbl_bedspace`.`fld_is_rented` AS 'is_rented',
        `tbl_rooms`.`fld_id` AS 'room_id',
        `tbl_admin`.`fld_name` AS 'name',
        `tbl_bedspace`.`fld_expected_rent` AS 'expected_rent'
        from `tbl_bedspace`
        INNER JOIN `tbl_rooms`
        ON `tbl_bedspace`.`fld_room`=`tbl_rooms`.`fld_id`
        INNER JOIN `tbl_building` 
        ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
        INNER JOIN `tbl_admin`
        ON `tbl_building`.`fld_tanent`=`tbl_admin`.`fld_id`
        WHERE (`tbl_bedspace`.`fld_is_notice`='0' OR `tbl_bedspace`.`fld_is_rented`='1')
        
        AND `tbl_bedspace`.`fld_block_unblock`='1' 

       ".$between." ";

      $result = $con->query($sql);
    

if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {



   $sql="SELECT `fld_name` FROM `tbl_room_pics` WHERE `fld_room_id`='".$row['room_id']."'";
    // $result = $conn->query($sql);
    $result_room_image = mysqli_query ($con, $sql);
    if ($result_room_image->num_rows > 0) {
    // output data of each row
    while($room_image_row = $result_room_image->fetch_assoc()) {
    //echo "id:". $row['fld_name']. "<br>";
     $target_path = 'http://roomdaddy.ae/roomdaddy/admin/rooms/ROOM_IMAGES/';
     $room_image[] = $target_path.$room_image_row['fld_name'];
    }
    } else {
    $room_image = array();
    }


    $sql="SELECT `fld_name` FROM `tbl_property_documents` WHERE `fld_property`='".$row['tbl_building_fld_id']."'";
    // $result = $conn->query($sql);
    $result_buliding_image = mysqli_query ($con, $sql);
    if ($result_buliding_image->num_rows > 0) {
    // output data of each row
    while($buliding_image_row = $result_buliding_image->fetch_assoc()) {
    //echo "id:". $row['fld_name']. "<br>";
     $target_path = 'http://roomdaddy.ae/roomdaddy/admin/Documents/PROPERTY_DOC/';
     $buliding_room_image[] = $target_path.$buliding_image_row['fld_name'];
    }
    } else {
    $buliding_room_image = array();
    }



    $bus = array(
        'room_id' => $row['room_id'],
        'Area' => $row['area'],
        'Building' => $row['building'],
        'Building-id' => $row['building_id'],
        'Apartment-no' => $row['apt_no'],
        'Is-approved' => $row['approved'],
        'Room_Name' => $row['room_name'], 
        'parking' => $row['parking'],
        'Custom_room_name' => $row['custom_room_name'],
        'Bedspace_id' => $row['bedspace_id'],
        'Bedspace' => $row['bedspace'],
        'Notice' => $row['notice'],
        'Type' => $row['is_rented'],
        'Name' => $row['name'],
         'Room_image' => $room_image,
        'Buliding_image' => $buliding_room_image,
         'balconices' => $row['balconices'],
        'metro_train' => $row['metro_train'],
        'occupancy' => $row['occupancy'],
        'gender' => $row['gender'],
        'avalability_date' => $row['avalability_date'],
         'window' => $row['window'],
        'bath' => $row['bath'],
        'common_room' => $row['common_room'],

        'Expected_rent' => $row['expected_rent'],
        //'icon' => './images/' . $row['busColor'] . '.png'
    );
    array_push($json, $bus);
    }

    //echo json_encode("[Status:True, Msg:Successfull]");
} 

    return array('data'=>$json,'total_records'=>$total_records);

 }

 




  function bedspace_or_room($type,$offset)
  {      
      if($type=='room')
      {
        $type = 'R';
      }else{
        $type = 'B';
      }

      $con = db_connect();

      $sql_count="SELECT count(tbl_bedspace.`fld_id`) as total_records from tbl_bedspace where tbl_bedspace.`fld_block_unblock`=1 AND `tbl_bedspace`.`fld_type` = '".$type."'";
         
       
      $count_result = mysqli_query ($con, $sql_count);
      $room_image_row = $count_result->fetch_assoc();
          
      if(!empty($room_image_row))
      {
        $total_records = $room_image_row['total_records'];
      }else{
        $total_records =0;
      } 

      $sql="SELECT 
        `tbl_building`.`fld_area` AS 'area',
        `tbl_building`.`fld_id` AS 'tbl_building_fld_id',
        `tbl_building`.`fld_building` AS 'building',
        `tbl_building`.`fld_id` AS 'building_id',
        `tbl_building`.`fld_apt_no` AS 'apt_no',        
        `tbl_building`.`fld_approved` AS 'approved', 
        `tbl_building`.`parking` AS 'parking',    
        `tbl_rooms`.`fld_room_name` AS 'room_name',
        `tbl_rooms`.`fld_id` AS 'room_id',
        `tbl_rooms`.`fld_custom_room_name` AS 'custom_room_name',
        `tbl_rooms`.`balconices` AS 'balconices',
        `tbl_rooms`.`metro_train` AS 'metro_train',
        `tbl_rooms`.`occupancy` AS 'occupancy',
        `tbl_rooms`.`gender` AS 'gender',
        `tbl_rooms`.`avalability_date` AS 'avalability_date',
        `tbl_rooms`.`common_room` AS 'common_room',
        `tbl_rooms`.`window` AS 'window',
        `tbl_rooms`.`bath` AS 'bath',
        `tbl_rooms`.`fld_room_name` AS 'room_name',
        `tbl_rooms`.`fld_id` AS 'room_id',
        `tbl_rooms`.`fld_custom_room_name` AS 'custom_room_name',
        `tbl_bedspace`.`fld_id` AS 'bedspace_id',
        `tbl_bedspace`.`fld_room` AS 'bedspace',
        `tbl_bedspace`.`fld_is_notice` AS 'notice',
        `tbl_bedspace`.`fld_is_rented` AS 'is_rented',
        `tbl_rooms`.`fld_id` AS 'room_id',
        `tbl_admin`.`fld_name` AS 'name',
        `tbl_bedspace`.`fld_expected_rent` AS 'expected_rent'
        from `tbl_bedspace`
        INNER JOIN `tbl_rooms`
        ON `tbl_bedspace`.`fld_room`=`tbl_rooms`.`fld_id`
        INNER JOIN `tbl_building` 
        ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
        INNER JOIN `tbl_admin`
        ON `tbl_building`.`fld_tanent`=`tbl_admin`.`fld_id`
        WHERE (`tbl_bedspace`.`fld_is_notice`='0' OR `tbl_bedspace`.`fld_is_rented`='1')
        AND `tbl_bedspace`.`fld_block_unblock`='1' AND `tbl_bedspace`.`fld_type` = '".$type."'";
      

     /* echo $sql;
      die('ddddd');*/
      $result = $con->query($sql);
    

if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {



   $sql="SELECT `fld_name` FROM `tbl_room_pics` WHERE `fld_room_id`='".$row['room_id']."'";
    // $result = $conn->query($sql);
    $result_room_image = mysqli_query ($con, $sql);
    if ($result_room_image->num_rows > 0) {
    // output data of each row
    while($room_image_row = $result_room_image->fetch_assoc()) {
    //echo "id:". $row['fld_name']. "<br>";
     $target_path = 'http://roomdaddy.ae/roomdaddy/admin/rooms/ROOM_IMAGES/';
     $room_image[] = $target_path.$room_image_row['fld_name'];
    }
    } else {
    $room_image = array();
    }


    $sql="SELECT `fld_name` FROM `tbl_property_documents` WHERE `fld_property`='".$row['tbl_building_fld_id']."'";
    // $result = $conn->query($sql);
    $result_buliding_image = mysqli_query ($con, $sql);
    if ($result_buliding_image->num_rows > 0) {
    // output data of each row
    while($buliding_image_row = $result_buliding_image->fetch_assoc()) {
    //echo "id:". $row['fld_name']. "<br>";
     $target_path = 'http://roomdaddy.ae/roomdaddy/admin/Documents/PROPERTY_DOC/';
     $buliding_room_image[] = $target_path.$buliding_image_row['fld_name'];
    }
    } else {
    $buliding_room_image = array();
    }

    $bus = array(
        'room_id' => $row['room_id'],
        'Area' => $row['area'],
        'Building' => $row['building'],
        'Building-id' => $row['building_id'],
        'Apartment-no' => $row['apt_no'],
        'Is-approved' => $row['approved'],
        'Room_Name' => $row['room_name'], 
        'parking' => $row['parking'],
        'Custom_room_name' => $row['custom_room_name'],
        'Bedspace_id' => $row['bedspace_id'],
        'Bedspace' => $row['bedspace'],
        'Notice' => $row['notice'],
        'Type' => $row['is_rented'],
        'Name' => $row['name'],
         'Room_image' => $room_image,
        'Buliding_image' => $buliding_room_image,
         'balconices' => $row['balconices'],
        'metro_train' => $row['metro_train'],
        'occupancy' => $row['occupancy'],
        'gender' => $row['gender'],
        'avalability_date' => $row['avalability_date'],
         'window' => $row['window'],
        'bath' => $row['bath'],
        'common_room' => $row['common_room'],

        'Expected_rent' => $row['expected_rent'],
        //'icon' => './images/' . $row['busColor'] . '.png'
    );
    array_push($json, $bus);
    }
} 

    return array('data'=>$json,'total_records'=>0);

 }



   function getAdminValidate($email)
   {
      $con = db_connect();
      $no = $num;
      $sql="SELECT `tbl_admin`.*, `tbl_role_assign`.`fld_role` AS roleid, `tbl_roles`.`fld_role` AS Roles FROM tbl_admin INNER JOIN `tbl_role_assign` ON `tbl_admin`.`fld_id`=`tbl_role_assign`.`fld_admin_id` INNER JOIN `tbl_roles` ON `tbl_role_assign`.`fld_role`=`tbl_roles`.`fld_id` where `fld_email`='".$email."' ";
      //echo $sql;
      $result = $con->query($sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$result = array('fld_password' => $row['fld_password']);
      return $row; 
   }

 function getTanentsValidate($num)
  {
    $con = db_connect();
    $no = $num;
    $sql = "SELECT `tbl_tanents`.*, `tbl_rooms`.`fld_custom_room_name`, `tbl_rooms`.`fld_room_name`, `tbl_building`.`fld_building` from tbl_tanents
   LEFT JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
   LEFT JOIN `tbl_building` ON `tbl_rooms`.`fld_building_id`=`tbl_building`.`fld_id`
            WHERE `tbl_tanents`.`fld_number`=$no OR `tbl_tanents`.`fld_number`=$num ";
    //echo $sql;
    $result = $con->query($sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //$result = array('fld_password' => $row['fld_password']);
    return $row; 
  }




 function clientLogin($fld_number,$password)
 {

    echo "<pre/>";
    print_r($fld_number);
    print_r($password);
    die('hereeeee.......');
   

 }



 function adminLogin($email,$password)
 {
    $con = db_connect();

    $sql="SELECT `tbl_admin`.*, `tbl_role_assign`.`fld_role` AS roleid, `tbl_roles`.`fld_role` AS Roles FROM tbl_admin INNER JOIN `tbl_role_assign` ON `tbl_admin`.`fld_id`=`tbl_role_assign`.`fld_admin_id` INNER JOIN `tbl_roles` ON `tbl_role_assign`.`fld_role`=`tbl_roles`.`fld_id` where `fld_email`='".$email."' ";

   
    $result = $con->query($sql);

    $row = mysqli_fetch_array ($result);

    echo "<pre/>";
      
      print_r($row);
      die;

    if ($result->num_rows > 0) 
    {
        // output data of each row
        $json = array();
        $result = mysqli_query ($con, $sql);
        while($row = mysqli_fetch_array ($result))     
        {
        $bus = array(
            
            'id' => $row['fld_id'],
            'Name' => $row['fld_name'],
            'Official-Name' => $row['fld_official_name'],
            'fld_number' => $row['fld_number'],
            'fld_email' => $row['fld_email'],
            'fld_last_login' => $row['fld_last_login'],
            'fld_password' => $row['fld_password'],
            'fld_type' => $row['fld_type'],
            'fld_status' => $row['fld_status'],
            'fld_created_by' => $row['fld_created_by'],
            'fld_chat_availible' => $row['fld_chat_availible'],
            'Roles' => $row['Roles'],
            'fld_creation_date' => $row['fld_creation_date'],
            'roleid' => $row['roleid']
            
        );
        array_push($json, $bus);
        }
        
    }

    return $bus;
 }


function getcomplaintsAssign($admin_id,$date,$id){

  $con = db_connect();

    $sql = "update `tbl_sub_complaints` set `assigned_to`='".$admin_id."', `assigned_on`='".$date."' where `fld_id`=".$id;

      $result = $con->query($sql);
      return $result;
}

function getAdminDetails($admin_id){

  $con = db_connect();

  $sql = "SELECT * from tbl_admin WHERE fld_id = $admin_id";

   $result = $con->query($sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $result = array(
        'fld_password' => $row['fld_password'],
        'fld_name' => $row['fld_name'],
        'fld_email' => $row['fld_email'],
        'device_id' => $row['device_id']
                      );
      return $row;

}

  function change_password_Admin($pass,$id)
{
  $con = db_connect();
  $sql = "UPDATE `tbl_admin` SET `fld_password` = '$pass' WHERE fld_id= $id";

   //echo $sql;
  $result = $con->query($sql);

  if ($result == 1) 
  {
      $status = 1;
  }  
  else 
  {
     $status =0;
  }
  return $status;
  }

  ?>