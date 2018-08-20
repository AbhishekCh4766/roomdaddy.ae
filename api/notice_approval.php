<?php
require 'common.php';

 
 $sql="SELECT `tbl_notice`.*, `tbl_tanents`.`fld_name` AS 'tenentName'
       FROM  `tbl_notice` 
       INNER JOIN `tbl_tanents` ON `tbl_notice`.`tenent_id`=`tbl_tanents`.`fld_id`
	   WHERE `tbl_notice`.`status`='0' ";


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
        
        'id' => $row['id'],
        'Reason' => $row['move_out_reason'],
        'rating' => $row['rating'],
        'tenentId' => $row['tenent_id'],
        'moveOutDate' => $row['move_out_date'],
        'status' => $row['status'],
        'remarks' => $row['remarks'],
        'approvedBy' => $row['approved_by'],
        'createdAt' => $row['created_at'],
        'tenentName' => $row['tenentName'],
        
    );
    array_push($json, $bus);
    }

     $jsonstring = array('status'=>true,'message'=>"Successfull",'data' => $json);
   
     }
     else {
        $jsonstring = array('status'=>false,'message'=>"No Notice found to be approved!!!");
      }
      echo json_encode($jsonstring); 
mysqli_close($con);

?>