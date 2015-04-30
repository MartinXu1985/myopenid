<?php

$conn = @mysql_connect("localhost","martin_admin","xu850913");
if (!$conn){
	die("connection fail" . mysql_error());
}
mysql_select_db("martin_oauth2", $conn);

//mysql_query("set character set 'utf-8'");

//mysql_query("set names 'utf-8'");
//echo 'success';

?>