<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense</title>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
	<style>
	#fail_transaction,#fail_expense{
		background-color: red;
padding: 6px;
margin: 6px;
color: white;
border-radius: 8px;

	}
	#success_transaction,#success_expense
	{
		background-color: green;
padding: 6px;
margin: 6px;
color: white;
border-radius: 8px;

	}
	.bar_tabs-box ul.bar_tabs{
	background: unset;
	padding-left: 0px;
}
.bar_tabs-box ul.bar_tabs li:first-child{
	margin-left:0px;
}
	</style>
	
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
	
<script>
function AddTransaction()
{  
   var datastring=$("#frm_transaction").serialize();
   //alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=34",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			//alert(responseData);
			if(responseData.search('done')!='-1')
			{
			   var arr=responseData.split('-');
				//alert(arr[1]);exit;
				$("#frm_transaction")[0].reset();
				$("#success_transaction").html(arr[1]);
				$("#success_transaction").show();
				$("#fail_transaction").hide();
			}
			else
			{
				$("#fail_transaction").html(responseData);
				$("#success_transaction").hide();
				$("#fail_transaction").show();
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
function addExpense()
{  
   var datastring=$("#expense_frm").serialize();
   console.log('ssss',datastring);
   //alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=12",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			//alert(responseData);
			if(responseData.search('done')!='-1')
			{
			   var arr=responseData.split('-');
				//alert(arr[1]);exit;
				$("#expense_frm")[0].reset();
				$("#success_expense").html(arr[1]);
				$("#success_expense").show();
				$("#fail_expense").hide();
			}
			else
			{
				$("#fail_expense").html(responseData);
				$("#success_expense").hide();
				$("#fail_expense").show();
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
function pay_dewa(id)
{
//	alert("Pay Dewa");
	 var datastring=$("#dewa_values"+id).serialize();
  // alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=13",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			$("#dewa_values"+id)[0].reset();
			alert(responseData);
			$("#dewa_red"+id).css("background","#72ff00");
			
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
function pay_empower(id)
{
//	alert("Pay Dewa");
	 var datastring=$("#empower_values"+id).serialize();
	 //alert(datastring);exit;
  //alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=17",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			$("#empower_values"+id)[0].reset();
			//alert(responseData);
			$("#empower_red"+id).css("background","#72ff00");
			//alert(responseData);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
function pay_du(id)
{
//	alert("Pay Dewa");
	 var datastring=$("#du_values"+id).serialize();
  // alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=16",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			//alert(responseData);
			$("#du_values"+id)[0].reset();
			$("#du_red"+id).css("background","#72ff00");
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
function check_dewa_status(bid)
{
	var datastring=$("#dewa_values"+id).serialize();
	alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=16",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			alert(responseData);exit;
			if(responseData.search('done')!='-1')
			{
			   var arr=responseData.split('-');
			 //  alert(arr[1]);exit;
			   $("#success").html(arr[1]);
			   $("#success").show();
			   $("#fail").hide();
			}
			else
			{
			  $("#fail").html(responseData);
			  $("#success").hide();
			  $("#fail").show();
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
function owner_for_common_pool(s)
{
	if(s=="0")
	{
		$("#chrgeto").show();
	}
	else
	{
		$("#chrgeto").hide();
	}
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode==46)
	{
		return true;
	}
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
	
    return true;
}
</script>
<style>
.red-circle
{
	background: #f00;
	border-radius: 50%;
	width: 20px;
	height: 20px;
	display: flex;
 
}
.green-circle
{
	background: #72ff00;
	border-radius: 50%;
	width: 20px;
	height: 20px;
	display: flex;

}
</style> 
 </head>
<?php
include("header.php");
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Expense</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 bar_tabs-box">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Default Example <small>Users</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="overflow:auto">
				  
					<div class="row">
					<div class="col-sm-12">



					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist" style="padding-left: 0px;">
						
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Genral Expense</a>
                        </li>
						
						
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Dewa</a>
                        </li>
						
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Du</a>
                        </li>
						
                        <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Empower</a>
                        </li>
						
                        <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Transactions</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Management Fee</a>
                        </li>
						
                        
                    </ul>
					</div>
					<div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <p>
					<div class="col-sm-12">
					<div class="">
					<table id="datdatable" class="table table-striped table-bordered">
					<div id="success_expense" style="display:none;"></div>
					<div id="fail_expense" style="display:none;"></div>
					<form id="expense_frm" method="post">
					<tr>
						<th>Select Appartment</th>
						<td colspan="3">
						<select id="expense_on" name="expense_on" aria-controls="datatable" class="form-control input-sm" onchange="owner_for_common_pool(this.value);">
						<option value="">Select Appartment</option>
						<option value="0">Common Pool</option>
						<?php
							$getBuilding=$db->getAllBuilding();
							if($getBuilding[0]!="")
							{	
								foreach($getBuilding as $building)
								{
									?>
									<option value="<?=$building['fld_id']?>"><?=$building['fld_building']?> <?=$building['fld_apt_no']?></option>
									<?php
								}
							}
						?>
						</select>
					</td>
					</tr>
					<tr id="chrgeto" style="display:none;">
						<th>
							Charge to
						</th>
						<td colspan="3">
						<select aria-controls="datatable" class="form-control input-sm" id="charge_to" name="charge_to">
								<?php
									$getallowner=$db->getSuperAdmin();


									foreach($getallowner as $ben)
									{
										?>
										<option value="<?=$ben['fld_name']?>"><?=$ben['fld_name']?></option>
										<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>Expense Type</th>
						<td colspan="3">
						<select aria-controls="datatable" id="expense_type" name="expense_type" class="form-control input-sm">
						
							<option value="">Select Expense Type</option>
							<?php
								$GetExpenseType=$db->GetExpenseType();
								//if($GetExpenseType[0]!="")
								{
									foreach($GetExpenseType as $expenseType)
									{
										?>
										<option value="<?=$expenseType['fld_expense_type']?>"><?=$expenseType['fld_expense_type']?></option>
										<?php
									}
								}
							?>
						</select>
						</td>
					</tr>
					<tr>
						<th>Expense</th>
						<td colspan="3"><input type="text" class="form-control input-sm" id="expense" name="expense" onkeypress="return isNumber(event)"/></td>
					</tr>
					<tr>
						<th>Payment to</th>
						<td colspan="3"><input type="text" class="form-control input-sm" id="paymentto" name="paymentto"/></td>
					</tr>

                   <tr>
					    <th>Assign to</th>
					    <td colspan="3">
						    <select class="form-control input-sm" id="assign_to" name="assign_to">
						    	<option value="">Select Assign To</option>
							<?php  $getallowner=$db->getSuperAdmin(); //print_r($getallowner); die;
								 	foreach($getallowner as $ben)
									{
										?>
										<option value="<?=$ben['fld_id']?>"><?=$ben['fld_name']?></option>
						    <?php
									}?>
						    </select>
					    </td>
						<!-- <td colspan="3"><input type="text" class="form-control input-sm" id="assignto" name="paymentto"/></td> -->
					</tr>

					<tr>
						<th>Payment By</th>
						<td colspan="3">
							<!--<input type="text" class="form-control input-sm" id="paymentby" name="paymentby"/>-->
							<select class="form-control input-sm" id="paymentby" name="paymentby">
								<?php
									$GetAllBeneficiary=$db->GetAllBeneficiary();
									foreach($GetAllBeneficiary as $ben)
									{
										?>
										<option value="<?=$ben['fld_name']?>"><?=$ben['fld_name']?></option>
										<?php
									}
								?>
							</select>
						</td>
					</tr>
						<tr>
							<th>Payment Date</th>
							<td>
								<select class="form-control input-sm" id="date" name="date">
									
									<?php
										$date=date("d");
										for($i=1;$i<=31;$i++)
										{
											if($i<=9)
											{
												$i="0".$i;
											}
											?>
											<option value="<?=$i?>"
											<?php
											if($date==$i)
											{
												echo "Selected";
											}										
											
											?>
											><?=$i?></option>
											<?php
										}										
									?>
								</select>
							</td>
						<td>
						<?php
						$month=date("m");
						?>
						<select class="form-control input-sm" id="month" name="month">
							<option value="0">Select Month</option>
							<option value="01" <?php if($month=="01" || $month==01){ echo "Selected";}?>>January</option>
							<option value="02" <?php if($month=="02" || $month==02){ echo "Selected";}?>>February</option>
							<option value="03" <?php if($month=="03" || $month==03){ echo "Selected";}?>>March</option>
							<option value="04" <?php if($month=="04" || $month==04){ echo "Selected";}?>>April</option>
							<option value="05" <?php if($month=="05" || $month==05){ echo "Selected";}?>>May</option>
							<option value="06" <?php if($month=="06" || $month==06){ echo "Selected";}?>>June</option>
							<option value="07" <?php if($month=="07" || $month==07){ echo "Selected";}?>>July</option>
							<option value="08" <?php if($month=="08" || $month==08){ echo "Selected";}?>>August</option>
							<option value="09" <?php if($month=="09" || $month==09){ echo "Selected";}?>>September</option>
							<option value="10" <?php if($month=="10" || $month==10){ echo "Selected";}?>>October</option>
							<option value="11" <?php if($month=="11" || $month==11){ echo "Selected";}?>>November</option>
							<option value="12" <?php if($month=="12" || $month==12){ echo "Selected";}?>>December</option>
						</select>
						</td>
						<td>
						<select class="form-control input-sm" id="year" name="year">
							<?php
							for($i=2016;$i<=date("Y");$i++)
							{
								?>
								<option value="<?=$i?>"
								<?php
									if(date("Y")==$i)
									{
										echo "Selected";
									}
									?>
								><?=$i?></option>
								<?php
							}
							?>
						</select>
						</td>
						</tr>
					
					<tr>
						<th>Description</th>
						<td colspan="3"><textarea id="description" class="form-control" name="description"></textarea></td>
					</tr>
					
					</form>
					<tr>
					<td></td>
					<td colspan="3">
						<input type="Submit" value="Submit" onclick="addExpense()" class="btn btn-success"/>
					</td>
					</tr>
					</table>
					</div>
					</div>
					</p>
					
				
					</div>
					
					<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
					<p>
						<div class="col-md-12">
							<table id="datdatable" class="table table-striped table-bordered">
								<tr>
									<th>Status</th>
									<th>Appartment Number</th>
									<th>Dewa </th>
									<th>Month </th>
									<th>Amount</th>
									<th>Payment By</th>
									<th>Description</th>
									<th>Submit</th>
								</tr>
								
								<?php
								$getBuildings=$db->getAllBuilding();
								foreach($getBuildings as $building)
								{
									$month=date("m");
									?>
									<form id="dewa_values<?=$building['fld_id']?>">
									<tr>
										<td>
										
										<?php
										$getStatus=$db->GetUtilitiesStatus($building['fld_id'],"DEWA",date("Y-m"));
										if($getStatus[0]!="")
										{
											?>
											<span class="green-circle" id="dewa_green<?=$building['fld_id']?>"></span>
											<?php
										}
										else
										{
											?>
											<span class="red-circle" id="dewa_red<?=$building['fld_id']?>"></span>
											<?php
										}
										?>
										</td>
										<td><?=$building['fld_building']?> <?=$building['fld_apt_no']?> </td>
										<td><?=$building['fld_dewa']?></td>
										<td>
										<select class="form-control input-sm" id="dewa_date" name="dewa_date" style="width:28%;float:left;">
											<?php
													$date=date("d");
													for($i=1;$i<=31;$i++)
													{
														?>
														<option value="<?=$i?>"
															<?php
																if($i==$date)
																{
																	echo "Selected";
																}
															?>
														><?=$i?>
														</option>
														<?php
													}
													?>
										</select>
										<select class="form-control input-sm" id="dewa_month" name="dewa_month" style="width:35%;float:left;">
											<option value="01" <?php if($month=="01" || $month==01){ echo "Selected";}?>>January</option>
											<option value="02" <?php if($month=="02" || $month==02){ echo "Selected";}?>>February</option>
											<option value="03" <?php if($month=="03" || $month==03){ echo "Selected";}?>>March</option>
											<option value="04" <?php if($month=="04" || $month==04){ echo "Selected";}?>>April</option>
											<option value="05" <?php if($month=="05" || $month==05){ echo "Selected";}?>>May</option>
											<option value="06" <?php if($month=="06" || $month==06){ echo "Selected";}?>>June</option>
											<option value="07" <?php if($month=="07" || $month==07){ echo "Selected";}?>>July</option>
											<option value="08" <?php if($month=="08" || $month==08){ echo "Selected";}?>>August</option>
											<option value="09" <?php if($month=="09" || $month==09){ echo "Selected";}?>>September</option>
											<option value="10" <?php if($month=="10" || $month==10){ echo "Selected";}?>>October</option>
											<option value="11" <?php if($month=="11" || $month==11){ echo "Selected";}?>>November</option>
											<option value="12" <?php if($month=="12" || $month==12){ echo "Selected";}?>>December</option>
										</select>
										<select class="form-control input-sm" id="dewa_year" name="dewa_year" style="width:35%;">
											<?php
											for($i=2016;$i<=date("Y");$i++)
											{
												?>
												<option value="<?=$i?>"
												<?php
									if(date("Y")==$i)
									{
										echo "Selected";
									}
									?>		
												><?=$i?></option>
												<?php
											}
											?>
										</select> 
										</td>
										<td>
											<input type="text" name="dewa_amount<?=$building['fld_id']?>" id="dewa_amount<?=$building['fld_id']?>"/>
										</td>
										<td>
											<select class="form-control input-sm"  name="dewa_payment_by<?=$building['fld_id']?>" id="dewa_payment_by<?=$building['fld_id']?>">
											<?php
												$GetAllBeneficiary=$db->GetAllBeneficiary();
												foreach($GetAllBeneficiary as $ben)
												{
													?>
													<option value="<?=$ben['fld_name']?>"><?=$ben['fld_name']?></option>
													<?php
												}
											?>
										</select>
											
											
											
										</td>
										<td>
											<input type="text" name="dewa_desc<?=$building['fld_id']?>" id="dewa_desc<?=$building['fld_id']?>" />
										</td>
										<td><input type="button"  class="btn btn-success" value="Submit" onclick="pay_dewa(<?=$building['fld_id']?>);"/></td>
										<input type="hidden" name="dewa_building" id="dewa_building" value="<?=$building['fld_id']?>"/>
										
										<!--<input type="hidden" name="dewa_payment_by" id="dewa_payment_by" value="<?=$_SESSION[ADMIN_SESSION_NAME]['userid']?>"/>-->
									</tr>
									</form>
									<?php
								}
								?>
							</table>
						</div>
					</p>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
					<p>
						<div class="col-md-12">
							<table id="datdatable" class="table table-striped table-bordered">
								<tr>
									<th>Status</th>
									<th>Appartment Number</th>
									<th>DU </th>
									<th>Date </th>
									<th>Month </th>
									<th>Year </th>
									<th>Amount</th>
									<th>Payment By</th>
									<th>Description</th>
									<th>Submit</th>
								</tr>
								<?php
								$getBuildings=$db->getAllBuilding();
								foreach($getBuildings as $building)
								{
									?>
									<tr>
									<form id="du_values<?=$building['fld_id']?>">
										<td><?php
										$getStatus=$db->GetUtilitiesStatus($building['fld_id'],"DU",date("Y-m"));
										if($getStatus[0]!="")
										{
											?>
											<span class="green-circle" id="du_green<?=$building['fld_id']?>"></span>
											<?php
										}
										else
										{
											?>
											<span class="red-circle" id="du_red<?=$building['fld_id']?>"></span>
											<?php
										}
										?>
										</td>
										<td><?=$building['fld_building']?> <?=$building['fld_apt_no']?> </td>
										<td><?=$building['fld_du']?></td>
										<td>
										<select class="form-control input-sm" id="du_date" name="du_date">
											<?php
													$date=date("d");
													for($i=1;$i<=31;$i++)
													{
														?>
														<option value="<?=$i?>"
															<?php
																if($i==$date)
																{
																	echo "Selected";
																}
															?>
														><?=$i?>
														</option>
														<?php
													}
													?>
										</select>
										</td>
										<td>
										<select class="form-control input-sm" id="du_month" name="du_month">
											<option value="01" <?php if($month=="01" || $month==01){ echo "Selected";}?>>January</option>
											<option value="02" <?php if($month=="02" || $month==02){ echo "Selected";}?>>February</option>
											<option value="03" <?php if($month=="03" || $month==03){ echo "Selected";}?>>March</option>
											<option value="04" <?php if($month=="04" || $month==04){ echo "Selected";}?>>April</option>
											<option value="05" <?php if($month=="05" || $month==05){ echo "Selected";}?>>May</option>
											<option value="06" <?php if($month=="06" || $month==06){ echo "Selected";}?>>June</option>
											<option value="07" <?php if($month=="07" || $month==07){ echo "Selected";}?>>July</option>
											<option value="08" <?php if($month=="08" || $month==08){ echo "Selected";}?>>August</option>
											<option value="09" <?php if($month=="09" || $month==09){ echo "Selected";}?>>September</option>
											<option value="10" <?php if($month=="10" || $month==10){ echo "Selected";}?>>October</option>
											<option value="11" <?php if($month=="11" || $month==11){ echo "Selected";}?>>November</option>
											<option value="12" <?php if($month=="12" || $month==12){ echo "Selected";}?>>December</option>
										</select>
										</td>
										
										<td>
										<select class="form-control input-sm" id="du_year" name="du_year">
											<?php
											for($i=2016;$i<=date("Y");$i++)
											{
												?>
												<option value="<?=$i?>"
												<?php
												if(date("Y")==$i)
												{
													echo "Selected";
												}
												?>		
												><?=$i?></option>
												<?php
											}
											?>
										</select>
										</td>
										<td><input type="text" name="du_amount<?=$building['fld_id']?>" id="du_amount<?=$building['fld_id']?>" /></td>
										<td>
										
										
										
										<select class="form-control input-sm"  name="du_payment_by<?=$building['fld_id']?>" id="du_payment_by<?=$building['fld_id']?>">
											<?php
												$GetAllBeneficiary=$db->GetAllBeneficiary();
												foreach($GetAllBeneficiary as $ben)
												{
													?>
													<option value="<?=$ben['fld_name']?>"><?=$ben['fld_name']?></option>
													<?php
												}
											?>
										</select>
										
										
										
										
											<input type="hidden" name="du_building" id="du_building" value="<?=$building['fld_id']?>" />
											<!--<input type="hidden" name="du_payment_by" id="du_payment_by" value="<?=$_SESSION[ADMIN_SESSION_NAME]['userid']?>" />-->
										</td>
										<td>
											<input type="text" name="du_desc<?=$building['fld_id']?>" id="du_desc<?=$building['fld_id']?>" />
										</td>
										<td>
											<input type="button"  class="btn btn-success" value="Submit" onclick="pay_du(<?=$building['fld_id']?>)"/>
										</td>
										</form>
									</tr>
									<?php
								}
								?>
							</table>
						</div>
					</p>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
					<p>
						<div class="col-md-12">
							<table id="datdatable" class="table table-striped table-bordered">
								<tr>
									<th>Status</th>
									<th>Appartment Number</th>
									<th>Empower </th>
									<th>Month </th>
									<th>Amount</th>
									<th>Payment By</th>
									<th>Description</th>
									<th>Submit</th>
								
								</tr>
								<?php
								$getBuildings=$db->getAllBuilding();
								foreach($getBuildings as $building)
								{
									if($building['fld_empower']!="")
									{
									?>
									<tr>
										<td>
										<?php
										$getStatus=$db->GetUtilitiesStatus($building['fld_id'],"EMPOWER",date("Y-m"));
										if($getStatus[0]!="")
										{
											?>
											<span class="green-circle" id="empower_green<?=$building['fld_id']?>"></span>
											<?php
										}
										else
										{
											?>
											<span class="red-circle" id="empower_red<?=$building['fld_id']?>"></span>
											<?php
										}
										?>
										</td>
									
										<td><?=$building['fld_building']?> <?=$building['fld_apt_no']?> </td>
										<td><?=$building['fld_empower']?></td>
										
										<td>
										<?php
						$month=date("m");
						?>
						<form id="empower_values<?=$building['fld_id']?>">
						<select class="form-control input-sm" id="empower_date" name="empower_date" style="width:28%;float:left;">
											<?php
													$date=date("d");
													for($i=1;$i<=31;$i++)
													{
														?>
														<option value="<?=$i?>"
															<?php
																if($i==$date)
																{
																	echo "Selected";
																}
															?>
														><?=$i?>
														</option>
														<?php
													}
													?>
										</select>
						<select class="form-control input-sm" id="empower_month" name="empower_month" style="width:35%;float:left;">
							<option value="01" <?php if($month=="01" || $month==01){ echo "Selected";}?>>January</option>
							<option value="02" <?php if($month=="02" || $month==02){ echo "Selected";}?>>February</option>
							<option value="03" <?php if($month=="03" || $month==03){ echo "Selected";}?>>March</option>
							<option value="04" <?php if($month=="04" || $month==04){ echo "Selected";}?>>April</option>
							<option value="05" <?php if($month=="05" || $month==05){ echo "Selected";}?>>May</option>
							<option value="06" <?php if($month=="06" || $month==06){ echo "Selected";}?>>June</option>
							<option value="07" <?php if($month=="07" || $month==07){ echo "Selected";}?>>July</option>
							<option value="08" <?php if($month=="08" || $month==08){ echo "Selected";}?>>August</option>
							<option value="09" <?php if($month=="09" || $month==09){ echo "Selected";}?>>September</option>
							<option value="10" <?php if($month=="10" || $month==10){ echo "Selected";}?>>October</option>
							<option value="11" <?php if($month=="11" || $month==11){ echo "Selected";}?>>November</option>
							<option value="12" <?php if($month=="12" || $month==12){ echo "Selected";}?>>December</option>
						</select>
						<select class="form-control input-sm" id="empower_year" name="empower_year" style="width:35%;">
							<?php
							for($i=2016;$i<=date("Y");$i++)
							{
								?>
								<option value="<?=$i?>"
								<?php
									if(date("Y")==$i)
									{
										echo "Selected";
									}
									?>
								><?=$i?></option>
								<?php
							}
							?>
						</select>
									</td>
										<td><input type="text" id="empower_amount<?=$building['fld_id']?>" name="empower_amount<?=$building['fld_id']?>"/></td>
										<td>
										
										<select class="form-control input-sm"  name="empower_payment_by<?=$building['fld_id']?>" id="empower_payment_by<?=$building['fld_id']?>">
											<?php
												$GetAllBeneficiary=$db->GetAllBeneficiary();
												foreach($GetAllBeneficiary as $ben)
												{
													?>
													<option value="<?=$ben['fld_name']?>"><?=$ben['fld_name']?></option>
													<?php
												}
											?>
										</select>
										
										
										<input type="hidden" id="empower_building" name="empower_building" value="<?=$building['fld_id']?>" />
										</td>
										<td>
										<input type="text" name="empower_desc<?=$building['fld_id']?>" id="empower_desc<?=$building['fld_id']?>" />
										</td>
										</form>
								<td><input type="button"  class="btn btn-success" value="Submit" onclick="pay_empower(<?=$building['fld_id']?>)"/></td>	
										
									</tr>
									<?php
									}
								}
								?>
								
							</table>
						</div>
					</p>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
						<div class="col-md-12">
							<table id="datdatable" class="table table-striped table-bordered">
								<div id="success_transaction" style="display:none;"></div>
								<div id="fail_transaction" style="display:none;"></div>
								<form id="frm_transaction">
								<tr>
									<td>
										<label>
											From
										</label>
									</td>
									<td colspan="3">
										<select id="from" name="from" aria-controls="datatable" class="form-control input-sm">
											<option value="">
												Select
											</option>
											<?php
											$getAllBenificiary=$db->GetAllBeneficiary();
											if($getAllBenificiary[0]!="")
											{
												foreach($getAllBenificiary as $ben)
												{
													?>
													<option value="<?=$ben['fld_name']?>"><?=$ben['fld_name']?></option>
													<?php
												}
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label>
											To
										</label>
									</td>
									<td colspan="3">
										<select id="to" name="to" aria-controls="datatable" class="form-control input-sm">
											<option value="">
												Select
											</option>
											<?php
											$getAllBenificiary=$db->GetAllBeneficiary();
											if($getAllBenificiary[0]!="")
											{
												foreach($getAllBenificiary as $ben)
												{
													?>
													<option value="<?=$ben['fld_name']?>"><?=$ben['fld_name']?></option>
													<?php
												}
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
								
								</tr>
									<td>Payment</td>
									<td colspan="3">
										<input type="text" name="payment" id="payment" class="form-control input-sm"/>
									</td>
								<tr>
									<td><label>Date</label></td>
									<td>
									<select class="form-control input-sm" id="date" name="date">
										<?php
										for($i=1;$i<=31;$i++)
										{
											$date=date("d");
											if($i<=9)
											{
												$i="0".$i;
											}
											?>
											<option value="<?=$i?>"
											<?php
											if($date==$i)
											{
												echo "Selected";
											}
											?>
											><?=$i?></option>
											<?php
										}
										?>
									</select>
									</td>
										<td>
										<?php
										$month=date("m");
										?>
										<select class="form-control input-sm" id="month" name="month">
											
											<option value="01" <?php if($month=="01" || $month==01){ echo "Selected";}?>>January</option>
											<option value="02" <?php if($month=="02" || $month==02){ echo "Selected";}?>>February</option>
											<option value="03" <?php if($month=="03" || $month==03){ echo "Selected";}?>>March</option>
											<option value="04" <?php if($month=="04" || $month==04){ echo "Selected";}?>>April</option>
											<option value="05" <?php if($month=="05" || $month==05){ echo "Selected";}?>>May</option>
											<option value="06" <?php if($month=="06" || $month==06){ echo "Selected";}?>>June</option>
											<option value="07" <?php if($month=="07" || $month==07){ echo "Selected";}?>>July</option>
											<option value="08" <?php if($month=="08" || $month==08){ echo "Selected";}?>>August</option>
											<option value="09" <?php if($month=="09" || $month==09){ echo "Selected";}?>>September</option>
											<option value="10" <?php if($month=="10" || $month==10){ echo "Selected";}?>>October</option>
											<option value="11" <?php if($month=="11" || $month==11){ echo "Selected";}?>>November</option>
											<option value="12" <?php if($month=="12" || $month==12){ echo "Selected";}?>>December</option>
										</select>
										</td>
										<td>
										<select id="year" name="year" aria-controls="datatable" class="form-control input-sm">
											<?php
											for($i=2016;$i<=date("Y");$i++)
											{
												?>
												<option value="<?=$i?>"
												<?php
												if(date("Y")==$i)
												{
													echo "Selected";
												}
												?>
												><?=$i?>
												</option>
												<?php
											}
							?>
										</select>
									</td>
								</tr>
								<tr>
									<td><label>
									Description
									</label></td>
									<td colspan="3">
										<textarea class="form-control" id="description" name="description"></textarea>
										<input type="hidden" name="trans_by"  value="<?=$_SESSION[ADMIN_SESSION_NAME]['userid']?>"/>
									</td>
								</tr>
								</form>
								<tr>
									<td>
									
									</td>
									<td colspan="3"><button class="btn btn-success" onclick="AddTransaction();">Submit</button></td>
								</tr>
							</table>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">
						<div class="col-md-12">
						
						</div>
					</div>
					
					
					
					</div>
					</div>
				  
				  
				  
				  
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
	
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>