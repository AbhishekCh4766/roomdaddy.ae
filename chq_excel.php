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
	$query="SELECT `tbl_admin`.`fld_name`, `tbl_chqs`.`fld_chq_num`, DATE_FORMAT(`tbl_chqs`.`fld_chq_date`,'%d %M %Y'), DATE_FORMAT(`tbl_chqs`.`fld_chq_date_till`,'%d %M %Y'), `tbl_chqs`.`fld_chq_owner`, `tbl_chqs`.`fld_chq_amount`, `tbl_building`.`fld_building`, `tbl_building`.`fld_apt_no`
 FROM `tbl_building`
    LEFT JOIN `tbl_admin` ON `tbl_building`.`fld_tanent` = `tbl_admin`.`fld_id`
   LEFT JOIN `tbl_chqs` ON `tbl_building`.`fld_id` = `tbl_chqs`.`fld_building_id`
";
	
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_row($result)){
 print implode("\t", $row) . "\n";
}
mysqli_close($link);
?>