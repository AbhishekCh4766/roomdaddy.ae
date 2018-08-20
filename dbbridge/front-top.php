<?php
session_start();  //sub page listing process error=> already created session

include_once("admin/dbbridge/AdminManager.php");
include_once("admin/dbbridge/DBManager.php");
include_once("admin/dbbridge/EmailManager.php");
include_once("admin/config/config.php");
include_once("admin/common/functions.php");

$current_page = basename($_SERVER['PHP_SELF']);
?>