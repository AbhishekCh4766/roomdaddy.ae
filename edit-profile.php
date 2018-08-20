<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();
	$uid = $_SESSION['Enron FZE']['userid'];
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
    <link href="css/style.css" rel="stylesheet">
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
    <style>
      #blah {
    width: 150px !important;
    height: 150px !important;
}
    </style>
  </head>
<?php
include("header.php");

?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col">
        	
          <div class="title_left edit-pro">
                <h3>Edit Profile</h3>
                <?php 
              
	           $GetAdmins=$db->getAdminById($uid);
	          // print_r($GetAdmins);
                ?>
              </div>

                 <div class="clearfix"></div>

            
              <div class="col-md-12 col-sm-12 col-xs-12">
           

                          <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="process/update_profile_process.php">
        <div class="panel panel-default">
          <div class="panel-body text-center">
            <div class="image-upload">
                <label for="file-input">
                 <?php if($GetAdmins[0]['fld_profile_pic']!='') {?>
                    <img src="img/profile/<?=$GetAdmins[0]['fld_profile_pic']?>" alt="image" id="blah" class="img-circle profile-avatar"  style="height: 150px; width: 150px;"  />
                    
             
           
                    <?php }  
                            else {

                                ?>

                                <img src="http://roomdaddy.ae/img/images.jpeg" alt="image" class="img-circle profile-avatar"  style="height: 150px; width: 150px;" id="blah" />
                                
                         
                          <?php  } ?>

                             </label>

                <input id="file-input" type="file" name="profile_pic" onchange="readURL(this);" style="display: none;" />
                 </div>

           <input type="image" class="fs-anim-lower" id="pic_occupant" name="profile_pic" type="file" value="<?php echo $getTanent[0]['fld_profile_picture']?>" placeholder="" />

          </div>
        </div>
      <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">User info</h4>
        </div>
        <div class="panel-body">
         
          <div class="form-group">
            <label class="col-sm-3 control-label">Admin Name</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="name" value="<?php echo $GetAdmins[0]['fld_name']; ?>" required>
              <input type="hidden" name="id" value="<?php echo $uid; ?>" id="id" />
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-3 control-label">Admin Official Name</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="name" value="<?php echo $GetAdmins[0]['fld_official_name']; ?>" readonly>
              <input type="hidden" name="id" value="<?php echo $uid; ?>" id="id" />
            </div>
          </div>
           
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">Contact info</h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
            <label class="col-sm-3 control-label">Mobile number</label>
            <div class="col-sm-7">
              <input type="tel" class="form-control" name="number" value="<?php  echo $GetAdmins[0]['fld_number']; ?>" required/>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-3 control-label">E-mail address</label>
            <div class="col-sm-7">
              <input type="email" class="form-control" name="email" type="email" value="<?php  echo $GetAdmins[0]['fld_email']; ?>" required>
            </div>
          </div>
         
            <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <button type="submit" class="btn btn-primary submit_btn">Submit</button>
              <button type="reset" class="btn btn-default Cancel_btn">Cancel</button>
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
    </section>

            </form>

             

              </div>
        </div>

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <!-- <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div> -->
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script>
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
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