<?php 
	//die('sddsds');
	include_once("dbbridge/top.php");
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '1')
	{
		include("process/login_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '2')
	{
		include("process/forgot_password_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '3')
	{
		include("process/admin_setting_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '4')
	{
		include("process/add_edit_property_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '5')
	{

		include("process/property_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '6')
	{
		include("process/add_edit_client_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '7')
	{
		include("process/room_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '8')
	{
		include("process/add_notice_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '9')
	{
		include("process/add_rent_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '10')
	{
		include("process/recieved_summary_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '11')
	{
		include("process/recievable_summary_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '12')
	{
		include("process/add_expense_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '13')
	{
		include("process/add_dewa_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '14')
	{
		include("process/check_rent_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '15')
	{
		include("process/balance_calcuate_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '16')
	{
		include("process/add_du_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '17')
	{
		include("process/add_empower_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '18')
	{
		include("process/expense_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '19')
	{
		include("process/add_edit_chq_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '20')
	{
		include("process/add_edit_room_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '21')
	{
		include("process/edit_room_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '22')
	{
		include("process/building_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '23')
	{
		include("process/edit_chq_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '24')
	{
		include("process/overall_expense_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '25')
	{
		include("process/delete_expense_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '26')
	{
		include("process/pay_deposit_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '27')
	{
		include("process/refund_deposit_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '28')
	{
		include("process/move_out_tanent.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '29')
	{
		include("process/deposit_in_summary_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '30')
	{
		include("process/deposit_out_summary_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '31')
	{
		include("process/add_edit_partner_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '32')
	{
		include("process/chqs_calender_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '33')
	{
		include("process/chqs_details_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '34')
	{
		include("process/add_transaction_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '35')
	{
		include("process/transaction_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '36')
	{
		include("process/generate_report_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '37')
	{
		include("process/expense_type_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '38')
	{
		include("process/add_expense_type_listing_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '39')
	{
		include("process/delete_expense_type_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '40')
	{
		include("process/generate_recovery_status.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '41')
	{
		include("process/blockunblockrooms.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '42')
	{
		include("process/get_thread_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '43')
	{
		include("process/add_user_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '44')
	{
		include("process/tanent_request_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '45')
	{
		include("process/add_comment_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '46')
	{
		include("process/payment_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '47')
	{
		include("process/edit_expense_process.php");
	}

	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '48')
	{
	  include("process/delete_room_image.php");
	}

	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '49')
	{
	  include("process/delete_property_image.php");
	}


?>