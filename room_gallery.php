<?php
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();
$roomid=base64_decode($_REQUEST['rid']);

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Room Gallery</title>
	<!---Image Popup--->
	
	<!---Image Popup--->
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom styling plus plugins -->
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
                <h3> Room Gallery <small> gallery design</small> </h3>
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
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Media Gallery <small> gallery design </small></h2>
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

                    <div class="row">

                      <p>Media gallery design emelents</p>


                                  <?php
            $getPics = $db->getpropPicByRoomId($roomid);

        
            if($getPics[0]!="")
            {
              foreach($getPics as $pics)
              {      
                ?>
                <div class="col-md-55">
                  <div class="thumbnail">
                    <div class="image view view-first">
                    
                    <img style="width: 100%; display: block;" src="<?=SERVER_PATH?>Documents/PROPERTY_DOC/<?=$pics['propertyImage']?>" alt="image"/>

                    <a href="<?=SERVER_PATH?>Documents/PROPERTY_DOC/<?=$pics['propertyImage']?>"><div class="mask no-caption">
                      <div class="tools tools-bottom">
                     
                      <a href="<?=SERVER_PATH?>Documents/PROPERTY_DOC/<?=$pics['propertyImage']?>"><i class="fa fa-expand"></i></a>
                      <a href="<?=SERVER_PATH?>Documents/PROPERTY_DOC/<?=$pics['propertyImage']?>" download>
                      <i class="fa fa-download"></i></a>
                      <a href="#"><i class="fa fa-times"></i></a>
                      </div>
                    </div>
                    </a>
                    </div>
                    <div class="caption">
                    <p><strong>
                    <?php
                    $BuildingName=$db->GetBuildingByRoomId($roomid);
                    //print_r($BuildingName);
                    echo $BuildingName[0]['bname'];
                    ?>
                    </strong>
                    </p>
                    
                    <p><a href="<?=SERVER_PATH?>Documents/PROPERTY_DOC/<?=$pics['propertyImage']?>"  class="pinploc<?=$pics['fld_id']?>">Room Name</a></p>
                    </div>
                  </div>
                  </div>
                <?php
              }
            }
            ?>


						<?php
						$getPics = $db->getRoomPicByRoomId($roomid);

        
						if($getPics[0]!="")
						{
							foreach($getPics as $pics)
							{      
								?>
								<div class="col-md-55">
									<div class="thumbnail">
									  <div class="image view view-first">
										
                    <img style="width: 100%; display: block;" src="<?=SERVER_PATH?>rooms/ROOM_IMAGES/<?=$pics['fld_name']?>" alt="image"/>
										<img style="width: 100%; display: block;" src="<?=SERVER_PATH?>Documents/PROPERTY_DOC/<?=$pics['propertyImage']?>" alt="image"/>

										<a href="<?=SERVER_PATH?>rooms/ROOM_IMAGES/<?=$pics['fld_name']?>"><div class="mask no-caption">
										  <div class="tools tools-bottom">
										 
											<a href="<?=SERVER_PATH?>rooms/ROOM_IMAGES/<?=$pics['fld_name']?>"><i class="fa fa-expand"></i></a>
											<a href="<?=SERVER_PATH?>rooms/ROOM_IMAGES/<?=$pics['fld_name']?>" download>
											<i class="fa fa-download"></i></a>
											<a href="#"><i class="fa fa-times"></i></a>
										  </div>
										</div>
										</a>
									  </div>
									  <div class="caption">
										<p><strong>
										<?php
										$BuildingName=$db->GetBuildingByRoomId($roomid);
										//print_r($BuildingName);
										echo $BuildingName[0]['bname'];
										?>
										</strong>
										</p>
                    
										<p><a href="<?=SERVER_PATH?>rooms/ROOM_IMAGES/<?=$pics['fld_name']?>"  class="pinploc<?=$pics['fld_id']?>">Room Name</a></p>
									  </div>
									</div>
								  </div>
								<?php
							}
						}
						else
						{
							echo "NO Image found for this Room";
						}
						?>
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

    <!-- jQuery -->

    <!-- Bootstrap -->
	<script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
	<script src="build/js/custom.min.js"></script>
	<!---Color Box------>
	

	
	<!---Color Box------>
  </body>
</html>