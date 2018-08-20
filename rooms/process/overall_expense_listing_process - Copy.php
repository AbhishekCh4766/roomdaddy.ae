<?php 
$db = new DBManager();
$where='' ;
$status = "";
$date        = $_REQUEST['date'];
if($date=="")
{
	echo "<tr><td colspan='2'>No Record Found</td></tr>";
}
$getExpense=$db->GetExpenseByMonth($date);
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
			<td colspan="5">No Record Found</td>
		</tr>
		<?php
	}
}

$getCommonExpense=$db->GetCommonPoolExpenseByMonth($date);
foreach($getCommonExpense as $Cexpense)
{
	if($getCommonExpense[0]!="")
	{
		?>
		<tr>
			<td>Common Pool</td>
			<td><?=$Cexpense['fld_expense_type']?></td>
			<td><?=$Cexpense['fld_payment_to']?></td>
			<td><?=$Cexpense['fld_expense']?></td>
			<td><?=$Cexpense['description']?></td>
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