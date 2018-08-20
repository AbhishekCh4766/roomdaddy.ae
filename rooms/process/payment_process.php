<?php 

$db = new DBManager();

$first=$_REQUEST['payment_by'];

$payment_by	=$_REQUEST['payment_by'];
$getExpense=$db->GetPaymentHistory($first);

$i=0;
foreach($getExpense as $expense)
{
	
	
	if($getExpense[0]!="")
	{
		               
		?>
					<tr>
										     <td>
										     	 <?php $i++; echo $i; ?>
										     </td>
                                            <td>
                                                <?php echo $expense['fld_payment_by']; ?>
                                            </td>
											<td>
												<?php echo $expense['fld_payment_to']; ?>
											</td>
										
											
                                            <td>
                                                <?php echo $expense['fld_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $expense['fld_payment_date']; ?>
                                            </td>
                                            <td>
                                                <?php echo $expense['fld_description']; ?>
                                            </td>
                                            	<td>
												<?php echo $expense['fld_payment']; ?>
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
