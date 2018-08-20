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
	  
    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
	
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="admin/js/calendarcontrol.js"></script>
	<script>
function add_edit_chqs()
	{  
	   var datastring=$("#add_cheque").serialize();
	   //alert(datastring);exit;
	   $.ajax({
			type: "post",
			url: "request_process.php?calling=19",
			data: datastring,
			success: function(responseData, textStatus, jqXHR) {
				//alert(responseData);exit;
				if(responseData.search('done')!='-1')
				{
				   var arr=responseData.split('-');
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
	</script>
	
	
  </head>
  <body>
<?php
include("header.php");
$numofchqs=$db->GetNumofChqsByBuildingId(base64_decode($_REQUEST['bid']));
$chqs=$numofchqs[0]['fld_num_of_chqs'];
$tanent=$numofchqs[0]['fld_tanent'];
if(isset($_REQUEST['rid']))
{
	$rid=$_REQUEST['rid'];
}
else
{
	$rid="NULL";
}
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Cheque Details</h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                   <!--  <h2>Form Design <small>different form elements</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="add_cheque" method="post" class="form-horizontal form-label-left" action="process/add_edit_chq_process.php" enctype="multipart/form-data">
						<input type="hidden" name="rid" id="rid" value="<?=$rid?>" />
						<input type="hidden" name="num_of_chqs" id="num_of_chqs" value="<?=$chqs?>" />
						<input type="hidden" name="building" id="building" value="<?=$_REQUEST['bid']?>" />
						<input type="hidden" name="owner" id="owner" value="<?=$tanent?>" />
						<div id="note">
	
							<div class="onerow" id="error_div">
								<div id="fail" class="info_div" style="display:none;"><span class="ico_cancel">Ups, there was an error</span></div>
							</div>
							<div class="onerow">	
								<div id="success" class="info_div" style="display:none;"><span class="ico_success">Property Updated Successfully!</span></div>
							</div>	
							
							<div id="error_div" class="error_div" style="padding-left:10px;">
						   
							</div> 
						</div>
						<?php
						for($s=1;$s<=$chqs;$s++)
						{
						?>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Cheque <?=$s?> Owner</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="chq_owner<?=$s?>" class="form-control col-md-7 col-xs-12" required="required" type="text" name="chq_owner<?=$s?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Cheque <?=$s?> Amount</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="chq_amount<?=$s?>" class="form-control col-md-7 col-xs-12" required="required" type="text" name="chq_amount<?=$s?>">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Cheque <?=$s?> Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <select name="chq_date<?=$s?>" id="chq_date<?=$s?>">
								<?php
									for($i=1;$i<=31;$i++)
									{
										if($i<10)
										{
											$i="0".$i;
										}
										?>
										<option value="<?=$i?>"><?=$i?></option>
										<?php
									}
								?>
						  </select>
						  <select name="chq_month<?=$s?>" id="chq_month<?=$s?>">
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
						  <select name="chq_year<?=$s?>" id="chq_year<?=$s?>">
							<?php
								for($i=2015;$i<=date("Y")+3;$i++)
								{
									?>
									<option value="<?=$i?>"><?=$i?></option>
									<?php
								}
							?>
						  </select>
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Cheque <?=$s?> Date Till</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <select name="chq_date_till<?=$s?>" id="chq_date_till<?=$s?>">
								<?php
									for($i=1;$i<=31;$i++)
									{
										if($i<10)
										{
											$i="0".$i;
										}
										?>
										<option value="<?=$i?>"><?=$i?></option>
										<?php
									}
								?>
						  </select>
						  <select name="chq_month_till<?=$s?>" id="chq_month_till<?=$s?>">
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
						  <select name="chq_year_till<?=$s?>" id="chq_year_till<?=$s?>">
							<?php
								for($i=2015;$i<=date("Y")+3;$i++)
								{
									?>
									<option value="<?=$i?>"><?=$i?></option>
									<?php
								}
							?>
						  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Cheque <?=$s?> Num</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="chq_num<?=$s?>" class="form-control col-md-7 col-xs-12" required="required" type="text" name="chq_num<?=$s?>">
                        </div>
                      </div>
					  <div class="ln_solid"></div>
					  <?php
						}
					  ?>
                      <div class="ln_solid"></div>
                    
                    
					<div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancel</button>
						  <button class="btn btn-primary" type="reset">Reset</button>
						  <input type="submit" class="btn btn-success" onClick="return add_edit_chqs();"  name="add_edit_chqs" value="Submit"/>
                        </div>
                      </div>
					  </form>
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
    
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    
    <script src="vendors/nprogress/nprogress.js"></script>
    
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    
    <script src="vendors/iCheck/icheck.min.js"></script>
    
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>
    
    <script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    
    <script src="vendors/switchery/dist/switchery.min.js"></script>
    
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    
    <script src="vendors/autosize/dist/autosize.min.js"></script>
    
    <script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    
    <script src="vendors/starrr/dist/starrr.js"></script>
    
    <script src="build/js/custom.min.js"></script>
  </body>
</html>
