<?php

require 'common.php';

	$sql="SELECT `tbl_transactions`.*, `tbl_admin`.`fld_name` AS `transaction_by`  from `tbl_transactions`
        INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_transactions`.`fld_transaction_by`
		 WHERE `status`= '0' " 
		 ;


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
        'fld_payment_by' => $row['fld_payment_by'],
        'fld_payment_to' => $row['fld_payment_to'],
        'fld_payment' => $row['fld_payment'],
        'fld_transaction_by' => $row['fld_transaction_by'],
        'fld_payment_date' => $row['fld_payment_date'],
        'fld_description' => $row['fld_description'],
        'fld_update_date' => $row['fld_update_date'],
        'approved_by' => $row['approved_by'],
        'status' => $row['status'],
        'status' => 'success'
        
    );
    array_push($json, $bus);
    }

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
        'msg' => 'No Payment Found to be Approved'
    );
    array_push($json, $bus);
    $i++;
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

        }

mysqli_close($con);

?>