<div  id="header">

	<div id="profile_info">
		<img src="img/avatar.jpg" id="avatar" alt="avatar" >
		<p>Welcome <strong><?php echo $_SESSION[ADMIN_SESSION_NAME]['username'];?></strong>. <a href="logout.php">Log out?</a></p>
		<p class="last_login">Last login: <?php echo date("h:i m.d.Y",$_SESSION[ADMIN_SESSION_NAME]['last_login']);?></p>
              
	</div>
	<div id="logo">
        <h1>
            <a href="<?php echo SERVER_PATH_ADMIN;?>" style="width:615px;">
                <img src="img/logo.png" width="200" height="66">
            </a>
       </h1>
   </div>	
</div>