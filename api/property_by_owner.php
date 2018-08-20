<?php


require 'common.php';

$id = $_REQUEST['id'];


 $sql="SELECT * from `tbl_building` WHERE `fld_tanent`=$id AND `fld_approved` != 0";
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
        'AccountCode' => $row['fld_account_code'],
        'area' => $row['fld_area'],
        'building' => $row['fld_building'],
        'startingDate' => $row['fld_contract_starting_date'],
        'endingDate' => $row['fld_contract_ending_date'],
        'rent' => $row['fld_rent'],
        'deposit' => $row['fld_deposit'],
        'comission' => $row['fld_comission'],
        'dewa' => $row['fld_dewa'],
        'fldDu' => $row['fld_du'],
        'empower' => $row['fld_empower'],
        'numOfBeds' => $row['fld_num_of_beds'],
        'numOfChqs' => $row['fld_num_of_chqs'],
        'aptNo' => $row['fld_apt_no'],
        'updateDate' => $row['fld_update_date'],
        'tanent' => $row['fld_tanent'],
        'approvedBy' => $row['approved_by'],
        //'icon' => './images/' . $row['busColor'] . '.png'
    );
    array_push($json, $bus);
    }

    $jsonstring = array('status'=>true,'message'=>"Successfull",'data' =>$json);  


    //echo json_encode("[Status:True, Msg:Successfull]");

} 
else {
       $jsonstring = array('status'=>false,'message'=>"No Properties Found!!!");
     }

   echo json_encode($jsonstring); 

mysqli_close($con);

?>