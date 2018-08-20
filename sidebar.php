<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
            <!--     <h3>General</h3> -->
                <ul class="nav side-menu">
				<?php
				$uid = $_SESSION['Enron FZE']['userid'];
			  		$arr = array();
			  		$am=new AdminManager();
			  		$IfGuest=$am->getAdmin($uid);
                   
                  if($IfGuest[0]['fld_name'] !='Guest')
                  {

                  
					$GetUserRoles=$am->getalluserroles();
					foreach($GetUserRoles as $admins)
					{
						$arr[] = $admins['fld_role'];
					}

					
				?>
                     <?php  if(in_array('5',$arr) || in_array('8',$arr)){  ?>

                  <li>
					<a><i class="fa fa-home"></i> Properties <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    	 <?php  if(in_array('1',$arr) || in_array('8',$arr)){ ?>
                      <li><a href="add_property.php">Add Property</a></li>
                        <?php }?>
					  <li><a href="properties.php">Properties</a></li>
					  <li><a href="documents.php">Documents</a></li>
                    </ul>
                  </li>
                     <?php }
                          

                          if(in_array('5',$arr) || in_array('8',$arr)){ 
                      ?>
                       

                     <li>
					<a><i class="fa fa-money"></i> Accounts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    	 
					  
                      <li><a href="expense_type.php">Account Type</a></li>
					
                      <li><a href="expense.php">Account</a></li>
                      
                      <li><a href="cheques_details.php">Cheques Details</a></li>
                    </ul>
                  </li>
                
                <?php } ?>
				  
			  	
                  <li>
					<a><i class="fa fa-usd"></i> Income <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php
					  
						$am=new AdminManager();
						$Getadmins=$am->getAdminInformation();
						foreach($Getadmins as $admins)
						{

					    if(in_array('1',$arr) || in_array('8',$arr)){
			            	
							?>
							<li><a href="rent_collection.php?id=<?=base64_encode($admins['fld_id'])?>"><?=$admins['fld_name']?></a></li>
							<?php
						                      }
						elseif ($admins['fld_id'] == $uid) 
						{  ?>
						   <li><a href="rent_collection.php?id=<?=base64_encode($admins['fld_id'])?>"><?=$admins['fld_name']?></a></li> 
						   <?php                  
						}                      
						}
					  
					  ?>
                    </ul>
                  </li>
				
				  
                  <li>
					<a><i class="fa fa-bar-chart"></i> Summary <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php
						$am=new AdminManager();
						$Getadmins=$am->getAdminInformation();
						foreach($Getadmins as $admins)
						{


                        if(in_array('1',$arr) || in_array('8',$arr)){
			            	
							?>
							<li><a href="new.php?id=<?=base64_encode($admins['fld_id'])?>"><?=$admins['fld_name']?></a></li>
							<?php
						                      }
						elseif ($admins['fld_id'] == $uid) 
						{  ?>
						   <li><a href="new.php?id=<?=base64_encode($admins['fld_id'])?>"><?=$admins['fld_name']?></a></li> 
						   <?php                  
						}    
						}
					  ?>
							<li><a href="transactions.php">All Transactions</a></li>
							<li><a href="expense_summary.php">All Expenses</a></li>
                    </ul>
                  </li>
				    <?php  if(in_array('3',$arr) || in_array('8',$arr)){  ?>
				  
				  <li>
					<a><i class="fa fa-book"></i> Reports <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<li><a href="get_report.php">Generate Report</a></li>
					
                    </ul>
				  </li>
                       <?php  }  ?>

				   <li>
					<a><i class="fa fa-exclamation-triangle"></i> Complaint <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
					
						<?php  if(in_array('3',$arr) || in_array('8',$arr)){  ?>
						<li><a href="get_complaints.php">Complain</a></li>
						 <? } ?>
						<li><a href="complaints_assigned.php">Complains Assigned</a></li>

						<?php if(in_array('8',$arr)){
							?>
						<li><a href="complaints-status.php">Complains Status</a></li>

					<?php } else {
						?>
						<li><a href="complaints_closed.php">Complains Closed</a></li>
                       <?php
					    }
						?>
                    </ul>
				  </li>
				  
				  	<?php
					foreach($GetUserRoles as $admins)
					{
						$arr[] = $admins['fld_role'];
					}


					if(in_array('10',$arr) || in_array('8',$arr) || in_array('6',$arr)){
                   ?>

				 
				  <li>
					<a><i class="fa fa-users"></i> Users<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="add_user.php">Add User</a></li>
						<?php if(in_array('10',$arr) || in_array('8',$arr)) { ?>
						<li><a href="add_beneficiary.php">Add beneficiary</a></li>
						<li><a href="get-all-admin.php">Admins List</a></li>
					    <?php } ?>
                    </ul>
                  </li>
				 
				 		<?php } ?>


				 		  	<?php
					foreach($GetUserRoles as $admins)
					{
						$arr[] = $admins['fld_role'];
					}


					if(in_array('10',$arr) || in_array('8',$arr) || in_array('6',$arr)){
                   ?>

				 
				  <li>
					<a><i class="fa fa-users"></i> Client<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="client-docs.php">Client List</a></li>
						
                    </ul>
                  </li>
				 
				 		<?php } ?>
				  
			  	<?php
					foreach($GetUserRoles as $admins)
					{
						$arr[] = $admins['fld_role'];
					}


					if(in_array('2',$arr) || in_array('8',$arr)){
                   ?>

				  <li>
					<a><i class="fa fa-check"></i> My Approvals   <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="expense_approval.php">Expense Approvals</a></li>
						<li><a href="notice_app.php">Notice Approvals </a></li>
						<!-- <li><a href="payment-approval.php">Payment Approval</a></li> -->
						<li><a href="rent-approval.php">Rent Approval</a></li>
						<li><a href="app-client.php">Tenants Appoval</a></li>
						<li><a href="app-booked-room.php">Approve Booking </a></li>
						<li><a href="pending_approval.php">Approve Building</a></li>
                    </ul>
                  </li>
						
						
						<?php
					}
			  	?>


			  	 	<!-- <?php
					foreach($GetUserRoles as $admins)
					{
						$arr[] = $admins['fld_role'];
					}


					if(in_array('7',$arr) || in_array('8',$arr)){
                   ?>

				  <li>
					<a><i class="fa fa-check"></i> Building Approvals  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					<li><a href="pending_approval.php">Approve Building</a></li>	
					
                    </ul>
                  </li>
						
						
						<?php
					}
			  	?> -->
				  	<?php
					foreach($GetUserRoles as $admins)
					{
						$arr[] = $admins['fld_role'];
					}


					if(in_array('8',$arr) || in_array('4',$arr)){
                   ?>
                    <li>
					<a><i class="fa fa-bed"></i>Room<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="index.php">Book Room</a></li>
						<li><a href="room_list.php">Edit Rooms </a></li>
						
                    </ul>
                  </li>
				  		<?php
					}


					if(in_array('8',$arr) || in_array('1',$arr)){
			  	?>
			  	 <li>
					<a><i class="fa fa-thumbs-down"></i> Disapproved Expenses <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="disapproved_expenses.php">Disapproved Expenses </a></li>					
                    </ul>
                  </li>

              <?php  }  ?>
               <li>
					<a><i class="fa fa-hourglass"></i> Change Password <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="change-password.php">Change Password </a></li>					
                    </ul>
                  </li>

              <?php } ?>
                 <!--  <li>
					<a><i class="fa fa-usd"></i> Rent <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="add_client.php">Add Tanent</a></li>
                      <li><a href="clients.php">Tanents Listing</a></li>
                    </ul>
                  </li> -->
                </ul>
              </div>
            </div>