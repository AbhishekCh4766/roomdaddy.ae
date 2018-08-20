<?php 
include_once("dbbridge/top.php");
$db = new DBManager();
$error_msg="";
$chqid=base64_decode($_REQUEST['chqid']);
$chq_date=$_REQUEST['chq_year']."-".$_REQUEST['chq_month']."-".$_REQUEST['chq_date'];
$chq_date_till=$_REQUEST['chq_year_till']."-".$_REQUEST['chq_month_till']."-".$_REQUEST['chq_date_till'];
// updateChqById($id,$chq_owner,$chq_amount,$chq_date,$chq_date_till,$chq_num)
if($error_msg=="")
{
		$flag = $db->updateChqById(
						SG_Validate_Input($chqid,INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['chq_owner'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['chq_amount'],INPUT_TYPE_TEXT),
						SG_Validate_Input($chq_date,INPUT_TYPE_TEXT),
						SG_Validate_Input($chq_date_till,INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['chq_num'],INPUT_TYPE_TEXT)
						);
		echo "Chq Details Updated";
	
}
else
{
	echo $error_msg;
}
?>