<?php 
$db = new DBManager();
$getTanent=$db->GetTenantForApproval();
foreach($getTanent as $tanents)
{
	?>
	<tr>
		<td><?=$tanents['name']?></td>
		<td><?=$tanents['building_name']?> <?=$tanents['room_name']?></td>
		<td>View Details</td>
		<td>Approve</td>
		<td>Decline</td>
	</tr>
	<?php
}
?>