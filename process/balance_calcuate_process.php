<?php 
$db = new DBManager();
$getRoom=$db->getRoomsById($_REQUEST['room']);
$getTanent=$db->getTanentById($getRoom[0]['fld_tanent']);
echo $getTanent[0]['fld_rent']-$_REQUEST['deposit'];
?>