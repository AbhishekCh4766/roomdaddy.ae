<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();

if(isset($_GET['bedspaceid'])){
    $bid = $_GET['bedspaceid'];
    $am=new AdminManager();
    $am->updateBookingStatus($bid);

    header('Location: app-booked-room.php');
}

if(isset($_GET['bedspace_disapprove'])){
    $bid = $_GET['bedspace_disapprove'];
    $am=new AdminManager();
    $am->DisapproveBooking($bid);

    header('Location: app-booked-room.php');
}

if(isset($_GET['search'])){
     $bid = $_GET['search'];
        $db=new DBManager();
        $am->search_all_clients($data);

      }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
<style>
.red-circle
{
    background: #e40a0a;
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
#blah {
    width:50px !important;
    height:50px !important;
}

.pagination a {
    background: #ddd;
    height: 35px;
    float: left;
    width: 35px;
    text-align: center;
    color: #333;
    border-radius: 50%;
    padding: 7px 0 0 0;
    font-size: 13px;
    margin: 0 10px 0 0;
}
.pagination a:hover {
    background: #ccc;
}
.input-group {
  width: 50%;
    float: right;
}
.pagination a{
	height:auto;
	width:auto;
	border-radius: 0;
	margin:0px;
}
#myTable thead tr{
	background: #d3d3d3;
	color: #2a3f54;
}
.even{
	background: #eeeeee;
}
table.display thead th{
	border-bottom: 1px solid #d3d3d3 !important;
}
#myTable_wrapper #myTable thead tr{
	background: #d3d3d3;
	color: #2a3f54;
}
</style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tanent List</title>

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
                <h3>Tanent List</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              
                    <div class="x_panel">
                  
                        <table id="myTable" class="table table-striped table-bordered display"  >
                            <thead>
                            <tr>
                                      <th> STATUS</th>

                                      <th><b>TANENT NAME</b></th>
                                      <th>NATIONALITY</th>
                                      <th>EMAIL</th>
                                      <th>CONTACT NO.</th>
                                      <th>WHATSAPP NO.</th>
                                      <th>AREA</th>
                                      <th>BUILDING Name</th>
                                      <th>ROOM Name</th>
                                      <th>ACTION</th>

                            </tr>
                            </thead>
                            <?php
 
                                // $limit = 6;  
                                // if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                                // $start_from = ($page-1) * $limit;         
                                            //$GetBookingss=$db->GetAllClientdocs($start_from, $limit);
                                            $GetBookingss=$db->GetAllClientdocs();
                                            // echo "<pre/>";
                                            // print_r($GetBookingss);

                              if(!empty($GetBookingss))
                              {
                                      foreach ($GetBookingss as  $GetBookings) {
                                      ?>

                                      <tr>
                                            <td>  <?php if($GetBookings['fld_is_current_tanent']==0){ ?>
                                             <span class="red-circle" id="dewa_red">  </span> <?php } else {?>
                                       <span class="green-circle" id="dewa_green"></span> <?php } ?> </td>                   

                                            <td>
                                            <?php if(!empty($GetBookings['fld_actual_name'])){ echo $GetBookings['fld_actual_name'];} else {echo "Pending Tenent Approval";} ?>
                                            </td>
                                            <td>
                                            <?php
                                            if($GetBookings['fld_nationality'] != ''){ ?>
                                               <?php echo $GetBookings['fld_nationality']; ?></td>   
                                            <?php }else{
                                            echo '-';
                                            }
                                            ?> 

                                            </td>

                                            <td>
                                            <?php
                                            if($GetBookings['tenent_email'] != ''){ ?>
                                                <?php echo $GetBookings['tenent_email']; ?></td>   
                                            <?php }else{
                                            echo '-';
                                            }
                                            ?>  

                                            </td>
                                            
                                             <td>
                                            <?php
                                            if($GetBookings['tanent_num'] != ''){ ?>
                                                <?php echo $GetBookings['tanent_num']; ?></td>   
                                            <?php }else{
                                            echo '-';
                                            }
                                            ?> 
                                            </td>

                                            <td>
                                            <?php
                                            if($GetBookings['tanent_whatsapp'] != ''){ ?>
                                                <?php echo $GetBookings['tanent_whatsapp']; ?></td>   
                                            <?php }else{
                                            echo '-';
                                            }
                                            ?> 

                                            </td>
                                           
                                            <td>
                                               <?php
                                            if($GetBookings['fld_area'] != ''){ ?>
                                                <?php echo $GetBookings['fld_area']; ?></td>   
                                            <?php }else{
                                            echo '-';
                                            }
                                            ?> 
                                            </td>   

                                              <td>
                                               <?php
                                            if($GetBookings['fld_building'] != ''){ ?>
                                                <?php echo $GetBookings['fld_building']; ?></td>   
                                            <?php }else{
                                            echo '-';
                                            }
                                            ?> 
                                            </td>   

                                              <td>
                                               <?php
                                            if($GetBookings['fld_custom_room_name'] != ''){ ?>
                                                <?php echo $GetBookings['fld_custom_room_name']; ?></td>   
                                            <?php }else{
                                            echo '-';
                                            }
                                            ?> 
                                            </td>
                                            <td>
                                              <?php $ids=$GetBookings['fld_tanent_id'];
                                              $id=base64_encode($ids); ?>
                                              <a href="client-details.php?id=<?php echo $id;?>">Details</a>
                                            </td>
                                      </tr>
                                      <?php                                              
                                      }
                              }
                              else {
                              echo "No CLient Found";
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
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
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