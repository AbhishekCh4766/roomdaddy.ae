<?php
include_once("DBAccess.php");

Class RoleManager extends DBAccess
{
	function getallusers(){
		$this->connectToDB();

		$sql="select * from tbl_role_assign";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
}