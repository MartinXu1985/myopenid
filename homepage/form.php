<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "xumartin1985@gmail.com";
 
    $email_subject = "message from openid provider";
 
     
 
     
 
    function died() {
 
        echo "<SCRIPT>
  	alert('expected data not exists');
  	window.location.href='contact.html'</script>";
   	
 	exit;
 	
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['first_name']) ||
 
        !isset($_POST['last_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['comments'])) {
 
        died();       
 
    }
 
     
 
    $first_name = $_POST['first_name']; // required
 
    $last_name = $_POST['last_name']; // required
 
    $email_from = $_POST['email']; // required
 
    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'Invalid Email Address.';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'Invalid First Name.';
 
  }
 
  if(!preg_match($string_exp,$last_name)) {
 
    $error_message .= 'Invalid Last Name.';
 
  }
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'Invalid Comments.';
 
  }
 
  if(strlen($error_message) > 0) {
  
    echo "<SCRIPT>
  	alert('$error_message');
  	window.location.href='contact.html'</script>";
   	
 	exit;
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
 
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  

  $message = 'Thank you for contacting us. We will be in touch with you very soon.';

  echo "<SCRIPT>
  alert('$message');
  window.location.href='contact.html'</script>";
  exit;
  
}
 
?>