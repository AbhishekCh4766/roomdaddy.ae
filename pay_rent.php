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
    <title>Pay Rent</title>
	<?php
	$room=$_REQUEST['roomid'];
	 $tenent_id = base64_decode($_REQUEST['tanent_id']);
	$getRoomInfo=$db->getRoomsById(base64_decode($room));
	$getTanentInfo=$db->getTanentById($getRoomInfo[0]['fld_tanent']);
	?>
    <title><?=$getTanentInfo[0]['fld_name']?> | <?=$getRoomInfo[0]['fld_room_name']?></title>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
	
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
<script>
function add_edit_rent()
{  
   var datastring=$("#rent_collection").serialize();
   //alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=9",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			//alert(responseData);exit;
			$("#rent_collection")[0].reset();
			if(responseData.search('done')!='-1')
			{
			   var arr=responseData.split('-');
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
</script>
<script>
function calculate_balance(room,deposit)
{
	//alert(room);
	$.ajax({
		type: "post",
		url: "request_process.php?calling=15&deposit="+deposit+"&room="+room,
		success: function(responseData, textStatus, jqXHR) {
			$("#balance").val(responseData);
			
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
</script>
<script>
function move_out()
{
	var datastring=$("#tanent_move_out").serialize();
   //alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=28",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			//alert(responseData);exit;
			if(responseData.search('done')!='-1')
			{
			   var arr=responseData.split('-');
			    $('#tanent_move_out')[0].reset();
			   $("#success").html(arr[1]);
			   $("#success").show();
			   $("#fail").hide();
			}
			else
			{
			  $("#fail").show();
			  $("#fail").html(responseData);
			  $("#success").hide();
			  
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
</script>
<script>
function check_rent_status()
{
	var datastring=$("#check_status").serialize();
  //alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=14",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			//alert(responseData);exit;
			if(responseData.search('balance')!='-1')
			{
			   var arr=responseData.split('balance-');
			   //$("#success").html(arr[1]);
			   $("#rent").val(arr[0]);
			   if(arr[1].search('date')!='-1')
			   {
				   var ars=arr[1].split('date-')
				   $("#balance").val(ars[0]);
				   //$("#month").val(ars[0]);
				   if(ars[1].search('rentid')!='-1')
				   {
						var arrs=ars[1].split('rentid-');
						$("#month").val(arrs[0]);
						$("#rent_id").val(arrs[1]);
				   }
				   
				   
			   }
				   
			   $("#submit_rent_button").css("display","block");
			   
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
</script>
<script>
function pay_deposit()
{
	var datastring=$("#deposit_collect").serialize();
   //alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=26",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			//alert(responseData);
			if(responseData.search('done')!='-1')
			{
			   var arr=responseData.split('-');
			    $('#deposit_collect')[0].reset();
			   $("#success").html(arr[1]);
			   $("#success").show();
			   $("#fail").hide();
			}
			else
			{
			  $("#fail").show();
			  $("#fail").html(responseData);
			  $("#success").hide();
			  
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
function refund_deposit()
{
	var datastring=$("#deposit_refund").serialize();
   //alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=27",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			//alert(responseData);exit;
			if(responseData.search('done')!='-1')
			{
			   var arr=responseData.split('-');
			    $('#deposit_refund')[0].reset();
			   $("#success").html(arr[1]);
			   $("#success").show();
			   $("#fail").hide();
			}
			else
			{
			  $("#fail").show();
			  $("#fail").html(responseData);
			  $("#success").hide();
			  
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
</script>
<?php
	
?>	
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
                <h3>Rent Collection</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Rent</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Deposit</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Move Out</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Deposit Out</a>
                        </li>
                        
                    </ul>
                   
                    <div class="clearfix"></div>
                  </div>
				  <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <div class="x_content">
                    <br />
                    
					  
					  
					  
					  <!---Rent Collection Form-->
                  <div class="x_content rent_collection_form" >
                    <br />
						
                    <?php
					$getRoomInfo=$db->getRoomsById(base64_decode($room));
					
					?>
					  <div class="form-group">
					  
										<form id="rent_collection" class="form-horizontal form-label-left">
					  <div class="x_content rent_collection_form">
					  	

					  <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Date <span class="required">*</span>
                        </label>
						
						
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<?php
									$month=date("m");
								?>
								<input type="hidden" name="tenent_id"  value="<?php echo $tenent_id; ?>" />
								<input type="hidden" name="roomid" id="roomid" value="<?=$room?>" />
								<select name="rent_month" id="rent_month" class="form-control has-feedback-left">
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
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<select class="form-control" name="rent_year" id="rent_year">
									<?php
									for($i=2017;$i<=date("Y");$i++)
									{
										?>
										<option value="<?=$i?>"><?=$i?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						
						</div>
						
						
						
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Rent<span class="required">*</span>
                        </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-6 col-sm-6 col-xs-6 form-group has-feedback">
									<input type="hidden" name="month" id="month" value="" />
											<input type="hidden" name="roomid" id="roomid" value="<?=$room?>" />

											
											<!-- <input type="text" name="rent_id" id="rent_id" value="" /> -->
											<label>Recieved</label>
											<input type="text" name="rent" id="rent" class="form-control has-feedback-left" required />
											</div>
											<!--
											<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
											<label>Balance</label>
											<input type="text" name="balance" id="balance" class="form-control has-feedback-left" value="" />
											</div>-->
											<div class="col-md-6 col-sm-6 col-xs-6 form-group has-feedback">
											<label>Deposit</label>
											<input type="text" name="deposit" id="deposit" class="form-control has-feedback-left" value="<?=$getTanentInfo[0]['fld_deposit']?>" />
										
											</div>
								</div>
								<div class="x_content rent_collection_form" >
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Collection Date<span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
												<label>Date</label>
										     <input type="date" name="rent_date">
											</div>
										</div>	
									</div>
								</div>
								<div class="x_content rent_collection_form" >
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Collected By
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
											
											<select name="rent_collect_by" id="rent_collect_by" class="form-control has-feedback-left">
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
										</div>
										</div>
									</div>
								</div>
								<div class="x_content rent_collection_form" >
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Description
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
											<textarea class="form-control has-feedback-left" name="rent_desc" id="rent_desc"></textarea>
										</div>
										</div>
									</div>
								</div>
								</form>
								<div class="form-group submit_rent_button">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									  <button type="submit" class="btn btn-success" onClick="return add_edit_rent();"  name="add_edit_rent"/>Submit</button>
									</div>
								</div>
                      </div>
                  </div>
                </div>
                </div>
				 <div role="tabpanel" class="tab-pane fade in" id="tab_content2" aria-labelledby="home-tab">
					<div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

							  	
								<label>Deposit Comitted <?=$getTanentInfo[0]['fld_deposit']?></label>
							  </div>
						  </div>
						  <div class="form-group col-md-12 col-sm-4 col-xs-12">
							<form id="deposit_collect" class="form-horizontal form-label-left">
								<input type="hidden" name="roomid" id="roomid" value="<?=$_REQUEST['roomid']?>" />
								<input type="hidden" name="tenent_id"  value="<?php echo $tenent_id; ?>" />
								<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
								<label>
									Payment Date
									
								<input type="date" name="payment_date">
									</label>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
										<label>
											Collected By
											<select name="deposit_collect_by" id="deposit_collect_by" class="form-control has-feedback-left" >
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
											</label>
											
										
					
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<label>
							Description
							<textarea class="form-control has-feedback-left" name="deposit_desc" id="deposit_desc"></textarea>
						</label>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<label>
							Deposit Payment
							<input type="text" class="form-control has-feedback-left" name="deposit_pay" id="deposit_pay">
						</label>
					</div>	
					</form>					
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <button type="submit" class="btn btn-success" onClick="return pay_deposit();"  name="pay_deposit"/>Pay</button>
					</div>
							
						  </div>
                      </div>
						
                  </div>
                </div>
				<div role="tabpanel" class="tab-pane fade in" id="tab_content3" aria-labelledby="home-tab">
					<div class="x_content">
						
							<div id="note">
		
								<div class="onerow" id="error_div">
									<div id="fail" class="info_div" style="display:none;"><span class="ico_cancel">Ups, there was an error</span></div>
								</div>
								<div class="onerow">	
									<div id="success" class="info_div" style="display:none;"><span class="ico_success">Property Updated Successfully!</span></div>
								</div>	
								
								<div id="error_div" class="error_div" style="padding-left:10px;">
							   
								</div> 
							</div>
						
						
						
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group">
							  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
								<label>Deposit Comitted <?=$getTanentInfo[0]['fld_deposit']?></label>
								
							  </div>
						  </div>
						  <div class="form-group col-md-12 col-sm-4 col-xs-12">
							<form id="tanent_move_out" class="form-horizontal form-label-left">
								<input type="hidden" name="roomid" id="roomid" value="<?=$_REQUEST['roomid']?>" />
								<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
								<label>
									Move Out Date
									<?php
									$month=date("m");
									?>
									<select id="deposit_date" name="deposit_date">
										<?php
										for($i=1;$i<=31;$i++)
										{
											if($i<=9)
											{
												$i="0".$i;
											}
											?>
											<option value="<?=$i?>"><?=$i?></option>
											<?php
										}
										?>
									</select>
						<select id="deposit_month" name="deposit_month">
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
						<select  id="deposit_year" name="deposit_year">
							<?php
							for($i=2017;$i<=date("Y");$i++)
							{
								?>
								<option value="<?=$i?>"><?=$i?></option>
								<?php
							}
							?>
						</select>
					</label>
					</div>
					</form>					
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <button type="submit" class="btn btn-success" onClick="return move_out();" name="move_out"/>
						Move Out
					  </button>
					</div>
					</div>
                      </div>
						
                  </div>
				</div>
				 <div role="tabpanel" class="tab-pane fade in" id="tab_content4" aria-labelledby="home-tab">
					<div class="x_content">
						
							<div id="note">
		
								<div class="onerow" id="error_div">
									<div id="fail" class="info_div" style="display:none;"><span class="ico_cancel">Ups, there was an error</span></div>
								</div>
								<div class="onerow">	
									<div id="success" class="info_div" style="display:none;"><span class="ico_success">Property Updated Successfully!</span></div>
								</div>	
								
								<div id="error_div" class="error_div" style="padding-left:10px;">
							   
								</div> 
							</div>
						
						
						
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group">
							  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
								<label>Deposit Comitted <?=$getTanentInfo[0]['fld_deposit']?></label>
								
							  </div>
						  </div>
						  <div class="form-group col-md-12 col-sm-4 col-xs-12">
							<form id="deposit_refund" class="form-horizontal form-label-left">
								<input type="hidden" name="roomid" id="roomid" value="<?=$_REQUEST['roomid']?>" />
								<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
								<label>
									Deposit Out Date
									<?php
									$month=date("m");
									?>
									<select id="deposit_date" name="deposit_date">
										<?php
										for($i=1;$i<=31;$i++)
										{
											if($i<=9)
											{
												$i="0".$i;
											}
											?>
											<option value="<?=$i?>"><?=$i?></option>
											<?php
										}
										?>
									</select>
						<select id="deposit_month" name="deposit_month">
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
						<select  id="deposit_year" name="deposit_year">
							<?php
							for($i=2017;$i<=date("Y");$i++)
							{
								?>
								<option value="<?=$i?>"><?=$i?></option>
								<?php
							}
							?>
						</select>
					</label>
					</div>
					
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
										<label>
											Refund By
											<select name="deposit_refunded_by" id="deposit_refunded_by" class="form-control has-feedback-left" >
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
											</label>
											
										
					
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<label>
							Description
							<textarea class="form-control has-feedback-left" name="deposit_out_desc" id="deposit_out_desc"></textarea>
						</label>
					</div>
					
					
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<label>
							Deposit Refunded
							<input type="text" class="form-control has-feedback-left" name="deposit_pay" id="deposit_pay">
						</label>
					</div>	
					</form>					
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <button type="submit" class="btn btn-success" onClick="return refund_deposit();"  name="refund_deposit"/>Refund</button>
					</div>
					</div>
                      </div>
						
                  </div>
				 </div>
                </div>
				<!------------->
              </div>
            </div> 
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Website by Saqib Ali
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    
    <script src="vendors/nprogress/nprogress.js"></script>
    
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    
    <script src="vendors/iCheck/icheck.min.js"></script>
    
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>
    
    <script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    
    <script src="vendors/switchery/dist/switchery.min.js"></script>
    
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    
    <script src="vendors/autosize/dist/autosize.min.js"></script>
    
    <script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    
    <script src="vendors/starrr/dist/starrr.js"></script>
    
    <script src="build/js/custom.min.js"></script>
  </body>
</html>
