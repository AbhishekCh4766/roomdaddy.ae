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
    <?php 
    if(isset($_GET['field_id'])){
     
	$bid = $_GET['field_id'];
	$db->updateComplainStatus($id, $complainid);
    
	header("location:get_complaints.php");
     
}      

   ?>
	<script>
	function openchat(tid)
{
	$.ajax({
			   type: "POST",
			   url: 'request_process.php?calling=42',
			   data: "tid="+tid,
			   beforeSend: function(){
			   },
			   success: function(msg)
			   {
					$("#displaychat").html(msg);
					//reloadbox();

				},
				error: function(){ //so, if data is retrieved, store it in html 
					alert('error');
					//$("#some").html('Error Loading Script'); //show the html inside .content div 
						//reloadbox();
				}
			 });
}
	
function addcomment()
{
	var subcomplaint=$("#subcomplaint").val();
	var senderid=$("#senderid").val();
	var sender=$("#sender").val();
	var message=$("#message").val();
	if(message == ''){
		alert('Please enter message');
		return false;
	}
	var datastring="&subcomplaint="+subcomplaint+"&senderid="+senderid+"&sender="+sender+"&message="+message;
		$.ajax({
		type: "post",
		url: "request_process.php?calling=45"+datastring,
		success: function(responseData, textStatus, jqXHR) {
			openchat(responseData);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	})
}
	</script>
   

    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>
<?php
include("header.php");
$complaint=base64_decode(base64_decode($_REQUEST['cdetails']))
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Complaints </h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<h2>Complaints Listing</h2>


						         <?php
									$getComplaint=$db->GetComplaintById($complaint);
								
								  ?>
								  <table id="datdatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>
										Prefer Time
									</th>
									<th>
										Prefer Date
									</th>
									<th>
										Description
									</th>
									<th>
										Images
									</th>
								</tr>
								</thead>
								<tr>
									<td>
										<?=$getComplaint[0]['fld_prefer_time']?>
									</td>
									<td>
										<?=$getComplaint[0]['fld_prefer_date']?>
									</td>
									<td>
										<?=$getComplaint[0]['fld_complaint_description']?>
									</td>
									<td>

										<?php   if($getComplaint[0]['fld_attachment_one'] != '' || $getComplaint[0]['fld_attachment_two'] != '' || $getComplaint[0]['fld_attachment_three'] != '')
										{



										$target_path = 'http://roomdaddy.ae/Complaint/Complain_DOCS/'; 
									
										    if($getComplaint[0]['fld_attachment_one'] != '')
                                               {
                                               	?>
                                              <a href="<?php echo $target_path.$getComplaint[0]['fld_attachment_one'];?>" target="_blank"><img src="<?=$target_path.$getComplaint[0]['fld_attachment_one'];?>" width="60" height="40"></a> 	

                                               	<?php
                                               }

                                               if($getComplaint[0]['fld_attachment_two'] != '')
                                               {
                                               	?>

                                               	 <a href="<?php echo $target_path.$getComplaint[0]['fld_attachment_two'];?>" target="_blank"><img src="<?=$target_path.$getComplaint[0]['fld_attachment_two'];?>" width="60" height="40"></a> 	
                                                
                                               	<?php
                                               }

                                               if($getComplaint[0]['fld_attachment_three'] != '')
                                               {
                                               	?> <a href="<?php echo $target_path.$getComplaint[0]['fld_attachment_three'];?>" target="_blank"><img src="<?=$target_path.$getComplaint[0]['fld_attachment_three'];?>" width="60" height="40"></a> 
                                               
                                               	<?php
                                               }

                                               }
                                               else
                                               {
                                               	echo "No Images Uploaded";
                                               }
										    	?>
										
										
										
								
									</td>
								</tr>
							
							</table>

								  <?php
									$getSubcomplaint=$db->getSubComplaintsByComplaint($complaint);
									foreach($getSubcomplaint as $subcomp)
									{
										// echo "<pre/>";
										// print_r($subcomp);
										// die;
										?>
						<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>?field_id=<?php echo $subcomp['fld_id'] ?>&complain_id=<?php echo $subcomp['fld_complaint_id'];?>">
						
							<table id="datdatable" class="table table-striped table-bordered">
							<tr>
								
								<th>
									Complaint Type
								</th>
								<th>
									Assign To
								</th>
								<th>
									Assign Date
								</th>
								<th>
									Submit
								</th>
							</tr>
							
								
										<tr>
											
                                     
											<td onclick="openchat(<?=$subcomp['fld_id']?>)">
												<?=$subcomp['fld_complaint_type']?>

											</td>

											
											<td>
                                                        <?php $getadmins=$db->getadminname();?>
												<select class="form-control input-sm" name="admin_id" required="" >
													<option>Select to Assign</option>
                                                   <?php 	foreach ($getadmins as $getadmin) {  ?>
                                                      
													<option value="<?php echo $getadmin['fld_id']; ?>">
														
															<?php echo $getadmin['fld_name']; ?>
														</option>
													 <?php } ?>
												</select>
											</td>
									   
											<td>

												<input type="hidden" name="field_id" value="<?php echo $subcomp['fld_id']; ?> ">
												<input type="hidden" name="complain_id" value="<?php echo $subcomp['fld_complaint_id']; ?> ">	
												<input type="date" name="date" format="y-m-d" required="">

											</td>
									
												
												<td>
													<input type="submit" onclick="return confirm('Data Saved Successfully! Click Ok');" name="submit">
												</td>
												
										</tr>
									
						</table>
						</form>
							<?php
									}
								?>
						<div id="displaychat">
						
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    <!--   <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>