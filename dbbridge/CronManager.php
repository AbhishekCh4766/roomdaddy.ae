<?php
@session_start();
include_once("DBAccess.php");

//include_once("AdminManager.php");

Class CronManager extends DBAccess
{
	function GetAllRoomsForCron()
	{
		$this->connectToDB();
		$sql = "SELECT * from `tbl_rooms` WHERE `fld_is_notice`='1' OR `fld_is_notice`='2' OR `fld_is_rented`='2'";
		//echo $sql;exit;
		$result = $this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function updateVacantRoom($id)
	{
		$this->connectToDB();
		$sql="update `tbl_rooms` set `fld_is_notice`='0',`fld_tanent`='0',`fld_is_rented`='0' where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function updateRentedRoom($id)
	{
		$this->connectToDB();
		$sql="update `tbl_rooms` set `fld_is_notice`='0',`fld_is_rented`='1' where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
}
?>