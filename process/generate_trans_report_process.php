<?php 
include("../dbbridge/DBManager.php");
$db = new DBManager();
$filename = "Enron Sheet" . time() . ".xls";
$ofrom=$_REQUEST['from_year']."-".$_REQUEST['from_month']."-".$_REQUEST['from_date'];
$oto=$_REQUEST['to_year']."-".$_REQUEST['to_month']."-".$_REQUEST['to_date'];
$from = date("Y-m-d",strtotime($ofrom));
$to = date("Y-m-d",strtotime($oto));
$mysqli_user = "root";
$mysqli_password = "";
$mysqli_host = "localhost";
$mysqli_database = "leasing";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
$query="";

print "Date\tMonth\tFrom\tTo\tAmount\tDescription\n";
$getTransactions=$db->GetAllTransactionByDateFilters($from,$to);

foreach($getTransactions as $trans)
{
	echo $trans['fld_payment_date']."\t";
	echo date("M",strtotime($trans['fld_payment_date']))."\t";
	echo $trans['fld_payment_by']."\t";
	echo $trans['fld_payment_to']."\t";
	echo $trans['fld_payment']."\t";
	echo $trans['fld_description']."\n";
}
?>