<?php 
include("../dbbridge/DBManager.php");
$db = new DBManager();
$filename = "Enron Tenants Sheet" . time() . ".xls";

$mysqli_user = "root";
$mysqli_password = "";
$mysqli_host = "localhost";
$mysqli_database = "leasing";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

print "Building\tApartment\tClient\tRoom\tRent\tDeposit\tOwner\n";
$getCurrentTenants=$db->GetTenents();
if($getCurrentTenants[0]!="")
{
	foreach($getCurrentTenants as $curentTenant)
	{
		echo $curentTenant['building']."\t";
		echo $curentTenant['apt']."\t";
		echo $curentTenant['tenent']."\t";
		echo $curentTenant['room']."\t";
		echo $curentTenant['rent']."\t";
		echo $curentTenant['deposit']."\t";
		echo $curentTenant['owner']."\n";
	}
}
?>