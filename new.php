<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();
$am=new AdminManager();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Online Munshi System</title>
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
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <!-- Custom Theme Style -->
<link href="build/css/custom.min.css" rel="stylesheet">
<script type="text/javascript" language="javascript">
function expense_summary(date,uid)
{
	$.ajax({
			type: "POST",
			data: "date="+date+"&uid="+uid,
			url: 'request_process.php?calling=18',
		 
		   
		   beforeSend: function(){
		  jQuery("#all_expense").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
		   },
		   success: function(msg)
		   {
				$("#all_expense").html(msg);
				$("#all_expense").show();
				$("#table_options").show();
				reloadbox();

			},
			error: function(){
				alert('error');
			}
		 });
}
function recieved_summary(date,uid)
{
	$.ajax({
			type: "POST",
			data: "date="+date+"&uid="+uid,
			url: 'request_process.php?calling=10',
		 
		   
		   beforeSend: function(){
		  jQuery("#all_recieved").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
		   },
		   success: function(msg)
		   {
				$("#all_recieved").html(msg);
				$("#all_recieved").show();
				$("#table_options").show();
				reloadbox();

			},
			error: function(){
				alert('error');
			}
		 });
}
function recievable_summary(date,uid)
	{	
		$.ajax({
				type: "POST",
				url: 'request_process.php?calling=11',
				data: "date="+date+"&uid="+uid,
			 
			   
			   beforeSend: function(){
			  jQuery("#all_recievable").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
			   },
			   success: function(msg)
			   {
					$("#all_recievable").html(msg);
					$("#all_recievable").show();
					$("#table_options").show();
					reloadbox();

				},
				error: function(){
					alert('error');
				}
			 });
	}
</script>
<script>
var i=2;
function recieveddown()
{
	
	if(i%2==0)
	{
		$(".recieved_apt").slideDown("slow");
		$(".recieved_sign").html("-");
	}
	else
	{
		$(".recieved_apt").slideUp("slow");
		$(".recieved_sign").html("+");
	}
	i++;
}
</script>
<script>
var i=2;
function recievableddown()
{
	
	if(i%2==0)
	{
		$(".recievable_details").slideDown("slow");
		$(".recievable_sign").html("-");
	}
	else
	{
		$(".recievable_details").slideUp("slow");
		$(".recievable_sign").html("+");
	}
	i++;
}
</script>
<script>
var i=2;
function expand_rooms(vid)
{
	
	if(i%2==0)
	{
		$(".rec_class"+vid).slideDown("slow");
		$(".rec_expand"+vid).html("-");
	}
	else
	{
		$(".rec_class"+vid).slideUp("slow");
		$(".rec_expand"+vid).html("+");
	}
	i++;
}
</script>

<script>
function depositdown()
{
	alert("Hello");
}
</script>
<script>
function deposit_summary(date,uid)
{
	$.ajax({
				type: "POST",
				url: 'request_process.php?calling=29',
				data: "date="+date+"&uid="+uid,
			 
			   
			   beforeSend: function(){
			  jQuery("#all_deposit").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
			   },
			   success: function(msg)
			   {
					$("#all_deposit").html(msg);
					$("#all_deposit").show();
					$("#table_options").show();
					reloadbox();

				},
				error: function(){
					alert('error');
				}
			 });
}
</script>
<script>
function deposit_out_summary(date,uid)
{
	$.ajax({
				type: "POST",
				url: 'request_process.php?calling=30',
				data: "date="+date+"&uid="+uid,
			 
			   
			   beforeSend: function(){
			  jQuery("#all_deposit_out").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
			   },
			   success: function(msg)
			   {
					$("#all_deposit_out").html(msg);
					$("#all_deposit_out").show();
					$("#table_options").show();
					reloadbox();

				},
				error: function(){
					alert('error');
				}
			 });
}
</script>
<script>
var i=2;
function expand_recievable(vid)
{
	
	if(i%2==0)
	{
		$(".recievable_rooms"+vid).slideDown("slow");
		$(".expand_recievable"+vid).html("-");
	}
	else
	{
		$(".recievable_rooms"+vid).slideUp("slow");
		$(".expand_recievable"+vid).html("+");
	}
	i++;
}
</script>
<style>
.bar_tabs-box ul.bar_tabs{
	background: unset;
	padding-left: 0px;
}
.bar_tabs-box ul.bar_tabs li:first-child{
	margin-left:0px;
}
@media screen and (max-width:534px)
{
	#chqs
	{
		margin-top: 1px;
	}
}
@media screen and (max-width:430px)
{
	#expense
	{
		margin-top: 1px;
	}
}
</style>
  </head>
