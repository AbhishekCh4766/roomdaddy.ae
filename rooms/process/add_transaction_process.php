<?php
$db = new DBManager();
$error_msg="";
if($_REQUEST['from']=="")
{
	$error_msg.="Please Select From<br>";
}
if($_REQUEST['to']=="")
{
	$error_msg.="Please Select To<br>";
}
if($_REQUEST['from']==$_REQUEST['to'])
{
	$error_msg.="From and To should be different<br>";
}
if($_REQUEST['payment']=="" || $_REQUEST['payment']==0)
{
	$error_msg.="Payment can not be null or greater then zero<br>";
}
if($error_msg=="")
{
	$date=$_REQUEST['year']."-".$_REQUEST['month']."-".$_REQUEST['date'];
	//function AddTransaction($form,$to,$date,$description);
	$flag	=	$db->AddTransaction(
									SG_Validate_Input($_REQUEST['from'],INPUT_TYPE_TEXT),
									SG_Validate_Input($_REQUEST['to'],INPUT_TYPE_TEXT),
									SG_Validate_Input($date,INPUT_TYPE_TEXT),
									SG_Validate_Input($_REQUEST['description'],INPUT_TYPE_TEXT),
									SG_Validate_Input($_REQUEST['payment'],INPUT_TYPE_TEXT),
									SG_Validate_Input($_REQUEST['trans_by'],INPUT_TYPE_TEXT)
									);
	echo "done-Transaction Successfull";
}

else
{
	echo $error_msg;
}

?>