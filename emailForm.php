<?php
if(isset($_POST['senderemail'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "kyliesmotherman@yahoo.com";
    $email_subject = "New Message from kyykaay-cpt.com";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['sendername']) ||
        !isset($_POST['senderemail']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $sendername = $_POST['sendername']; // required
    $senderemail = $_POST['senderemail']; // required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$senderemail)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$sendername)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($message) < 2) {
    $error_message .= 'The message you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($sendername)."\n";
    $email_message .= "Email: ".clean_string($senderemail)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
 
// create email headers
$headers = 'From: '.$senderemail."\r\n".
'Reply-To: '.$senderemail."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
<DOCTYPE HTML>
<html>
	<head>
		<title>Kylie - Certified Personal Trainer</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">
			<!-- Header -->
				<section id="header" class="wrapper">
					<!-- Logo -->
						<div id="logo">
							<h1>Thank you for contacting me, I will be in touch with you soon</h1>
						</div>
				</section>
		</div>
	</body>
</html>
<?php
 
}
?>