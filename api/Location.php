<?php

require 'common.php';

 

$sql="SELECT 
        `tbl_building`.`fld_area` AS 'area',
         `tbl_building`.`fld_id` AS 'tbl_building_fld_id',
        `tbl_building`.`fld_building` AS 'building',
        `tbl_building`.`fld_id` AS 'building_id',
        `tbl_building`.`fld_apt_no` AS 'apt_no',        
        `tbl_building`.`fld_approved` AS 'approved',        
        `tbl_rooms`.`fld_room_name` AS 'room_name',
    
        `tbl_building`.`parking` AS 'parking',
        `tbl_rooms`.`fld_custom_room_name` AS 'custom_room_name',
        `tbl_rooms`.`balconices` AS 'balconices',
        `tbl_rooms`.`metro_train` AS 'metro_train',
        `tbl_rooms`.`occupancy` AS 'occupancy',
        `tbl_rooms`.`gender` AS 'gender',
        `tbl_rooms`.`avalability_date` AS 'avalability_date',
        `tbl_rooms`.`window` AS 'window',
          `tbl_rooms`.`common_room` AS 'common_room',
        `tbl_rooms`.`bath` AS 'bath',
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

          ORDER BY `tbl_building`.`fld_area` ASC";



$result = $con->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {







 
$room_image =array();
$buliding_room_image = array();

    $bus = array(
                'room_id' => $row['room_id'],
                'Area' => $row['area'],
                'Building' => $row['building'],
                'Building-id' => $row['building_id'],
                'Apartment-no' => $row['apt_no'],
                'Is-approved' => $row['approved'],
                'Room_Name' => $row['room_name'],       
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
                'parking' => $row['parking'],
                'Expected_rent' => $row['expected_rent'],
        //'icon' => './images/' . $row['busColor'] . '.png'
    );
    array_push($json, $bus);
    }
       
    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=> $json); 
    

    //echo json_encode("[Status:True, Msg:Successfull]");

} 
else {
       $jsonstring = array('status'=>false,'message'=>"Something Went Wrong!!!");
}

  echo json_encode($jsonstring); 
mysqli_close($con);

?>