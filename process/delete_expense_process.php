<?php 
$db = new DBManager();
$where='' ;
$status = "";
$id	= $_REQUEST['id'];
$flag = $db->DeleteExpenseById($id);
echo $_REQUEST['date'];
?>