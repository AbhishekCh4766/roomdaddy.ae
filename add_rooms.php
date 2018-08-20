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
	  
    <title>Add Rooms  </title>

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
function edit_rooms()
	{  
	   var datastring=$("#add_room").serialize();
	   //alert(datastring);exit;
	   $.ajax({
			type: "post",
			url: "request_process.php?calling=20",
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
  <body>
<?php
include("header.php");
$numobeds=$db->GetNumofChqsByBuildingId(base64_decode($_REQUEST['bid']));
$beds=$numobeds[0]['fld_num_of_beds'];
$tanent=$numobeds[0]['fld_tanent'];
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Room</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <!-- <div class="input-group">
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
                    <!-- <h2>Form Design <small>different form elements</small></h2>
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
                    <form id="add_room" method="post" class="form-horizontal form-label-left" action="process/add_edit_room_process.php" enctype="multipart/form-data">
						<input type="hidden" name="num_of_beds" id="num_of_beds" value="<?=$beds?>" />
						<input type="hidden" name="building" id="building" value="<?=$_REQUEST['bid']?>" />
						<input type="hidden" name="owner" id="owner" value="<?=$tanent?>" />
						<div id="note">
							<div class="onerow" id="error_div">
								<div id="fail" class="info_div" style="display:none;"><span class="ico_cancel">Ups, there was an error</span></div>
							</div>
							<div class="onerow">	
								<div id="success" class="info_div" style="display:none;"><span class="ico_success">Property Updated Successfully!</span></div>
							</div>
							<div id="error_div" class="error_div" style="padding-left:10px;"></div> 
						</div>
						<?php
						for($i=1;$i<=$beds;$i++)
						{
						?>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Room <?=$i?> Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="room_name<?=$i?>" class="form-control col-md-7 col-xs-12" required="required" type="text" name="room_name<?=$i?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Room <?=$i?> Expected Rent</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="room_rent<?=$i?>" class="form-control col-md-7 col-xs-12" required="required" type="text" name="room_rent<?=$i?>">
                        </div>
                      </div>



                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Avalability Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
    
                        <input type="date" name="avalability_date<?=$i?>">
                        </div>
                      </div>
                        
                        <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Balconices</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         

                          <select name="balconices<?=$i?>" style="height:30px;">
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                          </select> 
                        </div>
                      </div>
                      
                      <input type="hidden" name="no_of_bedspace<?=$i?>" value="4">

                      <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Metro/Train</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="room_rent" class="form-control col-md-7 col-xs-12"  type="text" name="metro_train<?=$i?>"  >
                        </div>
                      </div>

                      <div class="form-group">

                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Occupancy</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="room_rent" class="form-control col-md-7 col-xs-12"  type="text" name="occupancy<?=$i?>" >
                        </div>
                      </div>
                        <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="gender<?=$i?>" style="height:30px;">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="B">Both</option>
                          </select>
                        </div>
                       </div>

                         <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bath</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="bath<?=$i?>" style="height:30px;width:100%;">
                            <option value="Attached Bath">Attached Bath</option>
                            <option value="Shared Bath">Shared Bath</option>
                         
                          </select>
                        </div>
                       </div>


                        <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Common Room</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                       <select name="common_room<?=$i?>" style="height:30px;width:100%;">
                            <option value="No Living Room">No Living Room</option>
                            <option value="Huge Living Room">Huge Living Room</option>
                            <option value="Small Living Room">Small Living Room</option>
                          </select>

                     
                        </div>
                       </div>


                     


                     <div class="form-group">
                         <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Window</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="wins<?=$i?>" style="height:30px;width:100%;">
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                           
                          </select>
                        </div>
                       </div> 

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Notes</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control col-md-7 col-xs-12" name="notes<?=$i?>" id="notes"></textarea>
                        </div>
                      </div>
                          
                          <input type="hidden" value="<?=$i?>">
                          <input type="hidden" name="file_name[]" />
                        <!--   <input name="<?php //echo $i;?>image[]" type="file" class="btn"/> -->
                          <button class="add_more btn for_image_dunamic_name" data-id="<?=$i?>">Add Room Images</button>
                            <div class="ln_solid"></div>
                     <?php
						}
					?>
					  <div class="ln_solid"></div>
					  <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancel</button>
						  <button class="btn btn-primary" type="reset">Reset</button>
						  <input type="submit" class="btn btn-success" onClick="return edit_rooms();"  name="edit_rooms" value="Submit"/>
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
          
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script>
           $(document).ready(function(){

              var count=1;
              $('.add_more').click(function(e){
                e.preventDefault();
                count++;//count button clicked
                var image_name = $(this).attr("data-id");
               // var  image_name = $this.val();
                // var image_name =  $(".for_image_dunamic_name").attr("data-id");

                 //alert(image_name);

               console.log('dsfsd',count);
          
                $(this).before(`<div class="add_image"><button class="remove_image remove_room_image" data-id="N">X</button><img id="`+count+`_blah" alt="" width='100' height='100'/><input type="hidden" name="image_id`+image_name+`[]" value=""/><input type='file' name='image`+image_name+`[]' class='btn' onchange='document.getElementById("`+count+`_blah").src = window.URL.createObjectURL(this.files[0])'></div>`);
              });
            });
    </script>
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

    <script type="text/javascript">
      
      
   //Remove Image..

   $(document).on('click', '.remove_room_image', function(e)
   {
    e.preventDefault();
    //alert('ghjhdfdf');
    var image_id = $(this).attr("data-id");
    //alert(image_id);

    if(image_id !='N')
    {
      $.ajax({
        type: "post",
        url: "request_process.php?calling=48",
        data: {id:image_id},
        success: (json) => {
        $(this).parent().remove();
        },
        error: function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
        }
      })
    }else{
     $(this).parent().remove();
    }
   });
    </script>
  </body>
</html>
