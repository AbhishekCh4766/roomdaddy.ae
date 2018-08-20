<?php
require 'common.php';
 

 // print_r($_REQUEST);
 // die;

 $sql="update `tbl_building` set 
        `fld_approved`='".$_REQUEST['status']."',
        `approved_by` = '".$_REQUEST['user_id']."'
        where `fld_id`='".$_REQUEST['id']."' ";


//echo $phone_enc;
$result = $con->query($sql);

//die($result);
if ($result == 1) 
{
    // output data of each row
    $json = array();
    
   
    $bus = array(
   'status' => 'success',
   'msg'  => 'Building Approved Successfully'       
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
        'msg' => 'Building Approval Failed'
    );
    array_push($json, $bus);
    $i++;
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

        }

mysqli_close($con);

?>