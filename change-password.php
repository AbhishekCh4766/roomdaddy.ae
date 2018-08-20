<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();
$uid = $_SESSION['Enron FZE']['userid'];
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

    <title>Change Password</title>

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

        <script>
function change_password()
    {  
       var datastring=$("#change_password").serialize();
       //alert(datastring);exit;
       $.ajax({
            type: "post",
            url: "process/change-password-process.php",
            data: datastring,
            success: function(responseData, textStatus, jqXHR) {
                alert(responseData);exit;
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
<?php
include("header.php");
?>
        <!-- /top navigation -->
<form id="change_password" method="POST" >
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Change Password</h3>
              </div>
            </div>
            <div class="clearfix"></div>
          
    

      <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">Change Password</h4>
        </div>
        <div class="panel-body">
             <input type="hidden" name="id" value="<?php echo $uid; ?>">
			 <div class="col-sm-4">
				<div class="form-group">
					<div class="row">
						<label class="col-sm-12 control-label">Old Password :</label>
						<div class="col-sm-12">
						  <input type="Password" class="form-control" name="old_pass" placeholder="Enter your current Password" required/>
						</div>
				   </div>
				</div>
			</div>

			<div class="col-sm-4">
			  <div class="form-group">
				<div class="row">
					<label class="col-sm-12 control-label">New Password :</label>
					<div class="col-sm-12">
					  <input type="Password" class="form-control" name="password" id="password" type="password" placeholder="Enter New Password" required/>
					</div>
				</div>
			  </div>
			 </div>
        
			<div class="col-sm-4">
				<div class="form-group">
					<div class="row">
						<label class="col-sm-12 control-label">Confirm Password :</label> 
						<div class="col-sm-12">
						  <input type="Password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" onkeyup='check();' required>
						</div>
						<span id='message'></span>
					</div>	
				</div>
			 </div>

         

         
            <div class="col-sm-12" style="margin-top: 10px;">
            <div class="form-group">
              <button type="submit" id="enter" class="btn btn-primary submitBtn" onClick="return change_password();" disabled="true">Submit</button>
              <button type="reset" class="btn btn-default">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>
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
            
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
          <script>
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';

    $("#enter").prop('disabled',false)
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';

  }
}
</script>

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