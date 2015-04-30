<?php
session_start();

//Check login or not
if(!isset($_SESSION['username'])){
    header("Location:login.html");
    exit();
}
if (isset($_GET['Message'])&&($_GET['Message']==1)) {
    echo '<script type="text/javascript">alert("RP deleted successfully!");</script>';
}
if (isset($_GET['Message'])&&($_GET['Message']==0)) {
    echo '<script type="text/javascript">alert("RP deleted fail!");</script>';
}
if (isset($_GET['Message'])&&($_GET['Message']==2)) {
    echo '<script type="text/javascript">alert("RP created successfully!");</script>';
}

include('conn.php');

$username = $_SESSION['username'];
$user_query = mysql_query("select * from oauth_users where username='$username' limit 1");
$row = mysql_fetch_array($user_query);
echo '<title>MyOP</title>';
echo 'Welcome!!!'.$username.'<br />';
echo '-------------------------------------<br />';
echo 'Username:',$username,'<br />';
echo 'Email:',$row['email'],'<br />';
echo 'Last name:',$row['last_name'],'<br />';
echo 'First name:',$row['first_name'],'<br /><br />';
echo 'Click Here to <a href="login.php?action=logout">logout</a><br /><br /><br />';
echo '-------------------------------------<br />';
echo 'Relying Party Information<br />';
$client_query = mysql_query("select * from oauth_clients where user_id='$username' limit 1");
$row = mysql_fetch_array($client_query,MYSQL_ASSOC);
if (!mysql_num_rows($client_query)) {
	echo'<style type="text/css">
		fieldset{width:400px;}
		legend{font-weight:bold;}
		.label{float:left; width:100px; margin-left:10px;}
		.left{margin-left:80px;}
		.input{width:200px;}
		span{color: #666666;}
	  </style>
	<script language=JavaScript>
	<!--
	
	function InputCheck(CreateForm)
	{
	  if (CreateForm.client_id.value == "")
	  {
	    alert("please enter your client_id!");
	    CreateForm.client_id.focus();
	    return (false);
	  }
	  if (CreateForm.client_secret.value == "")
	  {
	    alert("please enter your client_secret!");
	    CreateForm.client_secret.focus();
	    return (false);
	  }
	  if (CreateForm.redirect_uri.value == "")
	  {
	    alert("please enter your redirect_uri!");
	    CreateForm.redirect_uri.focus();
	    return (false);
	  }
	}
	
	//-->
	</script>
	<div>
	<fieldset>
	<legend >You do not have any RP, Create one!</legend>
	<form name="CreateForm" method="post" action="create.php" onSubmit="return InputCheck(this)">
	<input type="hidden" name="username" value="'.$username.'">
	<p>
	<label for="client_id" class="label">Client_id:</label>
	<input id="client_id" name="client_id" type="text" class="input" />
	<p/>
	<p>
	<label for="client_secret" class="label">Client_secret:</label>
	<input id="client_secret" name="client_secret" type="test" class="input" />
	<p/>
	<p>
	<label for="redirect_uri" class="label">Redirect_uri:</label>
	<input id="redirect_uri" name="redirect_uri" type="url" class="input" />
	<p/>
	<p>
	<input type="submit" name="submit" value="submit" class="left" />
	</p>
	</form>
	</fieldset>
	</div>
	';
	exit();
}else{
	echo 'Client_id: '.$row['client_id'].'<br />';
	echo 'Client_secret: '.$row['client_secret'].'<br />';
	echo 'Redirect_uri: '.$row['redirect_uri'].'<br />';
	echo 'Authorization Endpoint: https://tianjunxu.com/myopenid/authorize.php'.'<br />';
	echo 'Token Endpoint: https://tianjunxu.com/myopenid/token.php'.'<br />';
	echo 'Resource Endpoint: https://tianjunxu.com/myopenid/resource.php'.'<br />';
	echo ' <form action="delete.php" method="post">
        <input type="hidden" name="username" value="'.$username.'">
        <input type="submit" name="submit" value="Delete" onclick="return confirm(\'Are you sure you want to delete?\')">
        </form>';
}
?>