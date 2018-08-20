<?php 
$db = new DBManager();
$am = new AdminManager();
$where='' ;
$status = "";
$date		=	$_REQUEST['date'];
$userid		=	$_REQUEST['uid'];
//To get Current Tenants List
$getBuildings=$db->getAllBuildings($userid);
$grandTotal=0;
if($getBuildings[0]!="")
{
	foreach($getBuildings as $building)
	{	
		$getSummaryBuilding=$db->GetRentSummaryByBuilding($building['fld_id'],$date);
		//To Get Total Revenue Apartment Vise Start Here
		$getTotalRentOfApt=$db->GetAllRentedRoomsByBuildingId($building['fld_id']);
		//To Get Total Revenue Apartment Vise End Here
		$rentByApt=0;
		foreach($getSummaryBuilding as $Rent)
		{
		$rentByApt=$rentByApt+$Rent['fld_rent_paid'];
		}
		?>
		<?php
			//echo $TRevenue."-".$rentByApt;
			$TRevenue=0;
			$TotalRecievable=0;
			foreach($getTotalRentOfApt as $totalRent)
			{
				$getTanentById=$db->getTanentById($totalRent['fld_tanent']);
				//print_r($getTanentById);
				foreach($getTanentById as $TanentInfo)
				{
					$TRevenue=$TRevenue+$TanentInfo['fld_rent'];
				}
			}
			echo number_format($TRevenue-$rentByApt);
			$grandTotal=$grandTotal+($TRevenue-$rentByApt);
			if($TRevenue-$rentByApt!=0)
			{
			?>
			
			<tr style="display:none;" class="recievable_details" style="cursor:pointer;" onclick="expand_recievable(<?=$building['fld_id']?>)">
			<th style="cursor:pointer;">
				<?php
				echo $building['fld_building']." ".$building['fld_apt_no'];
				?>
				<span class="expand_recievable<?=$building['fld_id']?>" style="float:right">+</span>
				</th>
				<th style="cursor:pointer;">
				<?php
				$TRevenue=0;
				foreach($getTotalRentOfApt as $totalRent)
				{
					$getTanentById=$db->getTanentById($totalRent['fld_tanent']);
					foreach($getTanentById as $TanentInfo)
					{
						$TRevenue=$TRevenue+$TanentInfo['fld_rent'];
						
					}
					?>
					<?php
					
				}
				$RecievableByapt=$TRevenue-$rentByApt;
				echo number_format($TRevenue-$rentByApt);
				?>
				</th>
			</tr>
			<?php
			$total=0;
			foreach($getTotalRentOfApt as $totalRent)
				{
					$getTanentById=$db->getTanentById($totalRent['fld_tanent']);
					//print_r($getTanentById);
					$TanentRent=0;
					$paidRent=0;
					foreach($getTanentById as $TanentInfo)
					{
						$getRentStatusByMonthANDID=$db->GetRecievedSummaryByMonthAndTanent($date,$TanentInfo['fld_id']);
						$TanentRent=$TanentRent+$TanentInfo['fld_rent'];
						foreach($getRentStatusByMonthANDID as $rentStatus)
						{
							$paidRent=$paidRent+$rentStatus['fld_rent_paid'];
							
						}
						if($TanentRent!=$paidRent)
						{
							?>
							<tr style="display:none;" class="recievable_rooms<?=$building['fld_id']?>">
								<td><?=$TanentInfo['fld_name']?>
								</td>
								<td>
									<?php
									$res=$TanentRent-$paidRent;
									echo number_format($res);
									$total=$total+$res;
									?>
								</td>
							</tr>
							<?php
						}
						
					}
					?>
					<?php
					
				}
			
			?>
			<?php
			foreach($getTotalRentOfApt as $totalRent)
			{
				$getTanentById=$db->getTanentById($totalRent['fld_tanent']);
				foreach($getTanentById as $TanentInfo)
				{
					$collectedRent=0;
					$getCollectedRent=$db->GetRecievedSummaryByMonthAndTanent($date,$TanentInfo['fld_rent']);
					foreach($getCollectedRent as $colectedRent)
					{
						$collectedRent=$collectedRent+$colectedRent['fld_rent_paid'];
					}
				}
			}
			
			?>
			<?php
			
	}
		?>
		<?php
	}
	?>
	<tr>
		<th>
			Total
		</th>
		<th>
			<?php
				echo number_format($grandTotal);
			?>
		</th>
	</tr>
	<?php
}
?>