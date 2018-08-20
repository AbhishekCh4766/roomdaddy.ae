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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cname" name="cname" required="required" value="<?=$name?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" name="email" required="required" value="<?=$email?>" class="form-control col-md-7 col-xs-12">
						  <input type="hidden" name="tanentid" value="<?=$tanentid?>" id="tanentid" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="number" name="number" required="required" value="<?=$number?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nationality <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nationality" name="nationality" value="<?=$nationality?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Move in Date <span class="required">*</span>
                        </label>
						<div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="move_in_date" id="move_in_date">
							<?php
							for($i=1;$i<=31;$i++)
							{
								if($i<=9)
								{
									$i="0".$i;
								}
								?>
								<option value="<?=$i?>"
								<?php
								if($move_in_date==$i)
								{
									echo "Selected";
								}
								?>
								><?=$i?></option>
								<?php
							}
							?>
						  </select>
                          <select name="move_in_month" id="move_in_month">
							<option value="01" <?php if($move_in_month=="01"){echo "Selected";}?>>January</option>
							<option value="02" <?php if($move_in_month=="02"){echo "Selected";}?>>February</option>
							<option value="03" <?php if($move_in_month=="03"){echo "Selected";}?>>March</option>
							<option value="04" <?php if($move_in_month=="04"){echo "Selected";}?>>April</option>
							<option value="05" <?php if($move_in_month=="05"){echo "Selected";}?>>May</option>
							<option value="06" <?php if($move_in_month=="06"){echo "Selected";}?>>June</option>
							<option value="07" <?php if($move_in_month=="07"){echo "Selected";}?>>July</option>
							<option value="08" <?php if($move_in_month=="08"){echo "Selected";}?>>August</option>
							<option value="09" <?php if($move_in_month=="09"){echo "Selected";}?>>September</option>
							<option value="10" <?php if($move_in_month=="10"){echo "Selected";}?>>October</option>
							<option value="11" <?php if($move_in_month=="11"){echo "Selected";}?>>November</option>
							<option value="12" <?php if($move_in_month=="12"){echo "Selected";}?>>December</option>
						  </select>
                          <select name="move_in_year" id="move_in_year">
							<?php
								for($i=2015;$i<=date("Y")+3;$i++)
								{
									?>
									<option value="<?=$i?>"
									<?php
									if($move_in_year==$i)
									{
										echo "Selected";
									}
									?> ><?=$i?></option>
									<?php
								}
							?>
						  </select>
                        </div>
					  </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Deposit</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="deposit" class="form-control col-md-7 col-xs-12" required="required" type="text" name="deposit" value="<?=$deposit?>">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Deposit Paid</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="deposit" class="form-control col-md-7 col-xs-12" required="required" type="text" name="deposit" value="<?=$deposit?>">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Rent Paid<span class="required">*</span>
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
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Commission Paid<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="commission" name="commission" required="required" value="<?=$rent?>" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Appartment <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!--<input id="rent" name="rent" required="required" class="form-control col-md-7 col-xs-12" type="text">-->
							<select name="appartment" id="appartment" aria-controls="datatable" class="form-control col-md-7 col-xs-12"
								<?php
								if($buildingidd!="")
								{
									echo "Disabled";
								}
								?>

							onchange="getroom(this.value);">
							<option value="">Select Appartment</option>
							<?php
								$getBuilding=$db->getAllBuildings($_SESSION[ADMIN_SESSION_NAME]['userid']);
								foreach($getBuilding as $building)
								{
									?>
									<option value="<?=$building['fld_id']?>" 
										<?php
										if($buildingidd!="")
										{
											if($buildingidd==$building['fld_id'])
											{
												echo "Selected";
											}
										}
										?>
									>
										<?=$building['fld_building']?> <?=$building['fld_apt_no']?>
									</option>
									<?php
								}
							?>
							</select> 
						  
                        </div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Room <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<select name="selectroom" aria-controls="datatable"  id="selectroom" class="form-control col-md-7 col-xs-12">
							<option value="">Select Room</option>
							<?php
							if($room!="")
							{
								$roomid = $db->getRoomsById($room)
								?>
								<option value="<?=$roomid[0]['fld_id']?>" Selected ><?=$roomid[0]['fld_room_name']?></option>
								<?php
							}
							?>
							</select>
                        </div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Bedspace <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<select name="bedspace_id" aria-controls="datatable"  id="bedspace_id" class="form-control col-md-7 col-xs-12" value="<?=base64_decode($_REQUEST['bedspace'])?>">
								<option><?=$roomid[0]['fld_room_name']?> Bedspace Number 
								<?php
								$getBedspaceid=base64_decode($_REQUEST['bedspace']);
								echo ($getBedspaceid%2)+1;
								?>
								</option>
							</select>
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
            Website By Saqib Ali
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    
    
    
    
    <!--<script src="vendors/nprogress/nprogress.js"></script>
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
    
	
	
	<script src="vendors/fastclick/lib/fastclick.js"></script>
    <script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <script src="vendors/starrr/dist/starrr.js"></script>-->
   
	<!--<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>-->
	
	<script type="text/javascript" src="js/jquery.form.js"></script>
	
	
	
	<script src="vendors/jquery/dist/jquery.min.js"></script>

	<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
   <script src="build/js/custom.min.js"></script>
   <script>
</script>
   
  </body>
</html>
