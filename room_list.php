<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();

if(isset($_GET['buildid'])){
    $bid = $_GET['buildid'];
    $am=new AdminManager();
    $am->updateExpenseStatus($bid);

    header('Location: expense_approval.php');
}

if(isset($_GET['expense_delete_id'])){
	$bid = $_GET['expense_delete_id'];
	$am=new AdminManager();
	$am->DeleteExpense($bid);

	header('Location: expense_approval.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
<style>
.red-circle
{
	background: #ffff19;
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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Room</title>

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
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Room </h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<h2>Edit Room Listing</h2>
						<table id="datdatable" class="table table-striped table-bordered">
							<thead>
								<tr>
                         
                                    <th>Building Name</th>
									<th>Room Name</th>
									<th>Custom Room Name</th>
									<th>Expected Rent</th>
									
                                    <th>Owner</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<?php
                              
                                $getRooms=$db->GetRooms();
								$getBookedRooms=$db->GetBookedRooms();
                                 
                                        foreach($getBookedRooms as $getBookedRoom)
                                            {
                                                
                                                $arr[] = $getBookedRoom['fld_id'];
                                            }
                                
								if($getRooms[0]!="")
								{  
									foreach($getRooms as $getRoom)
									{  
                                           if(!in_array($getRoom['fld_id'],$arr)){
                                             
										?>
										<tr>
                                         
										
											<td>
                                                <a href="room_gallery.php?rid=<?=base64_encode($getRoom['fld_id'])?>"></a>
												<?php echo $getRoom['Building']; ?>
											</td>
											<td>
												<?php echo $getRoom['fld_room_name']; ?>
											</td>
											<td>
                                                <?php echo $getRoom['fld_custom_room_name']; ?>
                                            </td>
                                           
                                             <td>
                                                <?php echo $getRoom['fld_expected_rent']; ?>
                                            </td>
                                           
											<td>
												<?php echo $getRoom['Admin']; ?>
											</td>

						<td>
                          <a href="edit_room.php?rid=<?php echo base64_encode($getRoom['fld_id']); ?>">Edit Room</a> 
						</td> 
										</tr>
                                    
										<?php
                                    }
                                
									}
								}									
							?>
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