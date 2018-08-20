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
      <title>Edit Room </title>
      <!-- Bootstrap -->
      <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!-- Font Awesome -->
      <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <!-- NProgress -->
      <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
      <!--  iCheck -->
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
      <!-- <script type="text/javascript" src="js/jquery.form.js"></script>
         <script type="text/javascript" src="admin/js/calendarcontrol.js"></script> -->
      <script>
         function edit_rooms()
          {  
             var datastring=$("#add_room").serialize();
             //alert(datastring);exit;
             $.ajax({
              type: "post",
              url: "request_process.php?calling=21",
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
      <script>
         function myFunction(bedspace)
         {
          var status=$("#blockunblock"+bedspace).val();
          var datastring="bedspace="+bedspace+"&status="+status;
          $.ajax({
            type: "post",
            url: "request_process.php?calling=41",
            data: datastring,
            success: function(responseData, textStatus, jqXHR) {
              //alert(responseData);exit;
              
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
         if(isset($_REQUEST['rid']))
         {
          if($_REQUEST['rid']=="0bf421521eb70023a3b26e3af381551e")
          {
            $path=SERVER_PATH."properties.php";
            header("Location:$path");
          }
         }
         $roomid=base64_decode($_REQUEST['rid']);
          
        
         $room=$db->GetRoomById($roomid);
         
         // echo "<pre/>";
         // print_r($room);
         ?>
      <!-- /top navigation -->
      <!-- page content -->
      <div class="right_col" role="main">
         <div class="">
            <div class="page-title">
               <div class="title_left">
                  <h3>Edit Rooms</h3>
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
                        <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                        <br />

                  
                        <form action="process/edit_room_process2.php" id="add_room" method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                           <input type="hidden" name="room" id="room" value="<?=$_REQUEST['rid']?>" />
                           <div id="note">
                              <div class="onerow" id="error_div">
                                 <div id="fail" class="info_div" style="display:none;"><span class="ico_cancel">Ups, there was an error</span></div>
                              </div>
                              <div class="onerow">
                                 <div id="success" class="info_div" style="display:none;"><span class="ico_success">Room Updated Successfully!</span></div>
                              </div>
                              <div id="error_div" class="error_div" style="padding-left:10px;"></div>
                           </div>
                           <div class="form-group">
                             
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">
                              <?php
                                 if($room[0]['fld_custom_room_name']=="")
                                 {
                                  echo $room[0]['fld_room_name'];
                                 }
                                 else
                                 {
                                  echo $room[0]['fld_custom_room_name'];
                                 }
                                 ?>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input id="room_name" class="form-control col-md-7 col-xs-12"  type="text" name="room_name" value="<?=$room[0]['fld_custom_room_name']?>">
                              </div>
                           </div>


                         

                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">
                              Type
                              </label>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="type" class="book_as">
                                   <option <?php if($room[0]['total_bedspace'] == 1){ echo 'selected'; } ?> value="Room">Room</option>
                                   <option <?php if($room[0]['total_bedspace'] > 1){ echo 'selected'; } ?> value="Bedspace">Bedspace</option>
                                </select>
                               </div>
                           </div>


                           <div class="form-group" id="no_of_bedspace" id="show_bedspace" style="
                           <?php if($room[0]['total_bedspace'] > 1){ ?>
                             display: block;
                           <?php }else{ ?>
                             display: none;
                            <?php }?>
                           ">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">
                              Select Bedspace 
                              </label>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="no_of_bedspace" class="bedspace_no">

                                  <option <?php if($room[0]['total_bedspace'] == 1){ echo 'selected'; } ?> value="1">1</option>
                                  <option <?php if($room[0]['total_bedspace'] == 2){ echo 'selected'; } ?> value="2">2</option>
                                  <option <?php if($room[0]['total_bedspace'] == 3){ echo 'selected'; } ?> value="3">3</option>
                                  <option <?php if($room[0]['total_bedspace'] == 4){ echo 'selected'; } ?> value="4">4</option>
                                
                                </select>
                               </div>
                           </div>





                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Expected Rent</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">

                                   <input  class="form-control col-md-7 col-xs-12" id="get_room_rent" type="hidden" name="room_rent" value="<?=$room[0]['fld_expected_rent']?>">



                                  <input id="set_room_rent" class="form-control col-md-7 col-xs-12"  type="text" name="" value="<?= number_format((float)$room[0]['fld_expected_rent']/$room[0]['total_bedspace'], 2, '.', '')?>" readonly>

                                  
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Avalability Date</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input type="date" name="avalability_date"  value="<?php echo $room[0]['avalability_date'];?>">
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Balconices</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <select name="balconices" style="height:30px;">
                                    <option value="Y" <?php if ($room[0]['metro_train']== 'Y') echo "selected='selected'";?>>Yes</option>
                                    <option value="N" <?php if ($room[0]['metro_train']== 'N') echo "selected='selected'";?>>No</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Metro/Train</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input id="room_rent" class="form-control col-md-7 col-xs-12"  type="text" name="metro_train" value="<?=$room[0]['metro_train']?>" >
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Occupancy</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input id="room_rent" class="form-control col-md-7 col-xs-12"  type="text" name="occupancy" value="<?=$room[0]['occupancy']?>" >
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <select name="gender" style="height:30px;">
                                    <option value="M" <?php if ($room[0]['gender']== 'M') echo "selected='selected'";?>>Male</option>
                                    <option value="F" <?php if ($room[0]['gender']== 'F') echo "selected='selected'";?>>Female</option>
                                    <option value="B" <?php if ($room[0]['gender']== 'B') echo "selected='selected'";?>>Both</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bath</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <select name="bath" style="height:30px;width:100%;">
                                    <option value="Attached Bath" <?php if ($room[0]['bath']== 'Attached Bath') echo "selected='selected'";?>>Attached Bath</option>
                                    <option value="Shared Bath" <?php if ($room[0]['bath']== 'Shared Bath') echo "selected='selected'";?>>Shared Bath</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Common Room</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <select name="common_room" style="height:30px;width:100%;">
                                    <option value="No Living Room" <?php if ($room[0]['common_room']== 'No Living Room') echo "selected='selected'";?>>No Living Room</option>
                                    <option value="Huge Living Room" <?php if ($room[0]['common_room']== 'Huge Living Room') echo "selected='selected'";?>>Huge Living Room</option>
                                    <option value="Small Living Room" <?php if ($room[0]['common_room']== 'Small Living Room') echo "selected='selected'";?>>Small Living Room</option>
                                 </select>
                                 <!--   <input type="text" name="common_room" value="<?=$room[0]['common_room']?>"> -->
                              </div>
                           </div>
                           <?php //echo "<pre/>"; print_r($room[0]['window']); die;?>
                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Window</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <select name="wins" style="height:30px;width:100%;">
                                    <option value="Y" <?php if ($room[0]['wins']== 'Y') echo "selected='selected'";?>>Yes</option>
                                    <option value="N" <?php if ($room[0]['wins']== 'N') echo "selected='selected'";?>>No</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Notes</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <textarea class="form-control col-md-7 col-xs-12" name="notes" id="notes"><?=$room[0]['fld_notes']?></textarea>
                              </div>
                           </div>
                           <?php for($k=0;$k<count($room);$k++) {

                              if(!empty($room[$k]['image_name']))
                              {
                              $target_path = 'http://roomdaddy.ae/roomdaddy/admin/rooms/ROOM_IMAGES/';
                              
                              ?>
                           <div class="add_image">   
                              <button class="remove_image remove_room_image" data-id="<?php echo $room[$k]['room_pics_id']; ?>" >X</button>      
                              <img id="<?php echo $k; ?>_blah"  data-id="<?php echo $k; ?>" alt=" " width="100" height="100" src="<?php echo $target_path.$room[$k]['image_name'];  ?>"/>
                              <input type="hidden" name="image_id[]" value="<?php echo $room[$k]['room_pics_id']; ?>"/>
                              <input type="file" name="image[]" class="btn"
                                 onchange="
                                 var spge = '<?php echo $k ;?>'; document.getElementById(spge+'_blah').src = window.URL.createObjectURL(this.files[0])" value="<?php echo $room[$k]['image_name'];?>">
                           </div>
                           <?php }
                             }

                            ?>
                           <button class="add_more btn add_more_images_button">Add Room Images</button>
                           <div class="form-group cancel_update_button">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                 <button class="btn btn-primary" type="button">Cancel</button>
                                 <button class="btn btn-primary" type="reset">Reset</button>
                                 <input type="submit" class="btn btn-success" onClick="return;"  name="edit_rooms" value="Submit"/>
                              </div>
                        </form>
                        </div>
                        <script>
                           $(document).ready(function(){
                                  var count=50000;
                            $('.add_more').click(function(e){
                              e.preventDefault();
                           
                                     count++;//count button clicked
                           
                                    console.log('dsfsd',count);
                               
                              $(this).before(`<div class="add_image"><button class="remove_image remove_room_image" data-id="N">X</button><img id="`+count+`_blah" alt="" width='100' height='100'/><input type="hidden" name="image_id[]" value=""/><input type='file' name='image[]' class='btn' onchange='document.getElementById("`+count+`_blah").src = window.URL.createObjectURL(this.files[0])'></div>`);
                            });
                           });
                                         
                        </script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /page content -->
      <!-- footer content -->
      <footer>
         <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
      </div>
      </div>
      <script src="vendors/jquery/dist/jquery.min.js"></script>
      <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="build/js/custom.min.js"></script>
      <script>
     
         
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



          //show no of bedspace

          $(document).on('change', '.book_as', function(e)
          {
           e.preventDefault();

           var selected_value = this.value;
           console.log('here',selected_value);
      
            if(selected_value =="Bedspace")
            {
                $("#no_of_bedspace").css({display: "block"});   
              // $("#show_bedspace").css("display", "block");
            }else{
                  var rent = $('#get_room_rent').val(); 
                  $("#set_room_rent").val(rent);
                $("#no_of_bedspace").css({display: "none"});
            }
         
   
        
          });
          

          $(document).on('change', '.bedspace_no', function(e)
          {
            e.preventDefault();
           //var value = this.value;
             var no_of_bed = $('select.bedspace_no option:selected').val();
             var rent = $('#get_room_rent').val();   
             var total = rent/no_of_bed;
             var total = total.toFixed(2)
             console.log('ssss',total);
             $("#set_room_rent").val(total);
        
          });

          
         
         
         
      </script>
   </body>
</html>