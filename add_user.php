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
	  
    <title>Online Munshi System </title>

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
	var i=2;
function getUser(roles)
{	
	if(roles==="Access to Apartment")
	{
		
		if(i%2===0)
		{
			document.getElementById("users").style.display="inline";
		}
		if(i%2!=0)
		{
			document.getElementById("users").style.display="none";
		}
		i=i+1;
	}
}
	</script>
	<script>
	function add_user()
	{
		var datastring=$("#add_beneficiary").serialize();
	    //alert(datastring);exit;
	   $.ajax({
			type: "post",
			url: "request_process.php?calling=43",
			data: datastring,
			success: function(responseData, textStatus, jqXHR) {
        //alert(responseData);exit;
				alert('User Added Successfully!!');exit;
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
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add User</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 <!--  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div> -->
                </div>
              </div>
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
                    <form id="add_beneficiary" method="post" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="user_name" name="user_name" required="required" class="form-control col-md-7 col-xs-12">
							<input type="hidden" name="add_by" id="add_by" value="<?=$_SESSION[ADMIN_SESSION_NAME]['userid']?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Official Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="official_name" name="official_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Number <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="number" name="number" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="form-group">
						<?php
            $uid = $_SESSION['Enron FZE']['userid'];
            $arr = array();
            $am=new AdminManager();
          $GetUserRoles=$am->getalluserroles();
                foreach($GetUserRoles as $admins)
          {
            $arr[] = $admins['fld_role'];
          }
             if(in_array('10',$arr)){
						$getallRoles=$db->GetRoles();
						foreach($getallRoles as $roles)
						{
							?>
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=$roles['fld_role']?></label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<input type="checkbox" name="role[]" id="role[]" value="<?=$roles['fld_id']?>" onclick="getUser(this.value)" class="form-control col-md-7 col-xs-12"/>
							</div>
							<?php
						}
          }
            elseif(in_array('8',$arr))
            {
              $getallRoles=$db->GetAllRoles();
            foreach($getallRoles as $roles)
            {
              ?>
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=$roles['fld_role']?></label>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="checkbox" name="role[]" id="role[]" value="<?=$roles['fld_id']?>" onclick="getUser(this.value)" class="form-control col-md-7 col-xs-12"/>
              </div>
              <?php
            }
            }
						?>
					  </div>
					  <div class="form-group" id="users" style="display:none;">
						<?php
						$getAllUsers=$db->getSuperAdmin();
						foreach($getAllUsers as $user)
						{
							?>
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=$user['fld_name']?></label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<input type="checkbox" value="<?=$user['fld_id']?>"  name="user[]" id="user[]" class="form-control col-md-7 col-xs-12"/>
							</div>
							<?php
						}
						?>
					  </div>
                      <div class="ln_solid"></div>
                     
                    </form>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						  <button class="btn btn-primary" type="button">Cancel</button>
						  <input type="submit" class="btn btn-success" onClick="return add_user();"  name="add_user" value="Add beneficiary"/>
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
			Website By Saqib Ali
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
