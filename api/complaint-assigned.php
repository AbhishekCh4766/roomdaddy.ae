<?php


require 'common.php';
 
 $uid = $_REQUEST['user_id'];

	$sql="SELECT `tbl_sub_complaints`.`fld_complaint_type` AS 'complain',
		`tbl_sub_complaints`.`assigned_by` AS 'assigned',
		`tbl_sub_complaints`.`fld_id` AS 'field',
		`tbl_sub_complaints`.`fld_complaint_id` AS 'complaintId',
		`tbl_sub_complaints`.`assigned_on` AS 'date',
		`tbl_admin`.`fld_name` AS 'name'
		FROM `tbl_sub_complaints`
	    INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_sub_complaints`.`assigned_by` 
		WHERE `tbl_sub_complaints`.`assigned_to`='$uid' 
		AND `tbl_sub_complaints`.`status`='0'";


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
        
        'complain' => $row['complain'],
        'assigned' => $row['assigned'],
        'id' => $row['field'],
        'complaintId' => $row['complaintId'],
        'date' => $row['date'],
        'name' => $row['name'],
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