<?php 
include("../dbbridge/DBManager.php");
$db = new DBManager();
$filename = "Enron Sheet" . time() . ".xls";
$ofrom=$_REQUEST['from_year']."-".$_REQUEST['from_month']."-".$_REQUEST['from_date'];
$oto=$_REQUEST['to_year']."-".$_REQUEST['to_month']."-".$_REQUEST['to_date'];
$from = date("Y-m-d",strtotime($ofrom));
$to = date("Y-m-d",strtotime($oto));
$mysqli_user = "root";
$mysqli_password = "";
$mysqli_host = "localhost";
$mysqli_database = "leasing";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");


//print "ID\tName\tEmail\tNumber\tpassword\tNationality\tRoom\tBedspaceId\tIscurrentTanent\tIsNotice\tMoveinDate\tMoveoutDate\tDeposit\tLastLogin\tUpdateDate\tRent\n";
//`fld_id`, `fld_room_id`, `fld_is_bedspace`, `fld_is_rented`, `fld_is_notice`, `fld_tanent_id`, `fld_update_date`
// print "ID\tRoomID\tBedspaceID\tisRented\tisNotice\tTanentid\tUpdateDate\n";
// $getAllBedspaces=$db->GetBedspacess();
// foreach($getAllBedspaces as $bedspace)
// {
	// echo $bedspace['fld_id']."\t";
	// echo $bedspace['fld_room_id']."\t";
	// echo $bedspace['fld_is_bedspace']."\t";
	// echo $bedspace['fld_is_rented']."\t";
	// echo $bedspace['fld_is_notice']."\t";
	// echo $bedspace['fld_tanent_id']."\t";
	// echo $bedspace['fld_update_date']."\n";
// }
 $getAllTanents=$db->GetTanents();
foreach($getAllTanents as $tanents)
{
	echo $tanents['fld_id']."\t";
	echo $tanents['fld_name']."\t";
	echo $tanents['fld_email']."\t";
	echo $tanents['fld_number']."\t";
	echo $tanents['fld_password']."\t";
	echo $tanents['fld_nationality']."\t";
	echo $tanents['fld_room']."\t";
	echo $tanents['fld_bedspace_id']."\t";
	echo $tanents['fld_is_current_tanent']."\t";
	echo $tanents['fld_is_notice']."\t";
	echo $tanents['fld_move_in_date']."\t";
	echo $tanents['fld_move_out_date']."\t";
	echo $tanents['fld_deposit']."\t";
	echo $tanents['fld_last_login']."\t";
	echo $tanents['fld_update_date']."\t";
	echo $tanents['fld_rent']."\t";
	$getRoomName=$db->GetRoomById($tanents['fld_room']);
	echo $getRoomName[0]['fld_room_name']."\n";
}
// print "Date\tMonth\tOwner\tAmount\tBuilding\tApartment num\tClient\tPaid By\Recieved By\tDescription\tAccount Head\tType\tRoom\n";
// $getExpense=$db->ExpenseFilter($from,$to);
// $getCommonPool=$db->CommonPoolExpenseFilter($from,$to);
// $getDepositin=$db->DepositinFilter($from,$to);
// $getDepositout=$db->DepositOutFilter($from,$to);
// $income=$db->IncomeFilter($from,$to);
// $transfer=$db->GetTransfer($from, $to);
// $getTransactions=$db->GetAllTransactionByDateFilters($from,$to);
// foreach($getDepositin as $depsin)
// {
	// echo $depsin['date']."\t";
	// echo date("M",strtotime($depsin['date']))."\t";
	// echo $depsin['name']."\t";
	// echo $depsin['amount']."\t";
	// echo $depsin['building']."\t";
	// echo $depsin['apt']."\t";
	// echo $depsin['client']."\t";
	// echo $depsin['collected_by']."\t";
	// echo $depsin['description']."\t";
	// echo "Deposit In"."\t";
	// echo "Deposit In"."\t";
	// echo $depsin['room_name']."\n";
// }
// foreach($getDepositout as $depsout)
// {
	// echo $depsout['date']."\t";
	// echo date("M",strtotime($depsout['date']))."\t";
	// echo $depsout['name']."\t";
	// echo "-".$depsout['amount']."\t";
	// echo $depsout['building']."\t";
	// echo $depsout['apt']."\t";
	// echo $depsout['client']."\t";
	// echo $depsin['paid']."\t";
	// echo $depsin['description']."\t";
	// echo "Deposit Out"."\t";
	// echo "Deposit Out"."\t";
	// echo $depsout['room_name']."\n";
// }
// foreach($income as $inc)
// {

	// echo $inc['paid_date']."\t";
	// echo date("M",strtotime($inc['date']))."\t";
	// echo $inc['name']."\t";
	// echo $inc['amount']."\t";
	// echo $inc['building']."\t";
	// echo $inc['apt']."\t";
	// echo $inc['client']."\t";
	// echo $inc['collected_by']."\t";
	// echo $inc['description']."\t";
	// echo "Income\t";
	// echo "Income"."\t";
	// echo $inc['room_name']."\n";
// }
// foreach($getExpense as $res)
// {
	// echo $res['date']."\t";
	// echo date("M",strtotime($res['date']))."\t";
	// echo $res['name']."\t";
	// echo "-".$res['expense']."\t";
	// echo $res['building']."\t";
	// echo $res['apt']."\t";
	// echo $res['payment_to']."\t";
	// echo $res['payment_by']."\t";
	// echo $res['description']."\t";
	// if($res['expense_type']=="Utilities")
	// {
		// echo $res['payment_to']."\t";
	// }
	// else
	// {
		// echo $res['expense_type']."\t";
	// }
	// echo "Expense"."\t";
	// echo "-"."\n";
// }
// foreach($getCommonPool as $common)
// {
	// echo $common['date']."\t";
	// echo date("M",strtotime($common['date']))."\t";
	// echo $common['owner']."\t";
	// echo "-".$common['expense']."\t";
	// echo "Common Pool\t";
	// echo "Common Pool\t";
	// echo $common['payment_to']."\t";
	// echo $common['payment_by']."\t";
	// echo $common['description']."\t";
	// echo $common['expense_type']."\t";
	// echo "Expense"."\t";
	// echo "-"."\n";
// }
// foreach($getTransactions as $trans)
// {
	// echo $trans['fld_payment_date']."\t";
	// echo date("M",strtotime($trans['fld_payment_date']))."\t";
	// echo "-"."\t";
	// echo $trans['fld_payment']."\t";
	// echo "-"."\t"; 	//building
	// echo "-"."\t"; //apt
	// echo $trans['fld_payment_to']."\t";
	// echo $trans['fld_payment_by']."\t";
	// echo $trans['fld_description']."\t";
	// echo "Transaction\t";
	// echo "Transaction\t";
	// echo "-"."\n";
// }
?>