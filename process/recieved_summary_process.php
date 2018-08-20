<?php 
$db = new DBManager();
$am = new AdminManager();
$where='' ;
$status = "";
$date        = $_REQUEST['date'];
$userid		=	$_REQUEST['uid'];
if($date=="")
{
	echo "<tr><td colspan='2'>No Record Found</td></tr>";
}
$recieved=0;
$fleets = $db->getAllBuildings($userid);
//print_r($fleets);exit;
if($fleets[0]!="")
{
	if($fleets)
	{
		$grossRecieved=0;
		foreach($fleets as $room)
		{
			?>
			<tr style="display:none;" class="recieved_apt rec_apt<?=$room['fld_id']?>" onclick="expand_rooms(<?=$room['fld_id']?>)" style="cursor:pointer;">
				<td style="cursor:pointer;" >
				<b>
				<?php
					echo $room['fld_building']." ".$room['fld_apt_no'];
				?>
				</b>
				<span style="float:right;"  style="cursor:pointer;" class="rec_expand<?=$room['fld_id']?>">+</span>
				</td>
				<td>
					<b>
					<?php
					$totalByApt=0;
					$getRoomsByBID=$db->getRoomsByBuilding($room['fld_id']);
					foreach($getRoomsByBID as $getRooms)
					{
						if($getRoomsByBID[0]!="")
						{
							$getAptViseSummary=$db->GetRecievedSummaryByMonth($date,$getRooms['fld_id']);
							foreach($getAptViseSummary as $getSummary)
							{
								
								if($getAptViseSummary[0]!="")
								{
									$totalByApt=$totalByApt+$getSummary['fld_rent_paid'];
								}
							}
						}
					}
					echo number_format($totalByApt);
					?>
					</b>
				</td>
			</tr>
				<?php
					$getRoomsByBID=$db->getRoomsByBuilding($room['fld_id']);
					foreach($getRoomsByBID as $getRooms)
					{
						if($getRoomsByBID[0]!="")
						{
							?>
							<tr  class="rec_class<?=$room['fld_id']?>" style="display:none;">

								<td>	
								<?php
								$getTanent=$db->getTanentById($getRooms['fld_tanent']);
								$TanentViseRent=$db->GetRecievedSummaryByMonthAndTanent($date,$getTanent[0]['fld_id']);
								if($TanentViseRent[0]!="")
								{
									if($getTanent[0]!="")
									{	
										echo $getTanent[0]['fld_name']." ".$getRooms['fld_room_name']." Collected By ".$TanentViseRent[0]['fld_collected_by'];
									}
								}
								?>						
								</td>
								<td>
									<?php
									if($getTanent[0]!="")
									{
										$TanentViseRent=$db->GetRecievedSummaryByMonthAndTanent($date,$getTanent[0]['fld_id']);
										$TTRent=0;
										if($TanentViseRent[0]!="")
										{
											foreach($TanentViseRent as $TRent)
											{
												$TTRent=$TTRent+$TRent['fld_rent_paid'];
											}
										}
										echo number_format($TTRent);
									}
									?>
								</td>
							</tr>
					<?php
						}
						?>
						<!--
						
							<?php
							$breakdown=$db->GetBreakDownForCashFlowByTanentandDate($date,$getRooms['fld_tanent']);
								if($breakdown[0]!="")
								{
								foreach($breakdown as $break)
								{
									?>
									<tr>
									<td>
										<?=$break['fld_paid_date']?>
									</td>
									<td>
										<?=$break['fld_rent_paid']?>
									</td>
									</tr>
									<?php
								}
								}
							?>-->
						
						<?php
					}
				?>
				
	<?php
	$grossRecieved=$grossRecieved+$totalByApt;
		}
		?>
		<tr>
			<th>Total</th>
				<th>
					<?php
					echo number_format($grossRecieved);
					?>
				
			</th>
		</tr>
		<?php
	}
}
else
{
	?>
	<option value="">No Room Available in This Appartment</option>
	<?php
}
?>