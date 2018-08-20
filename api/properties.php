<?php


require 'common.php';


 $sql="SELECT `tbl_bedspace`.*, `tbl_admin`.`fld_name` AS 'Owner_name',
        `tbl_building`.`fld_building` AS 'Building_name',
        `tbl_building`.`fld_contract_starting_date` AS 'contractStartingDate',
        `tbl_building`.`fld_contract_ending_date` AS 'contractEndingDate'

  FROM tbl_bedspace INNER JOIN `tbl_admin` ON `tbl_bedspace`.`fld_owner`=`tbl_admin`.`fld_id` INNER JOIN `tbl_building` ON `tbl_bedspace`.`fld_building_id`= `tbl_building`.`fld_id`";
   // `tbl_building`.`fld_building` AS 'building_name'
  //INNER JOIN `tbl_building` ON `tbl_bedspace`.`fld_building_id`=`tbl_building`.`fld_id`

//echo $phone_enc;
$result = $con->query($sql);


if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {
    $bus = array(
        
        'id' => $row['fld_id'],
        'Room' => $row['fld_room'],
        'Building' => $row['fld_building_id'],
        'Room-Name' => $row['fld_room_name'],
        'Custom-Room' => $row['fld_custom_room_name'],
        'Notes' => $row['fld_notes'],
        'Notice' => $row['fld_is_notice'],
        'type' => $row['fld_is_rented'],
        'Expected-rent' => $row['fld_expected_rent'],
        'Tenent' => $row['fld_tanent_id'],
        'Owner' => $row['fld_owner'],
        'contractStartingDate' => $row['contractStartingDate'],
        'contractEndingDate' => $row['contractEndingDate'],
        'Building_name' => $row['Building_name'],
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