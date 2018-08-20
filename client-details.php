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
    <link href="build/css/custom.min.css" rel="stylesheet">
    <style>
      #blah {
    width:50px !important;
    height:50px !important;
}
    </style>
  </head>
<?php
    include("header.php");
    //$id =base64_decode($_GET['id']);
    $id =base64_decode($_GET['id']);
    $GetBookings=$db->GetALLClientBYid($id);
       

?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Tenent Details </h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        
                        <table id="datdatable" class="table table-striped table-bordered">
                            <thead>

                              <!--  <?php  echo "<pre/>"; print_r($GetBookings); ?>  -->
                                <tr>
                              
                                     <th>
                                        Area
                                    </th>
                                    <th>
                                        Building
                                    </th>
                                    <th>
                                        Tenent Name
                                    </th>
                                    <th>
                                       Tenent Contact Number
                                    </th>
                                       <th>
                                        Rent
                                    </th>
                                    <th>
                                        Deposit
                                    </th>
                                     <th>
                                        Comission
                                    </th>
                                    <th>
                                        Move in Date
                                    </th>
                                      <th>
                                         NATIONALITY
                                     </th>
                                     <th>
                                         No. Of. Occupants
                                     </th>
                                     <th>
                                         TYPE
                                     </th>
                              
                                </tr>
                                
                                <tr>
                                    <td>
                                        <?php
                                            if($GetBookings[0]['fld_area'] != ''){
                                                echo $GetBookings[0]['fld_area'];
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($GetBookings[0]['fld_building'] != ''){
                                                echo $GetBookings[0]['fld_building'];
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                        
                                    </td>
                                      <td>
                                        <?php
                                            if($GetBookings[0]['fld_name'] != ''){
                                                echo $GetBookings[0]['fld_name'];
                                            }
                                             elseif ($GetBookings[0]['fld_actual_name'] != '') {
                                                 echo $GetBookings[0]['fld_actual_name'];
                                             }

                                            else{
                                                echo '-';
                                            }
                                        ?>
                                        
                                    </td>
                                      <td>
                                        <?php
                                            if($GetBookings[0]['fld_number_client'] != ''){
                                                echo $GetBookings[0]['fld_number_client'];
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                        
                                    </td>
                                               <td>
                                        <?php
                                            if($GetBookings[0]['fld_rent'] != ''){
                                                echo $GetBookings[0]['fld_rent'];
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                        
                                    </td>
                                    <td>
                                        <?php
                                            if($GetBookings[0]['fld_deposit'] != ''){
                                                echo $GetBookings[0]['fld_deposit'];
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                        
                                    </td>
                                        <td>
                                        <?php
                                            if($GetBookings[0]['fld_comission'] != ''){
                                                echo $GetBookings[0]['fld_comission'];
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                        
                                    </td>

                                        <td>
                                        <?php
                                            if($GetBookings[0]['fld_move_in_date'] != ''){
                                                echo $GetBookings[0]['fld_move_in_date'];
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                        
                                    </td>
                                       <td>
                                       <?php
                                            if($GetBookings[0]['fld_nationality'] != ''){
                                                echo $GetBookings[0]['fld_nationality'];
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                       
                                   </td>
                                   <td>
                                        <?php
                                            if($GetBookings[0]['fld_num_of_occupants'] != ''){
                                                echo $GetBookings[0]['fld_num_of_occupants'];
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                       
                                   </td>
                                    <td>
                                                <?php if($GetBooking['fld_type']=='B'){echo "Bedspace"; } else { echo "Room"; } ?>
                                            </td>
                                   
                                </tr>
                            </thead>
                        </table>

                    
                          <table id="datdatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        Profile Pic
                                    </th>
                                    
                                    <th>
                                        PassPort
                                    </th>
                                    <th>
                                        VISA
                                    </th>
                                     <th>
                                         EMIRATES FRONT
                                     </th>
                                     <th>
                                         EMIRATES BACK
                                     </th>
                                      <th>CONTRACT DOCUMENT</th>
                                   
                                </tr>
                                
                                <tr>
                                 

                                     <td>
                                              <?php

                                          $target_path ='http://roomdaddy.ae/Profile/Picture/';
                                            if($GetBookings[0]['fld_profile_picture'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetBookings[0]['fld_profile_picture'];?>" target="_blank"><img src="<?=$target_path.$GetBookings[0]['fld_profile_picture'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                        
                                    </td>

                                    <td>
                                         <?php

                                          $target_path ='http://roomdaddy.ae/Passport/Picture/';
                                            if($GetBookings[0]['fld_passport_pic'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetBookings[0]['fld_passport_pic'];?>" target="_blank"><img src="<?=$target_path.$GetBookings[0]['fld_passport_pic'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                        
                                    </td>

                                      <td>
                                         <?php

                                          $target_path ='http://roomdaddy.ae/visa/Picture/';
                                            if($GetBookings[0]['fld_visa_page'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetBookings[0]['fld_visa_page'];?>" target="_blank"><img src="<?=$target_path.$GetBookings[0]['fld_visa_page'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                        
                                    </td>

                                       <td>
                                         <?php

                                          $target_path ='http://roomdaddy.ae/emiratefront/Picture/';
                                            if($GetBookings[0]['fld_emirates_front'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetBookings[0]['fld_emirates_front'];?>" target="_blank"><img src="<?=$target_path.$GetBookings[0]['fld_emirates_front'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                        
                                    </td>
                                     <td>
                                         <?php

                                          $target_path ='http://roomdaddy.ae/emirateback/Picture/';
                                            if($GetBookings[0]['fld_emirates_back'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetBookings[0]['fld_emirates_back'];?>" target="_blank"><img src="<?=$target_path.$GetBookings[0]['fld_emirates_back'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                    </td>
                                            <td>
                                              <form method="post" enctype="multipart/form-data" action="process/update_contract_image.php">
                                              <div class="image-upload">
                                               <label for="file-input">
                                               <?php if($GetBookings[0]['fld_contract_image']!='') {?>
                                             <img src="/roomdaddy/admin/img/contract/<?=$GetBookings[0]['fld_contract_image']?>" alt="image" id="blah" class="img-circle profile-avatar"  style="height: 50px; width: 50px;"  />
                    
             
           
                                              <?php }  
                                            else {

                                                    ?>

                                         <img src="http://roomdaddy.ae/roomdaddy/admin/img/contract/contract.jpeg" alt="image" class="img-circle profile-avatar"  style="height: 50px; width: 50px;" id="blah" />
                                
                         
                                          <?php  } ?>
                                        </label>
                                        <input id="file-input" type="file" name="contract_pic" onchange="readURL(this);" style="display: none;" />
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="Submit" id="Submit" name="Submit" style="display: none;">
                                        </form>
                                            </td>
                                  
                                        
                                    </td>
                                </tr>
                            </thead>
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

             $('#Submit').show();
        }
    }
</script>
  </body>
</html>