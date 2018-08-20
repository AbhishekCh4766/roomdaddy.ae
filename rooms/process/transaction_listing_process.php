<?php 
$db = new DBManager();
$first=$_REQUEST['first'];
$second=$_REQUEST['second'];
$getAllTransaction=$db->GetAllTransactionByFilters($first,$second);
if($getAllTransaction[0]!="")
{
foreach($getAllTransaction as $transaction)
{
	?>
	<tr>
		<td><?=$transaction['fld_payment_by']?></td>
		<td><?=$transaction['fld_payment_to']?></td>
		<td><?=$transaction['fld_payment']?></td>
		<td><?php
			$date=date("d M Y",strtotime($transaction['fld_payment_date']));
			echo $date;
		?></td>
		<td><?=$transaction['fld_description']?></td>
		<td><span><i class="fa fa-trash"></i></span></td>
	</tr>
	<?php
}
}
else
{
	?>
	<tr>
		<td colspan="7">No Transaction Found</td>
	</tr>
	<?php
}
?>

								

	
