<?php 
include("../dbbridge/DBManager.php");
$db = new DBManager();
$filename = "Enron Sheet" . time() . ".xls";
$mysqli_user = "root";
$mysqli_password = "";
$mysqli_host = "localhost";
$mysqli_database = "enron_leasing";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
print "ID\tName\tEmail\tNumber\tPWD\tNationality\tRoom\tBedspaceId\tiscurrent\tisNotice\tMoveInDate\tMoveOut\tDeposit\tLastLogin\tUpdateDate\Rent\n";
$getAllRooms=$db->GetAllTanents();
foreach($getAllRooms as $room)
{
	echo $room['fld_id']."\t";
	echo $room['fld_name']."\t";
	echo $room['fld_email']."\t";
	echo $room['fld_number']."\t";
	echo $room['fld_password']."\t";
	echo $room['fld_nationality']."\t";
	echo $room['fld_room']."\t";
	echo $room['fld_bedspace_id']."\t";
	echo $room['fld_is_current_tanent']."\t";
	echo $room['fld_is_notice']."\t";
	echo $room['fld_move_in_date']."\t";
	echo $room['fld_move_out_date']."\t";
	echo $room['fld_deposit']."\t";
	echo $room['fld_last_login']."\t";
	echo $room['fld_update_date']."\t";
	echo $room['fld_rent']."\n";
}
?>