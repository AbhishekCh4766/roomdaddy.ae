<?php 
$db = new DBManager();
$where='' ;

$status = "";

$buildingid        = $_REQUEST['buildingid'];
if($buildingid=="")
{
	echo "<tr><td colspan='2'>No Record Found</td></tr>";
	exit;
}

$fleets = $db->getRoomsByBuilding($buildingid);
if($fleets)
{
	foreach($fleets as $room)
	{
		?>
		<tr>
			<td>
				<?=$room['fld_room_name']?>
			</td>
			<td>
				<?php
					if($room['fld_is_rented']==1 && $room['fld_is_notice']==0)
					{
						echo "<b onclick='addnotice(".$room['fld_id'].");' style='cursor: pointer;';>Rented</b> click for notice";
					}
					else if($room['fld_is_notice']==0  && $room['fld_is_rented']==0)
					{
						echo "Vacant";
					}
					else if($room['fld_is_notice']==0  && $room['fld_is_rented']==2)
					{
						echo "<b style='cursor: pointer;';>Rented</b>";
					}
					else if($room['fld_is_notice']==1  && $room['fld_is_rented']==1)
					{
						echo "Notice";
					}
				?>
			</td>
			<td>
				<?php
				$checkStatus=$db->checkCurrentMonthRentStatusByID($room['fld_id']);
				// if($checkStatus[0]=="")
				// {
					// echo "Not Paid";
				// }
				
				
				if($room['fld_is_rented']!=0)
				{
					if($checkStatus[0]=="")
					{
						echo "<a href='pay_rent.php?roomid=".base64_encode($room['fld_id'])."'>Not Paid</a>";
					}
					else
					{
						$sum=0;
						foreach($checkStatus as $sumRent)
						{
							$sum=$sum+$sumRent['fld_rent_paid'];
						}
						$getTanentRent = $db->getTanentById($room['fld_tanent']);
						if($sum==$getTanentRent[0]['fld_rent'])
						{
							echo "Rent Paid for this month";
						}
						else
						{
							$remaining=$getTanentRent[0]['fld_rent']-$sum;
							echo "<a href='pay_rent.php?roomid=".base64_encode($room['fld_id'])."'>".$remaining." Remaining</a>";
						}
						//echo "Paid ".$sum;
					}
					//echo "<a href='pay_rent.php?roomid=".base64_encode($room['fld_id'])."'>Pay Rent</a>";
				}
				else
				{
					echo "Room Vacant";
				}
				?>
			</td>
			<td>
			<?php
			if($room['fld_is_notice']==0  && $room['fld_is_rented']==0)
			{
				echo "<a class='group2' href='add_client.php?building=".base64_encode($room['fld_building_id'])."&room=".base64_encode($room['fld_id'])."'>Book</a>";
			}
			else if($room['fld_is_notice']==1  && $room['fld_is_rented']==1)
			{
				echo "<a class='group2' href='add_client.php?building=".base64_encode($room['fld_building_id'])."&room=".base64_encode($room['fld_id'])."'>Book</a>";
			}
			else if($room['fld_is_rented']==1 && $room['fld_is_notice']==0)
			{
				echo "Booked";
			}
			else if($room['fld_is_rented']==2 && $room['fld_is_notice']==0)
			{
				echo "Booked";
			}
			?>
			</td>
			<td>
				<?php
				$getTanentRent = $db->getTanentById($room['fld_tanent']);
				if($getTanentRent[0]!="")
				{
					echo $getTanentRent[0]['fld_name']."(".$getTanentRent[0]['fld_rent'].")";
				}
				else
				{
					echo "Vacant";
				}
				?>
			</td>
		</tr>
<?php
	}
}
?>