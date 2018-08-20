<?php 
$db = new DBManager();
$where='' ;
$status = "";
$image_id	= $_REQUEST['id'];
/*
print_r($image_id);
die;*/
$flag = $db->DeletePropertyImageById($image_id);
echo $_REQUEST['date'];
?>