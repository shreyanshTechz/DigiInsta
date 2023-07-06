<?php
/*
This file contains database configuration assuming you are running mysql using user "root" and password ""
*/
// echo "tyhtyhjytjty";
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id17209995_userinp');
define('DB_PASSWORD', 'H2RJmDcSF&Y%H$_c');
define('DB_NAME', 'id17209995_user');
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection 
if($conn === false){
die("ERROR: Could not connect. " . mysqli_connect_error());
}?>
