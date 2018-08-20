<?php 
$db = new DBManager();
$where='WHERE ' ;
$status = "";
$date        = $_REQUEST['date'];
$expense_on  = $_REQUEST['expense_on'];
$expense_type= $_REQUEST['expense_type'];
$type="1";
if($date!="")
{
	$where.=" `tbl_expense`.`fld_date`='$date' AND ";
}
if($expense_on!="")
{
	if($expense_on=="0")
	{
		$type="0";
	}
	else
	{
		$type="1";
	}
	$where.=" `tbl_expense`.`fld_expense_on`='$expense_on' AND ";
}
if($expense_type!="")
{
	$where.=" `tbl_expense`.`fld_expense_type`='$expense_type' AND ";
}
$where.=" TRUE";
$total_expense=0;
$getExpense=$db->GetExpenseByCondition($where,$type);
foreach($getExpense as $expense)
{
	$total_expense=$total_expense+$expense['fld_expense'];
	if($getExpense[0]!="")
	{
		?>
		<tr>
			<td>
				<?php
				if($type=="0")
				{
					echo "Common Pool";
				}
				else
				{
					echo $expense['building']." ".$expense['apt'];
				}
				?>
			</td>
			<td>
				<?php
				if($type=="0")
				{
					echo $expense['fld_expense_type'];
				}
				else
				{
					echo $expense['expense_type'];
				}?>
			</td>
			<td>
				<?php
				if($type=="0")
				{
					echo $expense['fld_payment_to'];
				}
				else
				{
					echo $expense['payment_to'];
				}
				?>
			</td>
			<td>
				<?php
				if($type=="0")
				{
					echo $expense['fld_payment_by'];
				}
				else
				{
					echo $expense['payment_by'];
				}
				?>
			</td>
			<td>
			<?php
				if($type=="0")
				{
					echo $expense['fld_expense'];
				}
				else
				{
					echo $expense['fld_expense'];
				}
				?>
				
			</td>
			<td>
			<?php
				if($type=="0")
				{
					echo $expense['fld_description'];
				}
				else
				{
					echo $expense['description'];
				}
				?>
			</td>
			<td>
				<span onclick="delete_expense('<?=$date?>',<?=$expense['fld_id']?>)" style="cursor:pointer;"><i class="fa fa-trash"></i></span>
			</td>
		</tr>
		<?php
	}
	else
	{
		?>
		<tr>
			<td colspan="7">No Record Found</td>
		</tr>
		<?php
	}
}
?>

<?php
if($expense_on=="")
{
$getCommonExpense=$db->GetCommonPoolExpenseByMonth($date,$expense_type);
foreach($getCommonExpense as $Cexpense)
{
	$total_expense=$total_expense+$Cexpense['fld_expense'];
	if($getCommonExpense[0]!="")
	{
		?>
		<tr>
			<td>Common Pool</td>
			<td><?=$Cexpense['fld_expense_type']?></td>
			<td><?=$Cexpense['fld_payment_to']?></td>
			<td><?=$Cexpense['fld_payment_by']?></td>
			<td><?=$Cexpense['fld_expense']?></td>
			<td><?=$Cexpense['fld_description']?></td>
			<td>
				<span onclick="delete_expense('<?=$date?>',<?=$Cexpense['fld_id']?>)" style="cursor:pointer;"><i class="fa fa-trash"></i></span>
			</td>
		</tr>
		 <?php
	}
	else
	{
		?>
			<tr>
				<td colspan="7">No Record Found</td>
			</tr>
		<?php
	}
}
}
?>

	<tr>
		<td colspan="4">Total</td>
		<td colspan="3"><?=$total_expense?></td>
	</tr>