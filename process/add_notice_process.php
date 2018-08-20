<?php 
include_once("dbbridge/top.php");
$db = new DBManager();
$error_msg="";


$getTanentId=$db->GetBedspaceById($_REQUEST['id']);
$AddNoticetoTanent = $db->AddNoticeToTanent($getTanentId[0]['fld_tanent_id']);
$addNotice = $db->AddNotice($getTanentId[0]['fld_tanent_id']);
echo "Notice added successfully";
?>