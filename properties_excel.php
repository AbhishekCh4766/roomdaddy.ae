<?PHP

$mysqli_user = "root";
$mysqli_password = "";
$mysqli_host = "localhost";
$mysqli_database = "leasing";


// For Beta Database
//if(!defined("DB_SERVER"))               define("DB_SERVER", "localhost");
//if(!defined("DB_NAME"))			define("DB_NAME","enron_leasing");
//if(!defined("DB_USER"))			define("DB_USER", "leasing_enron");
//if(!defined("DB_PASSWORD"))             define("DB_PASSWORD", "03337327685");





  $filename = "grading_results_" . time() . ".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

$link = mysqli_connect($mysqli_host,$mysqli_user,$mysqli_password,$mysqli_database);
//$query = 'SELECT * FROM `tbl_building`';
// $query = 'SELECT `tbl_admin`.`fld_name`, `tbl_building`.`fld_rent`, `tbl_building`.`fld_comission`, `tbl_chqs`.`fld_chq_num`, `tbl_chqs`.`fld_chq_date`, `tbl_chqs`.`fld_chq_owner`, `tbl_chqs`.`fld_chq_amount`, `tbl_building`.`fld_building`, `tbl_building`.`fld_apt_no`
// FROM `tbl_building`
    // LEFT JOIN `tbl_admin` ON `tbl_building`.`fld_tanent` = `tbl_admin`.`fld_id`
    // LEFT JOIN `tbl_chqs` ON `tbl_building`.`fld_id` = `tbl_chqs`.`fld_building_id`';

// $query="SELECT `tbl_admin`.`fld_name`, `tbl_building`.`fld_rent`, `tbl_building`.`fld_comission`, `tbl_chqs`.`fld_chq_num`, `tbl_chqs`.`fld_chq_date`, `tbl_chqs`.`fld_chq_owner`, `tbl_chqs`.`fld_chq_amount`, `tbl_building`.`fld_building`, `tbl_building`.`fld_apt_no`
// FROM `tbl_building`
    // LEFT JOIN `tbl_admin` ON `tbl_building`.`fld_tanent` = `tbl_admin`.`fld_id`
    // LEFT JOIN `tbl_chqs` ON `tbl_building`.`fld_id` = `tbl_chqs`.`fld_building_id`";
	
// $query="SELECT `tbl_admin`.`fld_name`,`tbl_building`.`fld_building`, `tbl_building`.`fld_apt_no`, `tbl_building`.`fld_rent`, `tbl_building`.`fld_comission`, `tbl_building`.`fld_deposit`, DATE_FORMAT(`tbl_building`.`fld_contract_starting_date`,'%d %M %Y') AS 'contract_starting_date', DATE_FORMAT(`tbl_building`.`fld_contract_ending_date`,'%d %M %Y') AS 'contract_ending_date'
// FROM `tbl_building`
    // LEFT JOIN `tbl_admin` ON `tbl_building`.`fld_tanent` = `tbl_admin`.`fld_id`";
	print "Building\tApt Num\tRoom Name\tTanent\tRent\n";
	$query="
	SELECT `tbl_building`.`fld_building` AS 'building',
			`tbl_building`.`fld_apt_no` AS 'apt_no',
			`tbl_rooms`.`fld_room_name` AS 'room_name',
			`tbl_tanents`.`fld_name` AS 'tanent_name',
			`tbl_tanents`.`fld_rent` AS 'rent'
			FROM `tbl_building`
			LEFT JOIN `tbl_rooms` ON `tbl_rooms`.`fld_building_id`=`tbl_building`.`fld_id`
			LEFT JOIN `tbl_tanents` ON 	`tbl_tanents`.`fld_id`= `tbl_rooms`.`fld_tanent`
	";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_row($result)){
 print implode("\t", $row) . "\n";
}
mysqli_close($link);
?>