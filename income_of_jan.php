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

$query="SELECT `fld_name` , `fld_deposit` from `tbl_tanents` WHERE `fld_is_current_tanent`='1'";

$result = mysqli_query($link, $query);
print "Name\tDeposit\n";
while ($row = mysqli_fetch_row($result)){
 print implode("\t", $row) . "\n";
}
mysqli_close($link);
?>