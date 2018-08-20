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
    <title>Add New Property</title>
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
function add_edit_property()
{

	$('#add_property').unbind('submit');
	var options = {
	target: '', 				// target element(s) to be updated with server response
	beforeSubmit: show_add_Request, 	
	success: show_add_Response, 		
	url: 'request_process.php?calling=4' 
	};
	$('#add_property').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
}

function show_add_Request(formData, jqForm, options) 
{
	var queryString = $.param(formData);
	 
	return true;
}

function show_add_Response(responseText, statusText) 
{	
   alert("success");
	if(responseText.search('done') != '-1')
	{
		$("#error_div").hide();	
		myarray = new Array();
		myarray = responseText.split('-');
		
		
		//parent.$('#table_options').show();  // containing three buttons
		
		$('#success').html(myarray[1]);
		$('#success').fadeIn(1000);
		$('#success').fadeIn(1200);
		$('#success').fadeIn(1000);
		
		parent.$.fn.colorbox.close();
		//setTimeout('\''+gotolink()+'\'', 3000);
		return false;
	}
	else
	{
		$("#error_div").html(responseText);
		$("#error_div").show();	
		$('#success').hide();
	}
}
	</script>
  </head>
  <body>
<?php
include("header.php");
if(isset($_REQUEST['bid']))
{
	if($_REQUEST['bid']!="")
	{

		//$_REQUEST['bid'] =14;

		$getBuilingData = $db->getBuildingById(base64_decode($_REQUEST['bid']));
		$area		=	$getBuilingData[0]['fld_area'];
		$building	=	$getBuilingData[0]['fld_building'];
		$contractStart=	$getBuilingData[0]['fld_contract_starting_date'];
		//$starting_year=strtotime($contractStart);
		$contract_start_year=date("Y",strtotime($getBuilingData[0]['fld_contract_starting_date']));
		$contract_start_month=date("m",strtotime($getBuilingData[0]['fld_contract_starting_date']));
		$contract_start_date=date("d",strtotime($getBuilingData[0]['fld_contract_starting_date']));
		$contract_end_year=date("Y",strtotime($getBuilingData[0]['fld_contract_ending_date']));
		$contract_end_month=date("m",strtotime($getBuilingData[0]['fld_contract_ending_date']));
		$contract_end_date=date("d",strtotime($getBuilingData[0]['fld_contract_ending_date']));
		$rent	=	$getBuilingData[0]['fld_rent'];
		$deposit	=	$getBuilingData[0]['fld_deposit'];
		$comission	=	$getBuilingData[0]['fld_comission'];
		$num_of_beds=	$getBuilingData[0]['fld_num_of_beds'];
		$num_of_chqs=	$getBuilingData[0]['fld_num_of_chqs'];
		$apt_num	=	$getBuilingData[0]['fld_apt_no'];
		$dewa_num	=	$getBuilingData[0]['fld_dewa'];
		$du_num		=	$getBuilingData[0]['fld_du'];
		$empower_num=	$getBuilingData[0]['fld_empower'];
		$parking =	$getBuilingData[0]['parking'];
		$button		=	"Update";
		$bid		=	$_REQUEST['bid'];
		if(isset($_REQUEST['pbuid']))
		{
			$purpose	=	$_REQUEST['pbuid'];
		}
		else
		{
			$purpose="NULL";
		}



	}
}
else
{
	$area		=	"";
	$building	=	"";
	$contract_start_year	=	"";
	$contract_start_month	=	"";
	$contract_start_date	=	"";
	$contract_end_year	=	"";
	$contract_end_month	=	"";
	$contract_end_date	=	"";
	$rent	=	"";
	$deposit	=	"";
	$comission	=	"";
	$num_of_beds=	"";
	$num_of_chqs=	"";
	$apt_num	=	"";
	$dewa_num	=	"";
	$du_num		=	"";
	$empower_num=	"";
	$button		=	"Save";
	$bid		=	"NULL";
	$purpose	=	"NULL";
}
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <!-- <div class="title_left">
                <h3>Form Elements</h3>
              </div> -->

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <!-- <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span> -->
                  </div>
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
                    <form id="add_property" method="post" class="form-horizontal form-label-left" action="process/add_edit_property_process.php" enctype="multipart/form-data">
						
						<div id="note">
							<div class="onerow" id="error_div">
								<div id="fail" class="info_div" style="display:none;"><span class="ico_cancel">Ups, there was an error</span></div>
							</div>
							<div class="onerow">	
								<div id="success" class="info_div" style="display:none;"><span class="ico_success">Property Updated Successfully!</span></div>
							</div>	
							<div id="error_div" class="error_div" style="padding-left:10px;"></div> 
						</div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Area <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="hidden" name="bid" id="bid" value="<?=$bid?>" />
						<input type="hidden" id="purpose" name="purpose" value="<?=$purpose?>" />
						<input type="text" id="area" name="area" required="required" class="form-control col-md-7 col-xs-12" value="<?=$area?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Building <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="building" name="building" required="required" class="form-control col-md-7 col-xs-12" value="<?=$building?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="owner">Owner <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <select class="form-control col-md-7 col-xs-12">
							<?php
							$getOwner=$db->getSuperAdmin();
							foreach($getOwner as $owner)
							{
								$id = $owner['fld_id'];
								$name = $owner['fld_name'];
								echo '<option value="'.$id.'">'.$name.'</option>';
							}
							?>
						  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contract Starting Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="start_date" id="start_date">
								<?php
									for($i=1;$i<=31;$i++)
									{
										if($i<10)
										{
											$i="0".$i;
										}
										?>
										<option value="<?=$i?>"
										<?php
										if($contract_start_date==$i)
										{
											echo "Selected";
										}
										?>
										><?=$i?></option>
										<?php
									}
								?>
						  </select>
						  <select name="start_month" id="start_month">
							<option value="01" <?php if($contract_start_month=="01"){echo "Selected";}?>>January</option>
							<option value="02" <?php if($contract_start_month=="02"){echo "Selected";}?>>February</option>
							<option value="03" <?php if($contract_start_month=="03"){echo "Selected";}?>>March</option>
							<option value="04" <?php if($contract_start_month=="04"){echo "Selected";}?>>April</option>
							<option value="05" <?php if($contract_start_month=="05"){echo "Selected";}?>>May</option>
							<option value="06" <?php if($contract_start_month=="06"){echo "Selected";}?>>June</option>
							<option value="07" <?php if($contract_start_month=="07"){echo "Selected";}?>>July</option>
							<option value="08" <?php if($contract_start_month=="08"){echo "Selected";}?>>August</option>
							<option value="09" <?php if($contract_start_month=="09"){echo "Selected";}?>>September</option>
							<option value="10" <?php if($contract_start_month=="10"){echo "Selected";}?>>October</option>
							<option value="11" <?php if($contract_start_month=="11"){echo "Selected";}?>>November</option>
							<option value="12" <?php if($contract_start_month=="12"){echo "Selected";}?>>December</option>
						  </select>
						  <select name="start_year" id="start_year">
							<?php
								for($i=2015;$i<=gmdate("Y")+3;$i++)
								{
									?>
									<option value="<?=$i?>"
									<?php
										if($contract_start_year==$i)
										{
											echo "Selected";
										}
										?>
									><?=$i?></option>
									<?php
								}
							?>
						  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contract Ending Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="end_date" id="end_date">
								<?php
									for($i=1;$i<=31;$i++)
									{
										if($i<10)
										{
											$i="0".$i;
										}
										?>
										<option value="<?=$i?>"
										<?php
										if($contract_end_date==$i)
										{
											echo "Selected";
										}
										?>
										><?=$i?></option>
										<?php
									}
								?>
						  </select>
						  <select name="end_month" id="end_month">
							<option value="01" <?php if($contract_end_month=="01"){echo "Selected";}?>>January</option>
							<option value="02" <?php if($contract_end_month=="02"){echo "Selected";}?>>February</option>
							<option value="03" <?php if($contract_end_month=="03"){echo "Selected";}?>>March</option>
							<option value="04" <?php if($contract_end_month=="04"){echo "Selected";}?>>April</option>
							<option value="05" <?php if($contract_end_month=="05"){echo "Selected";}?>>May</option>
							<option value="06" <?php if($contract_end_month=="06"){echo "Selected";}?>>June</option>
							<option value="07" <?php if($contract_end_month=="07"){echo "Selected";}?>>July</option>
							<option value="08" <?php if($contract_end_month=="08"){echo "Selected";}?>>August</option>
							<option value="09" <?php if($contract_end_month=="09"){echo "Selected";}?>>September</option>
							<option value="10" <?php if($contract_end_month=="10"){echo "Selected";}?>>October</option>
							<option value="11" <?php if($contract_end_month=="11"){echo "Selected";}?>>November</option>
							<option value="12" <?php if($contract_end_month=="12"){echo "Selected";}?>>December</option>
						  </select>
						  <select name="end_year" id="end_year">
							<?php
								for($i=2015;$i<=date("Y")+3;$i++)
								{
									
									?>
									<option value="<?=$i?>"
									<?php
										if($contract_end_year==$i)
										{
											echo "Selected";
										}
										?>
									><?=$i?></option>
									<?php
								}
							?>
						  </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Rent <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="rent" name="rent" required="required" class="form-control col-md-7 col-xs-12" value="<?=$rent?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Deposit <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="deposit" name="deposit" required="required" class="form-control col-md-7 col-xs-12" value="<?=$deposit?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Comission <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="comission" name="comission" required="required" class="form-control col-md-7 col-xs-12" value="<?=$comission?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Num of Rooms</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="num_of_beds" class="form-control col-md-7 col-xs-12" required="required" type="text" name="num_of_beds"
							<?php
							if($num_of_beds!="")
							{
								echo "disabled";
							}
							?>
						  value="<?=$num_of_beds?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Num of Cheques</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="num_of_chqs" class="form-control col-md-7 col-xs-12" required="required" type="text" name="num_of_chqs" value="<?=$num_of_chqs?>">
                        </div>
                      </div>
					  <!--
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">File</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="asdf" class="form-control col-md-7 col-xs-12" required="required" type="file" name="asdf">
                        </div>
                      </div>-->
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Appartment Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="apt_num" name="apt_num" required="required" class="form-control col-md-7 col-xs-12" type="text" value="<?=$apt_num?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dewa Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="dewa_num" name="dewa_num" class="form-control col-md-7 col-xs-12" type="text" value="<?=$dewa_num?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Du Number 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="du_num" name="du_num" class="form-control col-md-7 col-xs-12" type="text" value="<?=$du_num?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Empower Number 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="empower_num" name="empower_num" class="form-control col-md-7 col-xs-12" type="text" value="<?=$empower_num?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Parking
                        </label>


                        <div class="col-md-6 col-sm-6 col-xs-12">


                          <select name="parking" style="height:30px;">
                            <option value="Y" <?php if ($parking == 'Y') echo "selected='selected'";?>>Yes</option>
                            <option value="N" <?php if ($parking == 'N') echo "selected='selected'";?>>No</option>
                          </select> 


                          <!-- <input id="empower_num" name="parking" class="form-control col-md-7 col-xs-12" type="text" value="<?=$empower_num?>"> -->
                        </div>
                      </div>



						<?php for($k=0;$k<count($getBuilingData);$k++){ 
						
                          $target_path = 'http://roomdaddy.ae/roomdaddy/admin/Documents/PROPERTY_DOC/';
                         if(!empty($getBuilingData[$k]['image_name']))
                         {
                          ?>
            <div class="add_image">   
              <button class="remove_image remove_property_image" data-id="<?php echo $getBuilingData[$k]['tbl_property_documents_id']; ?>" >X</button>      
              <img id="<?php echo $k; ?>_blah"  data-id="<?php echo $k; ?>" alt=" " width="100" height="100" src="<?php echo $target_path.$getBuilingData[$k]['image_name'];  ?>"/>
            
              <input type="hidden" name="image_id[]" value="<?php echo $getBuilingData[$k]['tbl_property_documents_id']; ?>"/>
              <input type="file" name="image[]" class="btn"
              onchange="
              var spge = '<?php echo $k ;?>'; document.getElementById(spge+'_blah').src = window.URL.createObjectURL(this.files[0])" value="<?php echo $getBuilingData[$k]['image_name'];?>">
            </div>  

						<?php 
                      }
					}
						//print_r($getBuilingData[0]['image_name']);
						//die;
						?>

					<!-- <input type="text" name="file_name[]" />
					  <input name="image[]" type="file" class="btn"/> -->
                    <!--  <div class="add_image">
	                      <img id="blah" alt=" " width='100' height='100'/>
                            <button class="remove_image remove_property_image" data-id="<?php //echo $room[$k]['room_pics_id']; ?>" >X</button>  
						  <input type="file" name="image[]"" class='btn' onchange='document.getElementById("blah").src = window.URL.createObjectURL(this.files[0])'>
						</div> -->

						<button class="add_more btn add_more_images_button">Add Images</button>
						  <div class="ln_solid"></div>
                     <div class="form-group cancel_update_button">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancel</button>
						  <input type="submit" class="btn btn-success" name="add_edit_property" value="<?=$button?>"/>
                        </div>
                      </div>
                    </form>
                  </div>
				   <script>
					 $(document).ready(function(){
					 	var count=50000;
							$('.add_more').click(function(e){
								e.preventDefault();
								count++;
								$(this).before(`<div class="add_image"><button class="remove_image remove_property_image" data-id="N">X</button><img id="`+count+`_blah" alt="" width='100' height='100'/><input type='file' name='image[]' class='btn' onchange='document.getElementById("`+count+`_blah").src = window.URL.createObjectURL(this.files[0])'></div>`);
								//$(this).before("<input type='text' name='file_name[]' /><input name='image[]' type='file'  class='btn'/>");
							});
						});
                    </script>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
         <!--    Website by Abhishek Choudhary -->
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
    
     <script type="text/javascript">
     	
           //Remove Image..

   $(document).on('click', '.remove_property_image', function(e)
   {
    e.preventDefault();
    //alert('ghjhdfdf');
    var image_id = $(this).attr("data-id");
    //alert(image_id);

    if(image_id !='N')
    {
      $.ajax({
        type: "post",
        url: "request_process.php?calling=49",
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