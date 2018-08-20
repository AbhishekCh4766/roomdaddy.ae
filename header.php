
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"> <span>Online Munshi System</span></a>
            </div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                    <?php 
                       
                     $uid = $_SESSION['Enron FZE']['userid'];

                     $GetAdmins=$db->getAdminById($uid);

                     if($GetAdmins[0]['fld_profile_pic']!='') {?>

                      
           <img src="img/profile/<?=$GetAdmins[0]['fld_profile_pic']?>" alt="image" class="img_sidebar" />
                    <?php }  
                            else {

                                ?>

                               <img src="img/profile/profile.png" class="img-responsive" alt="">
                         
                          <?php  } ?>
              </div>
              <div class="profile_info">
                <span>Welcome, </span>
                <h2><?=$_SESSION[ADMIN_SESSION_NAME]['username']?></h2>
              </div>
            </div>
            <br />
      <!-- <?=$_SERVER['PHP_SELF']?> -->
      <?php
      $getRole=$db->GetRoleByUser($_SESSION[ADMIN_SESSION_NAME]['userid']);
      if($getRole[0]!="")
      {
        foreach($getRole as $role)
        {
          if($role['fld_role']=="Data Entry")
          {
            if($_SERVER['PHP_SELF']=="/leasing/admin/add_property.php")
            {
              ?>
              <script language="javascript">
                window.location.href="access_forbidden.php";
              </script>
              <?php
            }
            if($_SERVER['PHP_SELF']=="/leasing/admin/properties.php")
            {
              ?>
              <script language="javascript">
                window.location.href="access_forbidden.php";
              </script>
              <?php
            }
            
          }
        
          
         }
      }
      ?>
           
            <?php
      include "sidebar.php";
      ?>
          
            <div class="sidebar-footer hidden-small">
       
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <?php if($GetAdmins[0]['fld_profile_pic']!='') {?>

                      
           <img src="img/profile/<?=$GetAdmins[0]['fld_profile_pic']?>" alt="image" />
                    <?php }  
                            else {

                                ?>

                               <img src="img/profile/profile.png" class="img-responsive" alt="">
                         
                          <?php  } ?>


                    <?=$_SESSION[ADMIN_SESSION_NAME]['username']?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
          
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <!--<li><a href="javascript:;"> Profile</a></li>-->
                    <li>
                     <!--  <a href="admin_settings.php">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a> -->
                      <?php $uid = $_SESSION['Enron FZE']['userid'];
                                  $am=new AdminManager();
                                  $IfGuest=$am->getAdmin($uid);
                                  if($IfGuest[0]['fld_name'] !='Guest')
                  {

                                   ?>
                      <a href="edit-profile.php">Profile</a>

                    <?php } ?>
                    </li>
                    <!--<li><a href="javascript:;">Help</a></li>-->
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
    
                </li>
              </ul>
            </nav>
          </div>
        </div>