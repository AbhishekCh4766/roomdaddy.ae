<?php 
$db = new DBManager();

$getExpenseType=$db->GetExpenseType();
foreach($getExpenseType as $expense)
{
	if($getExpenseType[0]!="")
	{
		?>
		<tr>
			<td><?=$expense['fld_expense_type']?></td>
			<td><span onclick="delete_expense_type('<?=$expense['fld_id']?>')" style="cursor:pointer;"><i class="fa fa-trash"></i></span></td>
		</tr>
		<?php
	}
	else
	{
		?>
		<tr>
			<td colspan="2">
				No Record Found
			</td>
		</tr>
		<?php
	}
}
?>