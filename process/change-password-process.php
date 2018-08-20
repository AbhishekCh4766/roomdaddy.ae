<?php
include "../dbbridge/top1.php";
$db = new DBManager();
//$tanent_id  = $_SESSION[ADMIN_SESSION_NAME]['tanentid'];
 $error_msg = " ";
$id=$uid = $_SESSION['Enron FZE']['userid'];

$Admin=$db->getAdminById($id);

$AdminPass = $Admin['0']['fld_password'];

// print_r($AdminPass);
// $pass  =  ifish_encryptPassword($password);
// print_r($pass);
// die;



$old_pass =$_REQUEST['old_pass'];
$password =$_REQUEST['password']; 
$confirm_password =$_REQUEST['confirm_password']; 




     if(ifish_validatePassword($old_pass,$AdminPass))
     {
      if($old_pass==$password)
      {
      	echo "<div>Oops! Looks Like New Password And Old Password is same!!! Please enter a Different Password!!! </div>";
      	echo "<p> Sorry! Your Password Could't be changed </p>";

          // $error_msg .= '<div style="padding-left:38%;padding-top: 50px;"><span><a href="'.$back_link.'" style="text-decoration:none;"><span>Invalid image, image must be: .png,.jpg<br>Click to try Again</span></a></span>
          //         </div>';

                // $path=SERVER_PATH."change-password.php";
                // header("Location:$path");
      	
      }
        else{
           $pass  =	ifish_encryptPassword($password);

                $flag = $db->changePassword(
  	                       	    SG_Validate_Input($_REQUEST['id'],INPUT_TYPE_TEXT),
								SG_Validate_Input($pass,INPUT_TYPE_TEXT)
                             );

                echo "<div> Password Changed Successfully <div>";
             }
         
      }else{  echo " Current Password is wrong! Please Enter Valid Password!"; exit;}


               // $path=SERVER_PATH."index.php";
               //  header("Location:$path");
        ?>
        

