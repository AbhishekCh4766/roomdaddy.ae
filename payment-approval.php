<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();
  if(isset($_GET['paymentid'])){
    $bid = $_GET['paymentid'];
    $am=new AdminManager();
    $am->updatePaymentStatus($bid);

    header('Location: payment-approval.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment History</title>
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
	#fail_transaction,#fail_expense{
		background-color: red;
padding: 6px;
margin: 6px;
color: white;
border-radius: 8px;

	}
	#success_transaction,#success_expense
	{
		background-color: green;
padding: 6px;
margin: 6px;
color: white;
border-radius: 8px;

	}
	.paymnt_fond {
    text-align: center;
} 
.x_title{
	border: none !important;
}
	</style>
	
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
                <h3>Payment Approval</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title x_title_brder">
                   <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<h2>Payment Approval</h2> <br>

                        <?php 
                       $GetPaymentHistorys=$db->GetPaymentHistory();
                        
                        if($GetPaymentHistorys[0]!="")
                                {

                                    ?>
						<table id="datdatable" class="table table-striped table-bordered">
							<thead>
									<tr>
							</tr>
								<tr>
									<th>Sr. No.</th>
									<th>Payment By</th>
									<th>Payment To</th>
									<th>Entered By</th>
                                    <th>Date</th>
									<th>Details</th>
                                    <th>Payment Amount</th>
									<th>Action</th>

								</tr>
							
							</thead>
							<?php
								
								 $i=0;
                                   
									foreach($GetPaymentHistorys as $GetPaymentHistory)
									{      
										 // echo "<pre/>";
           //                                  print_r($GetPaymentHistory);
										$i++;
										?>
										<tr>
										     <td>
										     	 <?php echo $i; ?>
										     </td>
                                            <td>
                                                <?php echo $GetPaymentHistory['fld_payment_by']; ?>
                                            </td>
											<td>
												<?php echo $GetPaymentHistory['fld_payment_to']; ?>
											</td>
										
											
                                            <td>
                                                <?php echo $GetPaymentHistory['transaction_by']; ?>
                                            </td>
                                            <td>
                                                <?php echo $GetPaymentHistory['fld_payment_date']; ?>
                                            </td>
                                            <td>
                                                <?php echo $GetPaymentHistory['fld_description']; ?>
                                            </td>
                                            	<td>
                                                <?php echo $GetPaymentHistory['fld_payment']; ?>
                                            </td>

                                            <td>
												 <a href="<?php $_SERVER['PHP_SELF']; ?>?paymentid=<?php echo $GetPaymentHistory['fld_id']; ?>">Approve</a>
											</td>
										
                                            
										</tr>
                                        <br>
										<?php
									}
								}	
                                else {
                                          ?>
                                   <p class="paymnt_fond"> No New  Payment Found</p>  
      <?php                             }								
							?>
						</table>
                        <!-- <a href="pdf_invoice.pdf"> generate pdf</a> -->
					</div>
				</div>

                   </div>
               </div>
           </div>
       </div>
   
      

        <!-- footer content -->
     
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