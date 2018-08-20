<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();
$buildingidd="";
$room="";
if(isset($_REQUEST['building']) && $_REQUEST['building']!="")
{
	$buildingidd=base64_decode($_REQUEST['building']);
}
if(isset($_REQUEST['room']) && $_REQUEST['room']!="")
{
	$room=base64_decode($_REQUEST['room']);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>
	<?php
	if(!isset($_REQUEST['tanent']))
	{
		echo "Add New Tenant";
	}
	else
	{	
		$tanentid=base64_decode($_REQUEST['tanent']);
		$getTanentInfo=$db->getTanentById($tanentid);
		$name=$getTanentInfo[0]['fld_name'];
		echo $name;
	}
	?>
	</title>
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
	function add_edit_client()
	{  
	   var datastring=$("#add_client").serialize();

	   console.log('sss',datastring);
	   $.ajax({
			type: "post",
			url: "request_process.php?calling=6",
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
			error: function(jqXHR, textStatus, errorThrown) 
			{
				console.log(errorThrown);
			}
		})
	   header("Location:index.php");
	}
	</script>
<script>
	function getroom(bid)
	{
		//alert(bid);exit;
		 $.ajax({
			   type: "POST",
			   url: 'request_process.php?calling=7',
			   data: "buildingid="+bid,
			   beforeSend: function(){
			   },
			   success: function(msg)
			   {
					$("#selectroom").html(msg);
				},
				error: function(){
					alert('error');
				}
			 });
	}
	</script>
	</head>
 <?php
include("header.php");
?>
      <?php
		if(isset($_REQUEST['tanent']))
		{
			if($_REQUEST['tanent'])
			{
				$tanentid=base64_decode($_REQUEST['tanent']);
				$getTanentInfo=$db->getTanentById($tanentid);
				$name=$getTanentInfo[0]['fld_name'];
				$email=$getTanentInfo[0]['fld_email'];
				$number=$getTanentInfo[0]['fld_number'];
				$nationality=$getTanentInfo[0]['fld_nationality'];
				$deposit=$getTanentInfo[0]['fld_deposit'];
				$rent=$getTanentInfo[0]['fld_rent'];
				$move_in_year=date("Y",strtotime($getTanentInfo[0]['fld_move_in_date']));
				$move_in_month=date("m",strtotime($getTanentInfo[0]['fld_move_in_date']));
				$move_in_date=date("d",strtotime($getTanentInfo[0]['fld_move_in_date']));
				$bedspace=getTanentInfo[0]['fld_bedspace_id'];
				$button="Update";
			}
		}
		else
		{
			
			$name="";
			$email="";
			$number="";
			$nationality="";
			$deposit="";
			$rent="";
			$move_in_month=date("m");
			$move_in_date=date("d");
			$move_in_year=date("Y");
			$tanentid=0;
			$button="Save";
		}
	  ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Register New Tenant</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
					<?php

					$url = base64_decode($_REQUEST['bedspace']);


					$roomdetails=$db->GetBuildingAndRoomByBedspace(base64_decode($_REQUEST['bedspace']));
					$getBedspaceIndex=$db->GetBedspacebyRoom($roomdetails[0]['room_id']);
     //                echo "<pre/>";
					// print_r($getBedspaceIndex);

					// echo base64_decode($_REQUEST['bedspace']);
					// die;
					if($getBedspaceIndex[0]!="")
					{
						$i=0;
						foreach($getBedspaceIndex as $indexs)
						{
							$i=$i+1;
							if($indexs['fld_id']==$roomdetails[0]['bedspace_id'])
							{
								
								break;
							}
							else
							{
								continue;
							}
							
						}
					}
					
					//print_r($getBedspaceIndex);
					echo $roomdetails[0]['building_name']." ".$roomdetails[0]['apt']." => ".$roomdetails[0]['room_name']." => Bedspace ".$i;
					?>
					</h2>
			
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="add_client" method="post" class="form-horizontal form-label-left">
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
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tenent Phone Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="number" name="number" required="required" value="<?=$number?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Move in Date <span class="required">*</span>
                        </label>
				        <input type="date" name="date">
				        <input type="hidden" name="buildingid" value="<?php echo $getBedspaceIndex[0]['fld_building_id']; ?>">
				        <input type="hidden" name="RoomId" value="<?php echo $getBedspaceIndex[0]['fld_room']; ?>">
				        <input type="hidden" name="bedspace_id" value="<?php echo $url ?>">
				     

					  </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Deposit<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="deposit" class="form-control col-md-7 col-xs-12" required="required" type="text" name="deposit" value="<?=$deposit?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Number of Occupants<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="number_of_occupants" class="form-control col-md-7 col-xs-12" required="required" type="text" name="number_of_occupants" value="<?=$deposit?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Minimum Stay<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="minimum_stay" class="form-control col-md-7 col-xs-12" required="required" type="text" name="minimum_stay" value="<?=$deposit?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Payment Due Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="payment_due_date" class="form-control col-md-7 col-xs-12" required="required" type="text" name="payment_due_date" value="<?=$deposit?>">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Rent <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="rent" name="rent" required="required" value="<?=$rent?>" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Commission <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="commission" name="commission" required="required" value="<?=$rent?>" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
                      </form>  
					  <div class="ln_solid"></div>
					    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancel</button>
						  <button class="btn btn-primary" type="reset">Reset</button>
							<button type="submit" class="btn btn-success" onClick="return add_edit_client();"  name="add_edit_client"/>
								<?=$button?>
							</button>
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
   <script>
</script>
   
  </body>
</html>
