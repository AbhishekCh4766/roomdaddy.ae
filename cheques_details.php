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
	 <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">
	 <script src="js/jquery.dropdown.js"></script>
	 
	 <link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">
	<script type="text/javascript" language="javascript">
	function getData()
	{	
		var datastring=$("#chq_form").serialize();
		alert(datastring);exit;
		$.ajax({
				type: "POST",
				data: datastring,
				url: 'request_process.php?calling=33',
			 
			   
			   beforeSend: function(){
			  jQuery("#all_chqs_detail").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
			   },
			   success: function(msg)
			   {
				   //alert(msg);
					$("#all_chqs_detail").html(msg);
					$("#all_chqs_detail").show();
					$("#table_options").show();
					reloadbox();

				},
				error: function(){
					alert('error');
				}
			 });
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
                <h3>DashBoard </h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
					
                    <h2>Cheques </h2>
                    <div class="clearfix"></div>
                  </div>
				 <table id="datdatable" class="table table-striped table-bordered">
					<form id="chq_form">
					<thead>
						<tr>
							<td>
								<select class="form-control input-sm" name="year" id="year" onchange="getData()">
									<option value="<?=date("Y")?>">Select Year</option>
									<?php
									for($i=2015;$i<=date("Y")+2;$i++)
									{
										?>
										<option value="<?=$i?>"><?=$i?></option>
										<?php
									}
									?>
								</select>
							</td>
							<td>
								<div class="dropdown-mul-2">
									<select id="owner[]" multiple  name="owner[]" onchange="getData()">
									<option value="">Select Owner</option>
										<?php
										$GetOwner=$db->getSuperAdmin();
										foreach($GetOwner as $owner)
										{
											?>
											<option value="<?=base64_encode($owner['fld_id'])?>"><?=$owner['fld_name']?></option>
											<?php
										}
										?>
									</select>
								  </div>
							</td>
							
						</tr>
					</thead>
					</form>
					 <script>
 
    $('.dropdown-mul-2').dropdown({
      limitCount: 5,
      searchable: false
    });
  </script>
				 </table>
                  <div class="x_content">
					<div class="row">
					<div style="overflow:auto;">
						<table id="datdatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<td></td>
									<th>January</th>
									<th>February</th>
									<th>March</th>
									<th>April</th>
									<th>May</th>
									<th>June</th>
									<th>July</th>
									<th>August</th>
									<th>September</th>
									<th>October</th>
									<th>November</th>
									<th>December</th>
								</tr>	
							</thead>
							<thead id="all_chqs_detail">
							
							</thead>
						</table>
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

