<?PHP

// For Live
$mysqli_user = "root";
$mysqli_password = "";
$mysqli_host = "localhost";
$mysqli_database = "leasing";
// For Local
// $mysqli_user = "root";
// $mysqli_password = "";
// $mysqli_host = "localhost";
// $mysqli_database = "leasing";


  $filename = "Income Sheet" . time() . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");


$link = mysqli_connect($mysqli_host,$mysqli_user,$mysqli_password,$mysqli_database);
	// $query="SELECT `tbl_building`.`fld_building`, `tbl_building`.`fld_apt_no`, `tbl_rooms`.`fld_room_name`, `tbl_tanents`.`fld_name`, `tbl_rent_status`.`fld_rent_paid`, `tbl_admin`.`fld_name`,`tbl_rent_status`.`fld_date`
// FROM `tbl_rent_status`
    // LEFT JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_rent_status`.`fld_landlord_id`
    // LEFT JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_rent_status`.`fld_tanent_id`
    // LEFT JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rent_status`.`fld_building_id`
    // LEFT JOIN `tbl_rooms` ON `tbl_rooms`.`fld_id`=`tbl_rent_status`.`fld_room_id`
    // WHERE `tbl_rent_status`.`fld_date`='2017-07'";
	
	$query="
		SELECT `fld_date`,
				`fld_expense_on`,
				`fld_expense_type`,
				`fld_payment_to`,
				`fld_payment_by`,
				`fld_expense`,
				`fld_description`
			from `tbl_expense` WHERE `fld_expense_on`='0'
	";
$result = mysqli_query($link, $query);
print "Date\tExpense On\tExpense Type\tPayment to\tPayment By\tExpense\tDescription\n";
while ($row = mysqli_fetch_row($result)){

 print implode("\t", $row) . "\n";
}
mysqli_close($link);
?>