<?php 
$db = new DBManager();
$where='' ;
$status = "";
$date      = $_REQUEST['date'];
$userid		=	$_REQUEST['uid'];
if($date=="")
{
	echo "<tr><td colspan='2'>No Record Found</td></tr>";
}
$getExpense=$db->GetExpenseByMonthAndOwner($date,$userid);
foreach($getExpense as $expense)
{
	if($getExpense[0]!="")
	{
		?>
		<tr>
			<td><?=$expense['building']?> <?=$expense['apt']?></td>
			<td><?=$expense['expense_type']?></td>
			<td><?=$expense['payment_to']?></td>
			<td><?=$expense['expense']?></td>
			<td><?=$expense['description']?></td>
		</tr>
		<?php
	}
	else
	{
		?>
		<tr>
			<td colspan="5">
				No Record Found
			</td>
		</tr>
		<?php
	}
}
?>