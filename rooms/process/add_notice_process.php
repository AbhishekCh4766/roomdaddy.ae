<?php 
include_once("dbbridge/top.php");
$db = new DBManager();
$error_msg="";
//echo $_REQUEST['id'];
$getTanentId=$db->GetRoomById($_REQUEST['id']);
$AddNoticetoTanent = $db->AddNoticeToTanent($getTanentId[0]['fld_tanent']);
$addNotice = $db->AddNotice($_REQUEST['id']);
echo "Notice added successfully";
?>