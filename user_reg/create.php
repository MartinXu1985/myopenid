<?php
if(!empty($_POST)){
$username = $_POST['username'];
$client_id = $_POST['client_id'];
$client_secret = $_POST['client_secret'];
$redirect_uri = $_POST['redirect_uri'];
if(!preg_match('/^[A-Za-z0-9]+$/', $client_id)){
    exit('<title>MyOP</title>error: illegal client_id, only accept characters and numbers.<a href="javascript:history.back(-1);">back</a>');
}
if(!preg_match('/^[A-Za-z0-9]+$/', $client_secret)){
    exit('<title>MyOP</title>error: illegal client_secret, only accept characters and numbers.<a href="javascript:history.back(-1);">back</a>');
}
include('conn.php');
$sql = "INSERT INTO oauth_clients(client_id,client_secret,redirect_uri,user_id)VALUES('$client_id','$client_secret','$redirect_uri','$username')";
	if(mysql_query($sql,$conn)){
	     header("Location:my.php?Message=2");
	} else {
	    echo '<title>MyOP</title>';
	    echo 'sorry! data lost：',mysql_error(),'<br />';
	    echo 'Click Here <a href="javascript:history.back(-1);">back</a> try again!';
	}
}	

echo  'fail';
?>