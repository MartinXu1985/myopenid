<?php
session_start();

if(!isset($_POST['submit'])){
    header("Location:my.php");
}
$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
//check information
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
    exit('<title>MyOP</title>error: illegal username.<a href="javascript:history.back(-1);">back</a>');
}
if(strlen($password) < 6){
    exit('<title>MyOP</title>error: illegal password.<a href="javascript:history.back(-1);">back</a>');
}
//check email, not work!!!!
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    exit('<title>MyOP</title>error: illegal email.<a href="javascript:history.back(-1);">back</a>');
}

include('conn.php');
//check username exist
$check_query = mysql_query("select * from oauth_users where username='$username' limit 1");
if(mysql_fetch_array($check_query)){
    echo '<title>MyOP</title>';
    echo 'error, username ',$username,' already exist <a href="javascript:history.back(-1);">back</a>';
    exit;
}
//insert into DB
$password = MD5($password);

$sql1 = "INSERT INTO oauth_users(username,password,first_name,last_name, email)VALUES('$username','$password','$first_name','$last_name','$email')";
$sql2 = "INSERT INTO oauth_public_keys(client_id)VALUES('$username')";

if(mysql_query($sql1,$conn)&&mysql_query($sql2,$conn)){
    exit('<title>MyOP</title>Sign Up Success! Click Here <a href="login.html">Sign In</a>');
} else {
    echo '<title>MyOP</title>';
    echo 'sorry! data lost：',mysql_error(),'<br />';
    echo 'Click Here <a href="javascript:history.back(-1);">back</a> try again!';
}

?>