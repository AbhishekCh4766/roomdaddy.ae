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
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" language="javascript">
	function transaction_summary()
	{	
		var datastring=$("#trans_user_filter").serialize();
		//alert(datastring);exit;
		$.ajax({
				type: "POST",
				data: datastring,
				url: 'request_process.php?calling=35',
			 
			   
			   beforeSend: function(){
			  jQuery("#trans_listing").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
			   },
			   success: function(msg)
			   {
				   //alert(msg);
					$("#trans_listing").html(msg);
					$("#trans_listing").show();
					$("#table_options").show();
					reloadbox();

				},
				error: function(){
					alert('error');
				}
			 });
	}
	function delete_expense(dates,id)
	{	
		//alert(dates);exit;
		var str = confirm("Are You Sure want to Delete the expense?");
		if(str==true)
		{
			$.ajax({
					type: "POST",
					data: "id="+id,
					url: 'request_process.php?calling=25&date='+dates,  
				   beforeSend: function(){
				  jQuery("#all_recieved").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
				   },
				   success: function(msg)
				   {
						expense_summary(dates);
						//alert(msg);

					},
					error: function(){
						alert('error');
					}
				 });
		}
		else
		{
			alert("False");
		}
	}
</script>
<!-- Custom Theme Style -->
<link href="build/css/custom.min.css" rel="stylesheet">
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
                <h3>Expense <small>Summary</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
					</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="overflow:auto;">
				  
					<table id="datdatable" class="table table-striped table-bordered">
						
							
							<tr>
							<th>
								First
							</th>
							<th>
								Second
							</th>
						</tr>
						<form id="trans_user_filter">
						
						<tr>
							<td>
							<select name="first" id="first" aria-controls="datatable" class="form-control input-sm" onchange="transaction_summary();">
									<option value="">First</option>
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
							</td>
							<td>
							<select name="second" id="second" aria-controls="datatable" class="form-control input-sm" onchange="transaction_summary();">
									<option value="">Second</option>
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
							</td>
						</tr>
						</form>
						
					</table>
                    <table id="datdatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>From</th>
                          <th>To</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Description</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
					  <tbody id="trans_listing">
						
					  </tbody>
                    </table>
					
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
            Powered by Saqib Ali
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