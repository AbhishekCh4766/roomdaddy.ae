<?php 
$db = new DBManager();
$where='' ;
$status = "";
$image_id	= $_REQUEST['id'];
$flag = $db->DeletePicsById($image_id);
echo $_REQUEST['date'];
?>