<?php 
$db = new DBManager();
$date=$_REQUEST['rent_year']."-".$_REQUEST['rent_month'];
$room=base64_decode($_REQUEST['roomid']);
$getRoom=$db->getRoomsById($room);
$getSummary=$db->GetRecievedSummaryByMonthAndTanent($date,$getRoom[0]['fld_tanent'],$room);
if($getSummary[0]!="")
{
	echo $getSummary[0]['fld_rent_paid'];
	echo "balance-";
	echo $getSummary[0]['fld_balance'];
	echo "date-";
	echo $date;
	echo "rentid-";
	echo $getSummary[0]['fld_id'];
}
else
{
	$tanent=$getRoom[0]['fld_tanent'];
	$getTanent=$db->getTanentById($tanent);
	//echo "Rent Not Paid Yet";
	echo "0";
	echo "balance-";
	echo $getTanent[0]['fld_rent'];
	echo "date-";
	echo $date;
	echo "rentid-";
	echo "0";
}
?>