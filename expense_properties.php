<?PHP

$mysqli_user = "leasing_enron";
$mysqli_password = "03337327685";
$mysqli_host = "localhost";
$mysqli_database = "enron_leasing";


// For Beta Database
//if(!defined("DB_SERVER"))               define("DB_SERVER", "localhost");
//if(!defined("DB_NAME"))			define("DB_NAME","enron_leasing");
//if(!defined("DB_USER"))			define("DB_USER", "leasing_enron");
//if(!defined("DB_PASSWORD"))             define("DB_PASSWORD", "03337327685");





  $filename = "grading_results_" . time() . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

$link = mysqli_connect($mysqli_host,$mysqli_user,$mysqli_password,$mysqli_database);
	$query="SELECT `tbl_building`.`fld_building`, `tbl_building`.`fld_apt_no`, `tbl_expense`.`fld_expense_type`, `tbl_expense`.`fld_payment_to`, `tbl_expense`.`fld_payment_by`, `tbl_expense`.`fld_date`
FROM `tbl_expense`
INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_expense`.`fld_expense_on`
";
	
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_row($result)){
 print implode("\t", $row) . "\n";
}
mysqli_close($link);
?>