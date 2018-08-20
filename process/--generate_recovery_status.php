<?php 
//include("../dbbridge/DBManager.php");
$db = new DBManager();
print "Building\tApartment\tRoom\tClient\tNumber\tAmount\n";

$getCurrentTenants=$db->GetCurrentTanentsId();
if($getCurrentTenants[0]!="")
{
	foreach($getCurrentTenants as $curentTenant)
	{
		$getCurrentRentStatus=$db->GetRentStatusOfCurrentMonth($curentTenant['fld_id']);
		//print_r($getCurrentRentStatus);
		if($getCurrentRentStatus[0]['rent']!=$curentTenant['fld_rent'])
		{
			echo $curentTenant['fld_name']."\t";
			echo $getCurrentRentStatus[0]['rent']-$curentTenant['fld_rent']."\n";

		}
	}
}
?>