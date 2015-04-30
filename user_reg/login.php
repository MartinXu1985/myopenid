<?php
session_start();

//log out
if($_GET['action'] == "logout"){
    
    session_unset(); 
    session_destroy(); 
    
    echo '<title>MyOP</title>';
    echo 'logout success. Click Here <a href="login.html">Sign in </a>';
    exit;
}

//Sign in
if(!isset($_POST['submit'])){
    header("Location:my.php");
}
$username = htmlspecialchars($_POST['username']);
$password = MD5($_POST['password']);


include('conn.php');
//check username and password
$check_query = mysql_query("select * from oauth_users where username='$username' and password='$password'
limit 1");
if($result = mysql_fetch_array($check_query)){
    //success
    $_SESSION['username'] = $username;
    header("Location:my.php");
    exit;
} else {
    exit('<title>MyOP</title>sign in fail. Click Here <a href="javascript:history.back(-1);">back</a> try again!');
}
?>