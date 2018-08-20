<?php
require 'common.php';
 

 // print_r($_REQUEST);
 // die;

   $uid = $_REQUEST['user_id'];


   $sql="update `tbl_sub_complaints` set
		 `status`= '".$_REQUEST['status']."',
		 `fld_is_resolved_by`= ' ".$uid." ',
		 `remarks`= '".$_REQUEST['remarks']."' 
         WHERE `fld_id`='".$_REQUEST['id']."'  ";
 

 // $sql="update `tbl_transactions` set 
	// 	`status`='1',
	// 	`approved_by` = $uid
	// 	where fld_id=$id";


//echo $phone_enc;
$result = $con->query($sql);
// print_r($sql);
// die($result);
if ($result == 1) 
{
    // output data of each row
    $json = array();
    
   
    $bus = array(
   'status' => 'success',
   'msg'  => 'Complaint Resolved Successfully'       
    );
    array_push($json, $bus);
    

    $jsonstring = json_encode($json);
    echo $jsonstring;

    //echo json_encode("[Status:True, Msg:Successfull]");
    
}
 


  else {
    // echo json_encode("{'status':'false', 'Msg':'Invalid Credentials! Please check your Phone Number or password!!!'}");
         $json = array();
    $result = mysqli_query ($con, $sql);
    $i=1;
    while($i<=1)     
    {
    $bus = array( 
        'status' => 'fail',
        'msg' => 'Complaint Resolve Failed'
    );
    array_push($json, $bus);
    $i++;
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

        }

mysqli_close($con);

?>