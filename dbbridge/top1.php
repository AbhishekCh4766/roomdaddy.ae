<?php
session_start();  //sub page listing process error=> already created session

include_once("../dbbridge/AdminManager.php");
include_once("../dbbridge/DBManager.php");
include_once("../dbbridge/EmailManager.php");
include_once("../dbbridge/CronManager.php");
include_once("../config/config.php");
include_once("../common/functions.php");

$current_page = basename($_SERVER['PHP_SELF']);
?>