<?php 
$db = new DBManager();
$where='' ;
$status = "";
$id	= $_REQUEST['id'];
$flag = $db->DeleteExpenseTypebyId($id);
?>