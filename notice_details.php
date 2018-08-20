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
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>
<?php
	include("header.php");
	$bid = $_GET['cdetails'];
	$am=new AdminManager();
	$GetDetails=$am->getNoticeDetailsById($bid);
	foreach($GetDetails as $detail)
	{
		// print_r($detail);

	}
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Details </h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						
						<table id="datdatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>
										Tenent Name
									</th>
									<th>
										Move Out Reason
									</th>
									<th>
										Rating
									</th>
									<th>
										Move Out Date
									</th>
									<th>
										Notice Created on
									</th>
								</tr>
								
								<tr>
									<td>
										<?php
											if($detail['fld_name'] != ''){
												echo $detail['fld_name'];
											}else{
												echo '-';
											}
										?>
									</td>
									<td>
										<?php
											if($detail['move_out_reason'] != ''){
												echo $detail['move_out_reason'];
											}else{
												echo '-';
											}
										?>
									</td>
									<td>
										<?php
											if($detail['rating'] != ''){
												echo $detail['rating'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['move_out_date'] != ''){
												echo $detail['move_out_date'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['created_at'] != ''){
												echo $detail['created_at'];
											}else{
												echo '-';
											}
										?>
										
									</td>
								</tr>
							</thead>
						</table>

						<table id="datdatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>
										Rent
									</th>
									<th>
										Deposit
									</th>
									<th>
										Comission
									</th>
									<th>
										Nationality
									</th>
									<th>
										Room
									</th>
								</tr>
								
								<tr>
									<td>
										<?php
											if($detail['fld_rent'] != ''){
												echo $detail['fld_rent'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_deposit'] != ''){
												echo $detail['fld_deposit'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_comission'] != ''){
												echo $detail['fld_comission'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_nationality'] != ''){
												echo $detail['fld_nationality'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_room'] != ''){
												echo $detail['fld_room'];
											}else{
												echo '-';
											}
										?>
										
									</td>
								</tr>
							</thead>
						</table>


						<table id="datdatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>
										Bedspace Id
									</th>
									<th>
										Sex
									</th>
									<th> 
										Phone Number 
									</th>
									<th>
										WhatsApp Number
									</th>
								</tr>
								
								<tr>
									<td>
										<?php
											if($detail['fld_bedspace_id'] != ''){
												echo $detail['fld_bedspace_id'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_sex'] != ''){
												echo $detail['fld_sex'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_number'] != ''){
												echo $detail['fld_number'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_whatsapp_no'] != ''){
												echo $detail['fld_whatsapp_no'];
											}else{
												echo '-';
											}
										?>
										
									</td>
								
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
           
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