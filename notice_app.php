<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();

if(isset($_GET['noticeid'])){
	$bid = $_GET['noticeid'];
	$am=new AdminManager();
	$am->updateNoticeStatus();

	header('Location: notice_app.php');
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

    <title>Notice Approval</title>

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
                <h3>Pending Notice Approvals </h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<h2>Approvals Listing</h2>
                        <?php 
                        $getNotices=$db->GetUnapprovedNotice();
                        //print_r($getNotices);
                        if($getNotices[0]!="")
                                {
                                    ?>
						<table id="datdatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Status</th>
									<th>Tenent Name</th>
									<th>Reason</th>
                                    <th>Move Out Date</th>
                                    <th>Remarks</th>
									<th>Ststus</th>
									<th>Details</th>
								</tr>
							</thead>
							<?php
								
								
                                   
									foreach($getNotices as $getNotice)
									{ 
                                        // echo "<pre/>";
                                        // print_r($getNotice);
                                           
										?>
										<tr>
											<td>
											<span class="red-circle" id="dewa_red"></span>
											<span class="green-circle" id="dewa_green" style="display:none;"></span>
											</td>
                                            <td>
                                                <?php echo $getNotice['fld_name']; ?>
                                            </td>
											<td>
												<?php echo $getNotice['move_out_reason']; ?>
											</td>
											
                                            <td>
                                                <?php echo $getNotice['move_out_date']; ?>
                                            </td>
											<td> 
                                                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?noticeid=<?php echo $getNotice['id']; ?> ">
                                                <input type="text" id="remarks" name="remarks">
												<input type="hidden"  name="id" value="<?php echo $getNotice['id']; ?>">
                            <input type="hidden" name="TenentId" value="<?php echo $getNotice['tenent_id']; ?>">
                            <input type="hidden" name="RoomId" value="<?php echo $getNotice['fld_room']; ?>">
                            <input type="hidden" name="BedSpaceId" value="<?php echo $getNotice['fld_bedspace_id']; ?>">

                                               
											</td>
                                            <td>
                                        <select name="status" >
                                        <option value="01">Approve</option>
                                        <option value="02">unapproved</option>

                                        </select>
                                            </td>
											<td>
												<a href="notice_details.php?cdetails=<?= $getNotice['id']; ?>">View Details</a> | 
                         
                                                <input value="Submit" type="submit" >
                                                </form>
											</td>
										</tr>
										<?php
									}
								}	
                                else {
                                    echo "No Pending Notices Found";
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