<?php
require 'common.php';
 
  if(!empty($_GET['status']) && !empty($_GET['user_id']) && !empty($_GET['id']))
   {
      $sql="update `tbl_expense` set  `is_approved`='".$_REQUEST['status']."',`approved_by` = '".$_REQUEST['user_id']."' where `fld_id`='".$_REQUEST['id']."' ";
    
      $result = $con->query($sql);
      if($result == 1) 
      {
        $jsonstring = array('status'=>true,'message'=>"Successfull");  
      }else {
        $jsonstring = array('status'=>false,'message'=>"Something went wrong!");
      }

   }else{

      $jsonstring = array('status'=>false,'message'=>"Please fill all data.");
   }

   echo json_encode($jsonstring); 
  
  mysqli_close($con);

?>