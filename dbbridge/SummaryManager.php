<?php
@session_start();
include_once("DBAccess.php");

//include_once("AdminManager.php");

Class SummaryManager extends DBAccess
{
	function GetUniqueExpenseMonths()
	{
		$this->connectToDB();
		$sql="SELECT DISTINCT(`fld_date`) FROM `tbl_expense` WHERE 1";
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	// function GetAppartmentViseExpense()
	// {
		
	// }
}
?>