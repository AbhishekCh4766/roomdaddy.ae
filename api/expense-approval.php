<?php

require 'common.php';
 
 
  $sql="SELECT * from `tbl_expense` where `is_approved` = '0'";
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
                        'fld_expense_on' => $row['fld_expense_on'],
                        'fld_expense_type' => $row['fld_expense_type'],
                        'fld_payment_to' => $row['fld_payment_to'],
                        'fld_payment_by' => $row['fld_payment_by'],
                        'fld_charge_to' => $row['fld_charge_to'],
                        'fld_expense' => $row['fld_expense'],
                        'fld_description' => $row['fld_description'],
                        'is_approved' => $row['is_approved'],
                        'approved_by' => $row['approved_by'],
                        'fld_date' => $row['fld_date']
                      );
            array_push($json, $bus);
        }

        $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$json);
    }else {
        $jsonstring =array('status'=>false,'message'=>"Unsuccessfull");
    }

     echo json_encode($jsonstring);

   mysqli_close($con);

?>