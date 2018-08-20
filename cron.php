#!/usr/bin/php
<?php
include_once("dbbridge/top.php");
//include_once("common/security.php");
$cm=new CronManager();
// $em=new EmailManager();
// $Email=$em->sendEmail("msaqibali74@gmail.com","msaqibali74@gmail.com","Subject","Hello Cron EMail Testing");
?>

<!------------------>
<?php
// $current_date=date("d");
// if($current_date=="1" || $current_date==1)
// {
	// //Cron Task will be done here
	// $getRooms=$cm->GetAllRoomsForCron();
	// if($getRooms[0]!="")
	// {
		// foreach($getRooms as $rooms)
		// {
			// if($rooms['fld_is_notice']==1 || $rooms['fld_is_notice']=="1")
			// {
				// $changestatus=$cm->updateVacantRoom($rooms['fld_id']);
			// }
			// if($rooms['fld_is_rented']==2 || $rooms['fld_is_rented']=="2")
			// {
				// $changestatus=$cm->updateRentedRoom($rooms['fld_id']);
			// }
		// }
	// }
// }
?>