<?php
include("header.php");
$userid=base64_decode($_REQUEST['id']);
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php
				$getName=$am->getAdminName($userid);
				echo $getName[0]['fld_name'];
				?> <small>Appartments</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>
			<div>
            <div class="row">
			
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
					</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  
					<div class="row"  style="overflow:auto;">
					<div class="col-sm-12 col-xs-12 bar_tabs-box">
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li id="payments" role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Payments</a>
                        </li>
                        <li id="pnl" role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Deposit</a>
                        </li>
                        <li id="pnl" role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Deposit Out</a>
                        </li>
                        <li id="expense" role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="true">Expense</a>
                        </li>
						<li id="chqs" role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="true">total</a>
                        </li>
                    </ul>
					</div>
					<div class="col-sm-12">
					
					<div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <p>
							<div class="dataTables_length" id="datatable_length">
								<label>Select Month
								<select name="datatablde_length" aria-controls="datatable" class="form-control input-sm" onchange="recieved_summary(this.value,<?=$userid?>); recievable_summary(this.value,<?=$userid?>);">
								<option value="">Select Month</option>
								<?php
									$GetMonth=$db->GetUniqueMonths();
									foreach($GetMonth as $month)
									{
										$convert=date("F Y",strtotime($month['fld_date']));
										?>
										<option value="<?=$month['fld_date']?>"><?=$convert?></option>
										<?php
									}
								?>
								</select>
								<input type="hidden" name="user" value="<?=$_REQUEST['id']?>" />
								</label>
							</div>
							<table id="datdatable" class="table table-striped table-bordered">
							  <thead>
								<tr>
								  <th onclick="recieveddown();" style="cursor:pointer;">Recieved<span class="recieved_sign" style="float:right;">+</span></th>
								  <th>Total</th>
								</tr>
							  </thead>
							  <tbody id="all_recieved">
								
							  </tbody>
							</table>
							<table id="datdatable" class="table table-striped table-bordered">
							   <thead>
								<tr>
									<th onclick="recievableddown();" style="cursor:pointer;">
									Recievable<span class="recievable_sign" style="float:right;">+</span>
									</th>
									<th>
									Total
									</th>
								</tr>
							  </thead>
							  <tbody id="all_recievable">
							  
							  </tbody>
							 
							</table>

						  </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                           <p>
							<div class="dataTables_length" id="datatable_length">
								<label>Select Month
								<select name="datatablde_length"
								aria-controls="datatable" class="form-control input-sm" onchange="deposit_summary(this.value,<?=$userid?>);">
								<option value="">Select Month</option>
								<?php
									$GetMonth=$db->GetUniqueMonths();
									foreach($GetMonth as $month)
									{
										$convert=date("F Y",strtotime($month['fld_date']));
										?>
										<option value="<?=$month['fld_date']?>"><?=$convert?></option>
										<?php
									}
								?>
								</select>
								<input type="hidden" name="user" value="<?=$_REQUEST['id']?>" />
								</label>
							</div>
							<table id="datdatable" class="table table-striped table-bordered">
							  <thead>
								<tr>
								  <th>Deposit By</th>
								  <th>Room</th>
								  <th>Deposit</th>
								</tr>
							  </thead>
							  <tbody id="all_deposit">
								
							  </tbody>
							</table>
						  </p>
                        </div>
						 <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                           <p>
							<div class="dataTables_length" id="datatable_length">
								<label>Select Month
								<select name="datatablde_length"
								aria-controls="datatable" class="form-control input-sm" onchange="deposit_out_summary(this.value,<?=$userid?>);">
								<option value="">Select Month</option>
								<?php
									$GetMonth=$db->GetUniqueMonths();
									foreach($GetMonth as $month)
									{
										$convert=date("F Y",strtotime($month['fld_date']));
										?>
										<option value="<?=$month['fld_date']?>"><?=$convert?></option>
										<?php
									}
								?>
								</select>
								<input type="hidden" name="user" value="<?=$_REQUEST['id']?>" />
								</label>
							</div>
							<table id="datdatable" class="table table-striped table-bordered">
							  <thead>
								<tr>
								  <th>Deposit By</th>
								  <th>Room</th>
								  <th>Deposit</th>
								</tr>
							  </thead>
							  <tbody id="all_deposit_out">
								
							  </tbody>
							</table>
						  </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                          <p>
							<div class="dataTables_length" id="datatable_length">
								<label>Select Month
								<select name="datatablde_length" aria-controls="datatable" class="form-control input-sm" onchange="expense_summary(this.value,<?=$userid?>);">
								<option value="">Select Month</option>
								<?php
									$GetMonth=$db->GetUniqueMonths();
									foreach($GetMonth as $month)
									{
										$convert=date("F Y",strtotime($month['fld_date']));
										?>
										<option value="<?=$month['fld_date']?>"><?=$convert?></option>
										<?php
									}
								?>
								</select>
								</label>
								</div>
								<table id="datdatable" class="table table-striped table-bordered">
								  <thead>
									<tr>
									  <th>Expense On</th>
									  <th>Expense Type</th>
									  <th>Payment to</th>
									  <th>Expense</th>
									  <th>Description</th>
									</tr>
								  </thead>
								  <tbody id="all_expense">
									
								  </tbody>
								</table>
								<input type="hidden" name="user" value="<?=$_REQUEST['id']?>" />
								
							 </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                          <p>
							<?php
								$rentIncome=$db->GetrentTotalByMonth(base64_decode($_REQUEST['id']),"2017-06");
								echo $rentIncome[0]['rent'];
							?>
						  </p>
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
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
          <!--   Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a> -->
          </div>
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