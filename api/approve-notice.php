<?php
require 'common.php';


if($_REQUEST['id'] !='' && $_REQUEST['status'] !='')
{
 $sql="update `tbl_notice` set 
        `status`='".$_REQUEST['status']."',
        `approved_by` = '".$_REQUEST['user_id']."'
        where `id`='".$_REQUEST['id']."' ";


 // $sql="update `tbl_notice` set 
 //        `status`='".$_REQUEST['status']."',
 //        `remarks`= '".$_REQUEST['remarks']."',
 //        `approved_by` = '".$_REQUEST['user_id']."'
 //        where `id`='".$_REQUEST['id']."' ";
//echo $phone_enc;
$result = $con->query($sql);


if ($result == 1) 
{
   $jsonstring = array('status'=>true,'message'=>"Notice Approved Successfully!!!");   
}
 


  else {
 $jsonstring = array('status'=>false,'message'=>"Something Went Wrong");
        }

}
else
{
     $jsonstring = array('status'=>false,'message'=>"Please enter valid value!!!");
}

       echo json_encode($jsonstring); 
mysqli_close($con);

?>