<?php
require 'common.php';

 // $sql="SELECT `tbl_building`.*, `tbl_tanents`.`fld_name` AS 'tenent_name' from `tbl_building` 
 //       INNER JOIN  `tbl_tanents` ON `tbl_building`.`fld_tanent`=`tbl_tanents`.`fld_id` 
 //       where `fld_approved` = '0' ";

$sql = "SELECT * from `tbl_building` where `fld_approved` = '0' ";

$result = $con->query($sql);

if ($result->num_rows > 0) 
{
    
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {
    $bus = array(
        
        'id' => $row['fld_id'],
        'fld_account_code' => $row['fld_account_code'],
        'fld_area' => $row['fld_area'],
        'fld_building' => $row['fld_building'],
        'fld_contract_starting_date' => $row['fld_contract_starting_date'],
        'fld_contract_ending_date' => $row['fld_contract_ending_date'],
        'fld_rent' => $row['fld_rent'],
        'fld_deposit' => $row['fld_deposit'],
        'fld_comission' => $row['fld_comission'],
        'fld_dewa' => $row['fld_dewa'],
        'fld_du' => $row['fld_du'],
        'fld_empower' => $row['fld_empower'],
        'fld_num_of_beds' => $row['fld_num_of_beds'],
        'fld_num_of_chqs' => $row['fld_num_of_chqs'],
        'fld_apt_no' => $row['fld_apt_no'],
        'fld_update_date' => $row['fld_update_date'],
        'fld_tanent' => $row['fld_tanent'],
        'tenent_name' => $row['tenent_name'],

        
    );
    array_push($json, $bus);
    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$json);  
    }
    
}
  else {
        $jsonstring = array('status'=>false,'message'=>"No Building found to be approved.");
        }
        echo json_encode($jsonstring); 
      mysqli_close($con);

?>