<?php 
@session_start();

include_once('admin/config/config.php');
include_once("admin/dbbridge/DBManager.php");
include_once("admin/dbbridge/CustomerManager.php");

include_once("admin/common/functions.php");
$current_page = basename($_SERVER['PHP_SELF']);

?>