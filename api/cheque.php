<?php

require 'common.php';

  $id = $_REQUEST['id'];
  $owner_id =$_REQUEST['owner_id'];


 $sql="SELECT * from `tbl_chqs` WHERE `fld_building_id`=$id AND `fld_owner_id`=$owner_id";

// echo $sql;
// print_r($_REQUEST);
// die;


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
        'fld_building_id' => $row['fld_building_id'],
        'fld_owner_id' => $row['fld_owner_id'],
        'fld_chq_owner' => $row['fld_chq_owner'],
        'fld_chq_amount' => $row['fld_chq_amount'],
        'fld_chq_date' => $row['fld_chq_date'],
        'fld_chq_date_till' => $row['fld_chq_date_till'],
        'fld_chq_num' => $row['fld_chq_num'],
        'fld_update_date' => $row['fld_update_date'],
        //'status' => $row['success']
        //'icon' => './images/' . $row['busColor'] . '.png'
    );
    array_push($json, $bus);
    }

  $jsonstring = array('status'=>true,'message'=>"Notice Approved Successfully!!!",'data' => $json);   

} 
  else {
  $jsonstring = array('status'=>false,'message'=>"No Cheques Found ");

        }
        echo json_encode($jsonstring); 

mysqli_close($con);

?>