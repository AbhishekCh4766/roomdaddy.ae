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
<script>
function expense_type_listing()
	{	
		$.ajax({
				url: 'request_process.php?calling=37',
			   beforeSend: function(){
			  jQuery("#all_expense_type").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
			   },
			   success: function(msg)
			   {
				   //alert(msg);
					$("#all_expense_type").html(msg);
					$("#all_expense_type").show();
					$("#table_options").show();
					reloadbox();

				},
				error: function(){
					alert('error');
				}
			 });
	}
	function add_expense_type()
	{  
	   var datastring=$("#new_expense_type").val();
	   $.ajax({
			type: "post",
			url: "request_process.php?calling=38&&new_expense_type="+datastring,
			
			success: function(responseData, textStatus, jqXHR) {
				//alert(responseData);exit;
				if(responseData.search('done')!='-1')
				{
				   var arr=responseData.split('-');
				   $("#success").html(arr[1]);
				   $("#success").show();
				   $("#fail").hide();
				   expense_type_listing();
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
	function delete_expense_type(id)
	{	
		//alert(dates);exit;
		var str = confirm("Are You Sure want to Delete the expense type?");
		if(str==true)
		{
			$.ajax({
					type: "POST",
					data: "id="+id,
					url: 'request_process.php?calling=39&id='+id,  
				   beforeSend: function(){
				  jQuery("#all_recieved").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
				   },
				   success: function(msg)
				   {
						expense_type_listing();
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
 <body  onLoad="expense_type_listing()">
 
 </body>
<?php
include("header.php");
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" onload="expense_type_listing()">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Expense Type</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="overflow:auto">
				  
					<div class="row">
					<div class="col-sm-12" >
						<table id="datdatable" class="table table-striped table-bordered" onLoad="expense_type_listing()">
							<tr>
								<th>
									Add New(*)
								</th>
								<td>
									<input type="text" id="new_expense_type" name="new_expense_type" required="required"/>
								</td>
								<td>
									<button onclick="expense_type_listing(); add_expense_type();"  class="btn btn-success" >ADD</button>
								</td>
							</tr>
						</table>
						<table id="datdatable" class="table table-striped table-bordered" onLoad="expense_type_listing()">
							<tr>
								<th>
									Expense Type
								</th>
								<th>
									Delete
								</th>
							</tr>
							<tbody id="all_expense_type">
						
							</tbody>
						</table>
					</div>
					<div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <p>
					<div class="col-sm-12">
					<div class="">
					
					</div>
					</div>
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