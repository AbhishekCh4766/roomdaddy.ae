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

	function recieved_summary()
	{	
		$.ajax({
				type: "POST",
				url: 'request_process.php?calling=44',
			 
			   
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
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>
  <body onload="recieved_summary();"> 
<?php
include("header.php");
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Requests <small>For Approval</small></h3>
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
                  <div class="x_content">
				  
					
				  
				  
				  
				  
                    <table id="datdatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Apartment</th>
                          <th>View Details</th>
                          <th>Approve</th>
                          <th>Decline</th>
                        </tr>
                      </thead>
					  <tbody id="all_recieved">
					  
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
