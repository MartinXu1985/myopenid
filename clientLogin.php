<?php
session_start();

if (empty($_POST)) {
  exit(
  ' <style type="text/css">
	fieldset{width:400px; margin: 0 auto;}
	legend{font-weight:bold;}
	.label{float:left; width:70px; margin-left:10px;}
	.left{margin-left:80px;}
	.input{width:150px;}
	span{color: #666666;}
  </style>
<script language=JavaScript>
<!--

function InputCheck(LoginForm)
{
  if (LoginForm.username.value == "")
  {
    alert("please enter your username!");
    LoginForm.username.focus();
    return (false);
  }
  if (LoginForm.password.value == "")
  {
    alert("please enter your password!");
    LoginForm.password.focus();
    return (false);
  }
}

//-->
</script>
<title>MyOP</title>
<body>
<div align="center">
    <h2>You Need to SignIn.</h2>
</div>
<div>
<fieldset>
<legend>User Sign In</legend>
<form name="LoginForm" method="post" action="" onSubmit="return InputCheck(this)">
<p>
<label for="username" class="label">username:</label>
<input id="username" name="username" type="text" class="input" />
<p/>
<p>
<label for="password" class="label">password:</label>
<input id="password" name="password" type="password" class="input" />
<p/>
<p>
<input type="submit" name="submit" value="  Sign in  " class="left" />
</p>
</form>
</fieldset>
</div>
</body>');
}


$reqAuthUrl = $_SESSION['reqAuthUrl'];
$username = htmlspecialchars($_POST['username']);
$password = MD5($_POST['password']);


include('user_reg/conn.php');
//check username and password
$check_query = mysql_query("select * from oauth_users where username='$username' and password='$password'
limit 1");
if($result = mysql_fetch_array($check_query)){
    //success
    $_SESSION['username'] = $username;
    
    header("Location:".$reqAuthUrl);
    exit;
} else {
    exit('sign in fail. Click Here <a href="javascript:history.back(-1);">back</a> try again!');
}
?>