<?php

require 'common.php';

  $sql="SELECT `tbl_role_assign`.*,`tbl_roles`.`fld_role` AS 'role', `tbl_admin`.`fld_name` AS 'name' from `tbl_role_assign` INNER JOIN `tbl_admin` ON `tbl_role_assign`.`fld_admin_id`=`tbl_admin`.`fld_id` INNER JOIN `tbl_roles` ON `tbl_role_assign`.`fld_role`=`tbl_roles`.`fld_id`";

   

   $result = $con->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {


$result = $con->query($sql);


if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {
    $bus = array(
        
        'admin_id' => $row['fld_admin_id'],
        'fld_role' => $row['fld_role'],
        'role' => $row['role'],
        'name' => $row['name']
        
    );
    array_push($json, $bus);
    }

 $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=> $json);   

}else{
  $jsonstring = array('status'=>false,'message'=>"No Roles Found ");

}
        echo json_encode($jsonstring); 

}
}
mysqli_close($con);

?>