<?php 
$db = new DBManager();
$where='' ;
$status = "";
$bedspace	= $_REQUEST['bedspace'];
$status	= $_REQUEST['status'];
$flag = $db->blockunblockbedspace($bedspace,$status);

?>