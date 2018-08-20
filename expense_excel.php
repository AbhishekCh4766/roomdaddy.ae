<?php
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




  $filename = "Expense Sheet" . time() . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

$link = mysqli_connect($mysqli_host,$mysqli_user,$mysqli_password,$mysqli_database);
//$query = 'SELECT * FROM `tbl_building`';
// $query = 'SELECT `tbl_admin`.`fld_name`, `tbl_building`.`fld_rent`, `tbl_building`.`fld_comission`, `tbl_chqs`.`fld_chq_num`, `tbl_chqs`.`fld_chq_date`, `tbl_chqs`.`fld_chq_owner`, `tbl_chqs`.`fld_chq_amount`, `tbl_building`.`fld_building`, `tbl_building`.`fld_apt_no`
// FROM `tbl_building`
    // LEFT JOIN `tbl_admin` ON `tbl_building`.`fld_tanent` = `tbl_admin`.`fld_id`
    // LEFT JOIN `tbl_chqs` ON `tbl_building`.`fld_id` = `tbl_chqs`.`fld_building_id`';

// $query="SELECT
		// `tbl_building`.`fld_building` AS 'building',
		// `tbl_building`.`fld_apt_no` AS 'apt',
		// `tbl_expense`.`fld_expense_type` AS 'expense_type',
		// `tbl_expense`.`fld_expense` AS 'expense',
		// `tbl_expense`.`fld_payment_to` AS 'payment_to',
		// `tbl_expense`.`fld_payment_by` AS 'payment_by',
		// `tbl_expense`.`fld_description` AS 'description'
		// FROM
		// `tbl_expense` INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_expense`.`fld_expense_on`
		// WHERE `tbl_expense`.`fld_date`='2017-07'";
		
$query="SELECT 
		`tbl_expense`.`fld_expense_type` AS 'expense_type',
		`tbl_expense`.`fld_expense` AS 'expense',
		`tbl_expense`.`fld_payment_to` AS 'payment_to',
		`tbl_expense`.`fld_payment_by` AS 'payment_by',
		`tbl_expense`.`fld_description` AS 'description'
		from 
		`tbl_expense` WHERE `fld_date`='2017-10' AND `fld_expense_on`='0'";
	// $query="
	// SELECT 
	// `tbl_expense`.`fld_update_date` AS 'recievedon',
	// `tbl_expense`.`fld_date` AS 'rentof',
	// `tbl_expense`.`fld_expense` AS 'rent',
	// `tbl_building`.`fld_building` AS 'building',
	// `tbl_building`.`fld_apt_no` AS 'aptno',
	// `tbl_expense`.`fld_payment_to` AS 'paytment_to',
	// `tbl_expense`.`fld_payment_by` AS 'paytment_by',
	// `tbl_expense`.`fld_expense_type` AS 'expense_type'
	// from
	// `tbl_expense` 
	// INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_expense`.`fld_expense_on`
	// WHERE `tbl_expense`.`fld_date`='2017-10'
	// ";
	// $	
$result = mysqli_query($link, $query);
print "Building\tAppartment\tExpense Type\tExpense\tPayment To\tPayment By\tDescription\n";
while ($row = mysqli_fetch_row($result))
{
 print implode("\t", $row) . "\n";
}

mysqli_close($link);
?>