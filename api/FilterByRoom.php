<?php

require 'common.php';
 

  

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
        
        AND  `tbl_bedspace`.`fld_block_unblock`='1'";


$result = $con->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {
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
        'Expected_rent' => $row['expected_rent'],
        //'icon' => './images/' . $row['busColor'] . '.png'
    );
    array_push($json, $bus);
    }


    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=> $json); 
    

    } 
    else {
       $jsonstring = array('status'=>false,'message'=>"Something Went Wrong!!!");
    }
    echo json_encode($jsonstring); 
    mysqli_close($con);

?>