<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id17209995_userinp');
define('DB_PASSWORD', 'H2RJmDcSF&Y%H$_c');
define('DB_NAME', 'id17209995_user');
session_start();
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$user = $_SESSION['username'];
$db->query("update users set active=0 where name='$user'");
require_once "config.php";

session_start();
$_SESSION = array();
session_destroy();
header("location: login.php");

?>
