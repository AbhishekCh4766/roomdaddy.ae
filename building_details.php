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
	$GetDetails=$am->getBuildDetailsById($bid);
	foreach($GetDetails as $detail)
	{
		//print_r($detail);
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
										Area
									</th>
									<th>
										Building
									</th>
									<th>
										Contract Start Date
									</th>
									<th>
										Contract End Date
									</th>
								</tr>
								
								<tr>
									<td>
										<?php
											if($detail['fld_area'] != ''){
												echo $detail['fld_area'];
											}else{
												echo '-';
											}
										?>
									</td>
									<td>
										<?php
											if($detail['fld_building'] != ''){
												echo $detail['fld_building'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_contract_starting_date'] != ''){
												echo $detail['fld_contract_starting_date'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_contract_ending_date'] != ''){
												echo $detail['fld_contract_ending_date'];
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
										Dewa
									</th>
									<th>
										Du
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
											if($detail['fld_dewa'] != ''){
												echo $detail['fld_dewa'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_du'] != ''){
												echo $detail['fld_du'];
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
										Empower
									</th>
									<th>
										Number of Rooms
									</th>
									<th>
										Number of Cheques
									</th>
									<th>
										Apartment Number
									</th>
								</tr>
								
								<tr>
									<td>
										<?php
											if($detail['fld_empower'] != ''){
												echo $detail['fld_empower'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_num_of_beds'] != ''){
												echo $detail['fld_num_of_beds'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_num_of_chqs'] != ''){
												echo $detail['fld_num_of_chqs'];
											}else{
												echo '-';
											}
										?>
										
									</td>
									<td>
										<?php
											if($detail['fld_apt_no'] != ''){
												echo $detail['fld_apt_no'];
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