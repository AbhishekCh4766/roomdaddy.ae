<?php 
	include_once("dbbridge/top.php");
	include_once("common/security.php");
	$am= new AdminManager();
	$admin_info=$am->getAdmin($_SESSION[ADMIN_SESSION_NAME]['userid']);
	
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
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet" />
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet" />
    <!-- bootstrap-wysiwyg -->
    <link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet" />
    <!-- Select2 -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Switchery -->
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet" />
    <!-- starrr -->
    <link href="vendors/starrr/dist/starrr.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet" />
	
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
		<script>
	function admin_setting()
	{  
	   var datastring=$("#admin_setting_frm").serialize();
	   
	   $.ajax({
			type: "post",
			url: "request_process.php?calling=3",
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
<div class="container" id="container">
<?php
include("header.php");
?>

	<!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Form Elements</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Design <small>different form elements</small></h2>
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
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="admin_setting_frm" method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
						<div id="note">
	
							<div class="onerow" id="error_div">
								<div id="fail" class="info_div" style="display:none;"><span class="ico_cancel">Ups, there was an error</span></div>
							</div>
							<div class="onerow">	
								<div id="success" class="info_div" style="display:none;"><span class="ico_success">Settings Changed Successfully!</span></div>
							</div>	
							
							<div id="error_div" class="error_div" style="padding-left:10px;">
						   
							</div> 
						</div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <input id="" name="uname" type="text" size="30" tabindex="1" class="form-control col-md-7 col-xs-12" value="<?php echo $admin_info[0]['fld_name'];?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <input id="" name="email" type="text" size="30" tabindex="1" class="form-control col-md-7 col-xs-12" value="<?php echo $admin_info[0]['fld_email'];?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Old Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="oldpass" name="oldpass" type="password" size="30" tabindex="1" value="" class="form-control col-md-7 col-xs-12"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">New Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pwd" name="pwd" type="password" size="30" tabindex="1" value="" class="form-control col-md-7 col-xs-12"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <input id="cpwd" name="cpwd" type="password" size="30" tabindex="1" value=""  class="form-control col-md-7 col-xs-12"/>
                        </div>
                      </div>
					
                      <div class="ln_solid"></div>
					  </form>
                     <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancel</button>
						  <button class="btn btn-primary" type="reset">Reset</button>
						  <input type="submit" class="btn btn-success" onClick="return admin_setting();"  name="add_edit_property" value="Submit"/>
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
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    <script type="text/javascript" src="js/jquery.form.js"></script>
	
	
	
	<script src="vendors/jquery/dist/jquery.min.js"></script>

	<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
   <script src="build/js/custom.min.js"></script>
  </body>
</html>