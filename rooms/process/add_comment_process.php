<?php
//die("m in after process");
$db = new DBManager();
//`fld_sub_complain_id`, `fld_sender`, `fld_sender_id`, `fld_message`
$subcomplaint_id=$_REQUEST['subcomplaint'];
$sender=$_REQUEST['sender'];
$senderid=$_REQUEST['senderid'];
$message=$_REQUEST['message'];
$flag=$db->addComment(
					$subcomplaint_id,
					$sender,
					$senderid,
					$message
					);
echo $subcomplaint_id;
?>