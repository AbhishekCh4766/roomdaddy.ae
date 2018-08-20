<?php 
include("../dbbridge/DBManager.php");
$db = new DBManager();
$filename = "Enron Rooms Sheet" . time() . ".xls";

$mysqli_user = "root";
$mysqli_password = "";
$mysqli_host = "localhost";
$mysqli_database = "leasing";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
print "Building\tApartment\tRoom\tTenant\tNumber\tEmail\tMove in Date\tRent\tDeposit\tOwner\n";
$getCurrentTenants=$db->GetAllRoomsforReport();
if($getCurrentTenants[0]!="")
{
	foreach($getCurrentTenants as $curentTenant)
	{
		echo $curentTenant['building']."\t";
		echo $curentTenant['apt']."\t";
		echo $curentTenant['room']."\t";
		$getTenantInfo=$db->getTanentByRoom($curentTenant['id']);
		if($getTenantInfo[0]!="")
		{
			echo $getTenantInfo[0]['tanentname']."\t";
			echo $getTenantInfo[0]['tanentnumber']."\t";
			echo $getTenantInfo[0]['tanentemail']."\t";
			echo $getTenantInfo[0]['tanentmovein']."\t";
			echo $getTenantInfo[0]['tenantrent']."\t";
			echo $getTenantInfo[0]['tanentdeposit']."\t";
		}
		else
		{
			echo "-\t";
			echo "-\t";
			echo "-\t";
			echo "-\t";
			echo $curentTenant['room_expected_rent']."\t";
			echo "-\t";
			
		}
		echo $curentTenant['owner']."\n";
	}
}
?>
