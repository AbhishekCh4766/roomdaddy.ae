<?php


require 'common.php';

  $email =$_REQUEST['email'];
  $password =$_REQUEST['password'];


  
  if($password == '1234' && $_REQUEST['email'] != '')
  {
    $sql="SELECT `tbl_admin`.*, `tbl_role_assign`.`fld_role` AS roleid, `tbl_roles`.`fld_role` AS Roles FROM tbl_admin

     INNER JOIN `tbl_role_assign` ON `tbl_admin`.`fld_id`=`tbl_role_assign`.`fld_admin_id`
     INNER JOIN `tbl_roles` ON `tbl_role_assign`.`fld_role`=`tbl_roles`.`fld_id`
     where `fld_email`='$email' AND `fld_password` ='c0627649924ac6c9bb0ab1d3db1b1cea:d3'
     
    ";

/*
    $sql="SELECT `tbl_admin`.*, `tbl_role_assign`.`fld_role` AS role_id, `tbl_roles`.`fld_role` AS Roles FROM tbl_admin where `fld_email`='$email' AND `fld_password` ='c0627649924ac6c9bb0ab1d3db1b1cea:d3'
     INNER JOIN `tbl_role_assign` ON `tbl_admin`.`fld_id`=`tbl_role_assign`.`fld_admin_id`
     INNER JOIN `tbl_roles` ON `tbl_role_assign`.`fld_role`=`tbl_roles`.`fld_id`";

*/
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
        'Name' => $row['fld_name'],
        'Official-Name' => $row['fld_official_name'],
        'fld_number' => $row['fld_number'],
        'fld_email' => $row['fld_email'],
        'fld_last_login' => $row['fld_last_login'],
        'fld_password' => $row['fld_password'],
        'fld_type' => $row['fld_type'],
        'fld_status' => $row['fld_status'],
        'fld_created_by' => $row['fld_created_by'],
        'fld_chat_availible' => $row['fld_chat_availible'],
        'Roles' => $row['Roles'],
        'fld_creation_date' => $row['fld_creation_date'],
        'roleid' => $row['roleid']
        
    );
    array_push($json, $bus);
    }
     $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$bus);  
}
 
}

  else {
   
   $jsonstring = array('status'=>false,'message'=>"Invalid Login Credentials!!!"); 

        }
  echo json_encode($jsonstring);
mysqli_close($con);

?>