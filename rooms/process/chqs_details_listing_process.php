<?php 
$db = new DBManager();
$year=$_REQUEST['year'];
if($_REQUEST['owner']!="")
{
	$owner=base64_decode($_REQUEST['owner']);
}
else
{
	$owner="";
}
$where='' ;
?>

								
<tr>
	<th>Total</th>
	<?php
	
	for($i=1;$i<=12;$i++)
	{	
		if($i<=9)
		{
			$i="0".$i;
		}
		if($owner=="")
		{
			$getChqAmount=$db->GetSumOfChqAmountForChqDetail($i,$year);
		}
		else
		{
			$getChqAmount=$db->GetSumOfChqAmountForChqDetailOwner($i,$year,$owner);
		}
		if($getChqAmount[0]!="")
		{
			?>
				<td style="background-color:rgb(226,107,10);color:white;">
					<?php
						if($getChqAmount[0]['amount']=="")
						{
							echo "0";
						}
						else
						{
							echo number_format($getChqAmount[0]['amount']);
						}
					?>
				</td>
			<?php
		}
	}
	
	?>
</tr>

	<?php
	if($owner=="")
	{
		$GetAllBuildings=$db->getAllBuilding();
	}
	else
	{
		$GetAllBuildings=$db->getAllBuildingByOwner($owner);
	}
	foreach($GetAllBuildings as $building)
		{
			?>
			<tr>
				<th><?=$building['fld_building']?> <?=$building['fld_apt_no']?></th>
				<?php
				for($i=1;$i<=12;$i++)
				{
					if($i<=9)
					{
						$i="0".$i;
					}
					?>
					
					<?php
					$getChqAmount=$db->GetChqAmountForChqDetail($building['fld_id'],$i,$year);
					if($getChqAmount[0]!="")
					{
						$style="";
						$curt_date=date("Y-m-d");
						if($curt_date>$getChqAmount[0]['fld_chq_date'])
						{
							$style.='style="background-color:rgb(118,147,80);color:white"';
						}
						?>
						<td <?=$style?>>
						<?php
							echo number_format($getChqAmount[0]['fld_chq_amount']);
						?>
						</td>
						<?php
					}
					else
					{
						?>
						<td></td>
						<?php
					}												
					?>
					
					<?php
				}
				?>
			</tr>
			<?php
		}
	?>
