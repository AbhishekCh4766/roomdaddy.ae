<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, Content-Type'); 
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

//$con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_roomdaddy");
	$con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_roomdadd_roomdaddy_new");
	//$con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_leasing1");
	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die('Failed to connect to MySQL');
	}
	return $con;
  
?>