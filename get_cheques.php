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

$query="SELECT 
	`tbl_building`.`fld_building` AS 'building',
    `tbl_building`.`fld_apt_no` AS 'apt',
    `tbl_admin`.`fld_name` AS 'owner',
    `tbl_chqs`.`fld_chq_owner` AS 'chq_owner',
    `tbl_chqs`.`fld_chq_amount` AS 'amount',
    `tbl_chqs`.`fld_chq_date` AS 'chq_date',
    `tbl_chqs`.`fld_chq_date_till` AS 'chq_till'
    FROM `tbl_chqs`
    INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_chqs`.`fld_owner_id`
    INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_chqs`.`fld_building_id`
	";
$result = mysqli_query($link, $query);
print "Building\tAppartment\Owner \tAmount\tChq Date\tChq till\n";
while ($row = mysqli_fetch_row($result))
{
 print implode("\t", $row) . "\n";
}

mysqli_close($link);
?>