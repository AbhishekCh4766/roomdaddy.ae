<?php
require 'common.php';


if($_REQUEST['status'] != '' && $_REQUEST['user_id'] !='' && $_REQUEST['id'] !='')
{

 $sql="update `tbl_transactions` set 
        `status`='".$_REQUEST['status']."',
        `approved_by` = '".$_REQUEST['user_id']."'
        where `fld_id`='".$_REQUEST['id']."' ";


$result = $con->query($sql);

if ($result == 1) 
{

  $jsonstring = array('status'=>true,'message'=>"Successfull"); 
}
  else {
$jsonstring = array('status'=>false,'message'=>"Something Went Wrong!!!");
        }

        }
  else{

    $jsonstring = array('status'=>false,'message'=>"Please Enter Valid Value!!!");
  }
  echo json_encode($jsonstring); 
mysqli_close($con);

?>