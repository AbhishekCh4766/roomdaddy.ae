<?php 
$db = new DBManager();
$where='' ;
$status = "";
$buildingid        = $_REQUEST['buildingid'];
if($buildingid=="")
{
	echo "<tr><td colspan='2'>No Record Found</td></tr>";
}
$fleets = $db->getRoomsByBuildingToBook($buildingid);
//print_r($fleets);exit;
if($fleets[0]!="")
{
	if($fleets)
	{
		foreach($fleets as $room)
		{
			?>
			<option value="<?=$room['fld_id']?>"><?=$room['fld_room_name']?></option>
	<?php
		}
	}
}
else
{
	?>
	<option value="">No Room Available in This Appartment</option>
	<?php
}
?>