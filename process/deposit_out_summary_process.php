<?php 
$db = new DBManager();
$where='' ;
$status = "";
//echo "Hello";exit;
$date        = $_REQUEST['date'];
$userid		=	$_REQUEST['uid'];
if($date=="")
{
	echo "<tr><td colspan='2'>No Record Found</td></tr>";
}
$getDepositSummary=$db->GetDepositOutByOwner($userid,$date);
foreach($getDepositSummary as $deposits)
{
	if($getDepositSummary[0]!="")
	{
		?>
		<tr>
			<td><?=$deposits['tanentname']?></td>
			<td><?=$deposits['roomname']?></td>
			<td><?=$deposits['deposit']?></td>
		</tr>
		<?php
	}
	else
	{
		?>
		<tr>
			<td colspan="5">No Record Found</td>
		</tr>
		<?php
	}
}
?>