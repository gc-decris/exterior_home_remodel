<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name2 = $_POST['name2'];
$visitor_email2 = $_POST['email2'];
$phone2 = $_POST['phone2'];
$zip2 = $_POST['zip2'];
$window = $_POST['windowCheck'];
$roofing = $_POST['roofingCheck'];
$siding = $_POST['sidingCheck'];
$other = $_POST['otherCheck'];
$message = $_POST['message2'];

//Validate first
if(empty($name2)||empty($visitor_email2))
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email2))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'info@exteriorhomeremodelings.com';//<== update the email address
$email_subject = "New Free Estimate Form submission";
$email_body = "You have received a new message from the user $name2.\n".
    "Here is the message:\n $phone2 \n $visitor_email2 \n $zip2 \n $window \n $roofing \n $siding\n $other \n $message \n".

$to = "info@exteriorhomeremodelings.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email2 \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

?>
