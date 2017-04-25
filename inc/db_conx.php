<?php
/*$mysql_db_hostname = "Host name";
$mysql_db_user = "UserName";
$mysql_db_password = "Password";
$mysql_db_database = "Database Name";*/

$mysql_db_hostname = "localhost";
$mysql_db_user = "root";
$mysql_db_password = "";
$mysql_db_database = "obes";

$db_conx = @mysqli_connect($mysql_db_hostname,$mysql_db_user,$mysql_db_password,$mysql_db_database);
if(mysqli_connect_error()) {
	echo mysqli_connect_error();
	exit();
	}
?>