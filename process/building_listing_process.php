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
$fleets = $db->getAllBuildings($buildingid);
if($fleets)
{
	foreach($fleets as $room)
	{
		?>
		<tr>
			<td><a style="color:green;" href="<?=SERVER_PATH?>add_property.php?bid=<?=base64_encode($room['fld_id'])?>"><?=$room['fld_building']?> <?=$room['fld_apt_no']?></a></td>
			<td style="color:green;">
				<?=date("d M Y",strtotime($room['fld_contract_starting_date']))?>
			</td>
			<td style="color:green;">
				<?=date("d M Y",strtotime($room['fld_contract_ending_date']))?>
			</td>
			<td style="color:green;">
				<?=$room['fld_rent']?>
			</td>
			<td style="color:green;">
				<?=$room['fld_comission']?>
			</td>
			<td>
				<?php
					$current_date=strtotime(date("Y-m-d"));
					$endingdate=strtotime($room['fld_contract_ending_date']);
					if($endingdate<=$current_date)
					{
						?>
						<a class="btn btn-success" href="<?=SERVER_PATH?>add_property.php?bid=<?=base64_encode($room['fld_id'])?>&pbuid=6534a22f293f9bba01a5230de8e2ffd8">Update</a>
						<?php
					}
					else if(ceil(abs($endingdate - $current_date) / 86400)<=30)
					{
						?>
						<a class="btn btn-success" href="<?=SERVER_PATH?>add_property.php?bid=<?=base64_encode($room['fld_id'])?>&pbuid=6534a22f293f9bba01a5230de8e2ffd8">Advance Update <?=ceil(abs($endingdate - $current_date) / 86400)?> Days Left</a>
						<?php
					}
					else
					{
						?>
						<input type="submit" class="btn btn-disabled" onClick="return update_contract();"  name="update_contract" value="<?=ceil(abs($endingdate - $current_date) / 86400)?> Days Left"/>
						<?php
					}
					
				?>
			</td>
		</tr>
		<tr>
			<th>
				Cheque Number
			</th>
			<th>
				Cheque Date
			</th>
			<th>
				Cheque Till
			</th>
			<th>
				Cheque Amount
			</th>
			<th>
				Cheque By
			</th>
		
		</tr>
		
<?php
	$cheques	=	$db->GetchqsyBuildingId($room['fld_id']);
	{
		if($cheques[0]!="")
		{
			foreach($cheques as $chq)
			{
				?>
				<tr>
					<td style="color:red;"><a style="color:red;" href="<?=SERVER_PATH?>edit_cheque.php?chid=<?=base64_encode($chq['fld_id'])?>"><?=$chq['fld_chq_num']?></a></td>
					<td style="color:red;"><?=date("d M Y",strtotime($chq['fld_chq_date']))?></td>
					<td style="color:red;"><?=date("d M Y",strtotime($chq['fld_chq_date_till']))?></td>
					<td style="color:red;"><?=$chq['fld_chq_amount']?></td>
					<td style="color:red;"><?=$chq['fld_chq_owner']?></td>
					
				</tr>
				<?php
			}
		}
		else
		{
			?>
			<tr style="display:none;">
				<th colspan="4">No Cheque Details Found</th>
			</tr>
			<?php
		}
	}
	}
}
?>