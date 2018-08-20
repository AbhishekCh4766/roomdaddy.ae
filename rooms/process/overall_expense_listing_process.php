<?php 

$db = new DBManager();
$where=" WHERE ";
$date       	=	$_REQUEST['date'];
$expense_on		=	$_REQUEST['expense_on'];
$expense_type	=	$_REQUEST['expense_type'];
$payment_by		=	$_REQUEST['payment_by'];
$payment_to		=	$_REQUEST['payto'];
if($date!="")
{
	$where.=" `fld_date` like '$date%' AND `is_approved` = '1' AND ";
}
if($expense_on!="")
{
	$where.=" `fld_expense_on` = '$expense_on' AND `is_approved` = '1' AND ";
}
if($expense_type!="")
{
	$where.=" `fld_expense_type` = '$expense_type' AND `is_approved` = '1' AND ";
}
if($payment_by!="")
{
	$where.=" `fld_payment_by` = '$payment_by' AND `is_approved` = '1' AND ";
}
if($payment_to!="")
{
	$where.=" `fld_payment_to` = '$payment_to' AND `is_approved` = '1' AND ";
}
$where.=" TRUE ";
$total_expense=0;
$getExpense=$db->GetAllExpensesByCondition($where);
$index=1;
foreach($getExpense as $expense)
{
	
	$total_expense=$total_expense+$expense['fld_expense'];
	if($getExpense[0]!="")
	{
		?>
		<tr>
			<td>
				<?=$index?>
			</td>
			<td>
				<?php
					echo $expense['fld_id'];
				?>
			</td>
			<td>
				<?php
					echo date("d M Y",strtotime($expense['fld_date']));
				?>
			</td>
			<?php
			if($expense['fld_expense_on']!=0)
			{
			?>
			<td>
				<?php
					$getBuilding=$db->getBuildingById($expense['fld_expense_on']);
					echo $getBuilding[0]['fld_building']." ".$getBuilding[0]['fld_apt_no'];
				?>
			</td>
			<?php
			}
			else
			{
				?>
				<td>
					Common Pool
				</td>
				<?php
			}
			?>
			<td>
				<?php
					echo $expense['fld_expense_type'];
				?>
			</td>
			<td>
				<?php
					echo $expense['fld_payment_to'];
				?>
			</td>
			<td>
				<?php
					echo $expense['fld_payment_by'];
				?>
			</td>
			<td>
				<?php
					if($expense['fld_expense_on']!=0)
					{
						$getBuilding=$db->getBuildingById($expense['fld_expense_on']);
						$getOwner=$db->getAdminById($getBuilding[0]['fld_tanent']);
						echo $getOwner[0]['fld_name'];
					}
					else
					{
						echo $expense['fld_expense_type'];
						
					}
				?>
			</td>
			<td>
				<?php
					echo $expense['fld_expense'];
				?>
			</td>
			<td>
				<?php
					echo $expense['fld_description'];
				?>
			</td>
			<td>
				<span onclick="delete_expense('<?=$expense['fld_id']?>')" style="cursor:pointer;"><i class="fa fa-trash"></i></span>
			</td>
			<td>
				<span style="cursor:pointer;"><a href="expense.php?eid=<?=base64_encode($expense['fld_id'])?>"><i class="fa fa-edit"></i></a></span>
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
	$index++;
}
?>
<tr>
	<td colspan="7" style="text-align:center"><b>Total</b></td>
	<td colspan="3"><?=$total_expense?></td>
</tr>