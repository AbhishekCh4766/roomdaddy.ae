<?php
$db = new DBManager();
$subcomplaint=$_POST['tid'];
?>

<table class="table table-striped table-bordered" >
	<tr>
		<th>
			Message By
		</th>
		<th>
			Message
		</th>
	</tr>
	<?php
	$GetChat=$db->getChatByComplaint($subcomplaint);
	foreach($GetChat as $chat)
	{
		?>
		<tr>
			<td>
			<?php
			if($chat['fld_sender']=="Admin")
			{
				$getAdminName=$db->getAdminNamebyId($chat['fld_sender_id']);
				foreach($getAdminName as $admin)
				{
					echo $admin['fld_name'];
				}
			}
			if($chat['fld_sender']=="Tenant")
			{
				$getTenantName=$db->getTanentById($chat['fld_sender_id']);
				foreach($getTenantName as $tenant)
				{
					echo $tenant['fld_name'];
				}
			}
			?>
			</td>
			<td>
			<?=$chat['fld_message']?>
			</td>
		</tr>
		<?php
	}
	?>
	<tr>
		<td>
			<input type="hidden" value="<?=$subcomplaint?>" name="subcomplaint" id="subcomplaint"/>
			<input type="hidden" value="<?=$_SESSION[ADMIN_SESSION_NAME]['userid']?>" name="senderid" id="senderid"/>
			<input type="hidden" value="Admin" name="sender" id="sender"/>
			<input type="text" name="message" id="message" placeholder="Type to comment..." style="width:80%;" required/>
			
		</td>
		<td>
			<input type="button" class="btn btn-success hovered" id="addthread" value="Submit" onclick="addcomment()"/>
			
		</td>
	</tr>
</table>




                    