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
	<style>
	#fail_transaction{
		background-color: red;
padding: 6px;
margin: 6px;
color: white;
border-radius: 8px;

	}
	#success_transaction
	{
		background-color: green;
padding: 6px;
margin: 6px;
color: white;
border-radius: 8px;

	}
	</style>
	
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
<!--	
<script>
function Extract()
{  
   var datastring=$("#extract_frm").serialize();
   //alert(datastring);exit;
   $.ajax({
		type: "post",
		url: "request_process.php?calling=40",
		data: datastring,
		success: function(responseData, textStatus, jqXHR) {
			alert(responseData);
			if(responseData.search('done')!='-1')
			{
			   var arr=responseData.split('-');
				//alert(arr[1]);exit;
				$("#expense_frm")[0].reset();
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
</script>-->
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
                <h3>Get Report</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Select Range For Incoming/Outgoing</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="overflow:auto">
				  
					<div class="row">
					<div class="col-sm-12">
						<div id="myTabContent" class="tab-content">
					
							<table id="datdatable" class="table table-striped table-bordered">
								<tr>
									<form id="trans_frm" action="process/generate_report_process.php">
										<th>From</th>
										<td>
											<select name="from_date" id="from_date" class="form-control input-sm">
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
										</td>
										<td>	
											<select class="form-control input-sm" id="from_month" name="from_month">
												<option value="01">January</option>
												<option value="02">February</option>
												<option value="03">March</option>
												<option value="04">April</option>
												<option value="05">May</option>
												<option value="06">June</option>
												<option value="07">July</option>
												<option value="08">August</option>
												<option value="09">September</option>
												<option value="10">October</option>
												<option value="11">November</option>
												<option value="12">December</option>
											</select>
										</td>
										<td>
											<select class="form-control input-sm" id="from_year" name="from_year">
												<?php
												for($i=2016;$i<=date("Y");$i++)
												{
													?>
													<option value="<?=$i?>"><?=$i?></option>
													<?php
												}
												?>
											</select>
										</td>
									</tr>
								<tr>
						<th>To</th>
						<td>
							<select name="to_date" id="to_date" class="form-control input-sm">
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
						</td>
						<td>	
						<select class="form-control input-sm" id="to_month" name="to_month">
							<option value="01">January</option>
							<option value="02">February</option>
							<option value="03">March</option>
							<option value="04">April</option>
							<option value="05">May</option>
							<option value="06">June</option>
							<option value="07">July</option>
							<option value="08">August</option>
							<option value="09">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
						</td>
						<td>
						<select class="form-control input-sm" id="to_year" name="to_year">
							<?php
							for($i=2016;$i<=date("Y");$i++)
							{
								?>
								<option value="<?=$i?>"><?=$i?></option>
								<?php
							}
							?>
						</select>
						</td>
					</tr>					
					<tr>
						<td colspan="4">
							<input type="Submit" value="Extract All date" onclick="Extract();" class="btn btn-success"/>
						</td>
					</tr>
					</form>
							</table>
							
						</div>
					</div>
					
					</div>
                  </div>
                </div>
              </div>
            </div>
			<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Get Pending Recovery</h2>
                    <div class="clearfix">
					</div>
                  </div>
                  <div class="x_content" style="overflow:auto">
					<div class="row">
						<div class="col-sm-12">
							<div id="myTabContent" class="tab-content">
								<table id="datdatable" class="table table-striped table-bordered">
									<form method="POST" action="process/generate_recovery_status.php">
										<tr>
											<td colspan="4">
												<input type="Submit" value="Extract All date" onclick="Extract();" class="btn btn-success"/>
											</td>
										</tr>
									</form>
								</table>
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