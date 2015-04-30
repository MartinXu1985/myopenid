<?php
if(!empty($_POST)){
	$username = $_POST['username'];
	include('conn.php');
	if(mysql_query("DELETE FROM oauth_clients WHERE user_id='$username'")){
	 header("Location:my.php?Message=1");
	 
	 
	}else{
	  echo "delete fail";
	  header("Location:my.php?Message=0");	
	}
	
}else{
echo 'delete fail<br/>';
exit ('<a href="javascript:history.back(-1);">back</a>');
}	
?>