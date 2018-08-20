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

    <title>DataTables | Gentelella</title>

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
	<script type="text/javascript" language="javascript">
	var perpage;
	perpage = '';
	var totalpages;
	totalpages = '';
	var currentPageNumber = 1;
	function fleet_paging(buildingid)
	{	
		
		 $.ajax({
			   type: "POST",
			   url: 'request_process.php?calling=5',
			   data: "buildingid="+buildingid,
			 
			   
			   beforeSend: function(){
			  jQuery("#all_properties").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
			   },
			   success: function(msg)
			   {
						var msg1='';
						var startIndex = msg.search("<pc>");
						var endIndex = msg.search("</pc>");
						var totalCount='';
						if(startIndex != -1 && endIndex != -1)
						{
							totalpages = msg.substring(startIndex + 4, endIndex);
							msg=msg.substring(endIndex + 5, msg.length-1);
							if(totalpages>1){
							
								$("#pager").pager({ pagenumber: pageclickednumber, pagecount: totalpages, buttonClickCallback: PageClick });
								$("#pager").show();
							}
							else{
								$("#pager").hide();
							}
						}
					$("#all_properties").html(msg);
					$("#all_properties").show();
					$("#table_options").show();
					reloadbox();

				},
				error: function(){ //so, if data is retrieved, store it in html 
					alert('error');
					//$("#some").html('Error Loading Script'); //show the html inside .content div 
						//reloadbox();
				}
			 });
	}

PageClick = function(pageclickednumber)
{
	$("#pager").pager({ pagenumber: pageclickednumber, pagecount: totalpages, buttonClickCallback: PageClick });
	currentPageNumber = pageclickednumber;
	fleet_paging(pageclickednumber, '');
}


function delete_multiple_fleets(action)
{
	if(action=='delete'){
	if(confirm('Are you sure to delete the selected Properties?'))
	{
		$('#fleet_listing_frm').unbind('submit');
		var options = {
			target: '', 				// target element(s) to be updated with server response
			beforeSubmit: show_delete_multiple_fleets_Request, 	
			success: show_delete_multiple_fleets_Response, 		
			url: 'request_process.php?calling=7&action='+action 
		};
		$('#fleet_listing_frm').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
		});
	}
		
	}
	else{
	$('#fleet_listing_frm').unbind('submit');
	var options = {
	target: '', 				// target element(s) to be updated with server response
	beforeSubmit: show_delete_multiple_fleets_Request, 	
	success: show_delete_multiple_fleets_Response, 		
	url: 'request_process.php?calling=7&action='+action 
	};
	$('#fleet_listing_frm').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
	}
}

function show_delete_multiple_fleets_Request(formData, jqForm, options) 
{
	var queryString = $.param(formData);
	return true;
}

function show_delete_multiple_fleets_Response(responseText, statusText) 
{	
	if(responseText.search('done') != '-1')
	{
		window.location.reload();
	}
	else
	{
		alert(responseText);
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
                <h3>Users <small>Some examples to get you started</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Default Example <small>Users</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  
					<div class="row">
					<div class="col-sm-6">
					<div class="dataTables_length" id="datatable_length">
					<label>Select Appartment  
					<select name="datatablde_length" aria-controls="datatable" class="form-control input-sm" onchange="fleet_paging(this.value);">
					<option value="">Select Appartment</option>
					<?php
						$getBuilding=$db->getAllBuildings($_SESSION[ADMIN_SESSION_NAME]['userid']);
						foreach($getBuilding as $building)
						{
							?>
							<option value="<?=$building['fld_id']?>"><?=$building['fld_building']?> <?=$building['fld_apt_no']?></option>
							<?php
						}
					?>
					</select> 
					</label>
					</div>
					</div>
					<div class="col-sm-6">
					
					</div>
					</div>
				  
				  
				  
				  
                    <table id="datdatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Room Name</th>
                          <th>Status</th>
                          <th>Book</th>
                        </tr>
                      </thead>
					  <tbody id="all_properties">
					  
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
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
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