<?php
// include our OAuth2 Server object
require_once __DIR__.'/server.php';
 
$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();

// validate the authorize request
if (!$server->validateAuthorizeRequest($request, $response)) {
    $response->send();
    die;
}

//check session
session_start();

if(!isset($_SESSION['username'])){
	
	$_SESSION['reqAuthUrl'] = $_SERVER['REQUEST_URI']; 
	header("Location:clientLogin.php");
	exit;
}

$user_id = $_SESSION['username'];

// display an authorization form
if (empty($_POST)) {
  exit(
  '<title>MyOP</title>
  <style type="text/css">
	fieldset{width:400px; margin: 0 auto;}
	legend{font-weight:bold; }
	.label{float:left; width:70px; margin-left:10px;}
	.left{margin-left:80px;}
	.input{width:150px;}
	span{color: #666666;}
  </style>
  <div align="center">
  <fieldset>
  <form method="post">
  <h2>Choosed Account:&nbsp;&nbsp;'.$user_id.'</h2> 
  <label>Not you?</label>
  <input type="submit" name="authorized" value="Change Account"><br /><br />
  <label>This is My OpenID Provider</label><br />
  <label>Click YES, If You want to Authorize the Client(RP)?</label><br />
  <input type="submit" name="authorized" value="yes">
  <input type="submit" name="authorized" value="no">
  </form>
  </fieldset>
  </div>');
}

if($_POST['authorized'] === 'Change Account'){
	session_destroy();
	header("Refresh:0");
}else if($_POST['authorized'] === 'yes'){

// print the authorization code if the user has authorized your client
$is_authorized = ($_POST['authorized'] === 'yes');
$server->handleAuthorizeRequest($request, $response, $is_authorized, $user_id);
if ($is_authorized) {
  // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
  $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
 /* exit("SUCCESS! Notice, this is only here so that you get to see your code in the cURL request. Otherwise, it should Redirect back to RP site.<br /><br />
  *****User Authorization Code: $code<br /><br />
  Use the code to sent a cURL request to token_endpoint: ***https://tianjunxu.com/myopenid/token.php<br />
  For example: ****curl -u testclient:testpass https://tianjunxu.com/myopenid/token.php -d 'grant_type=authorization_code&code=YOUR_CODE'"); */
  $response->send($code);
  exit;
}}else{
echo '<title>MyOP</title>';
echo 'authorization cancel.';
}

?>