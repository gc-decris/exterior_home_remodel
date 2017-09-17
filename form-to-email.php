<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name1 = $_POST['name1'];
$visitor_email1 = $_POST['email1'];
$phone1 = $_POST['phone1'];
$zip1 = $_POST['zip1'];
$product1 = $_POST['product1'];

//Validate first
if(empty($name1)||empty($visitor_email1))
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email1))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'info@exteriorhomeremodelings.com';//<== update the email address
$email_subject = "New Free Estimate Form submission";
$email_body = "You have received a new message from the user $name1.\n".
    "Here is the message:\n $phone1 \n $visitor_email1 \n $zip1 \n $product1 \n".

$to = "info@exteriorhomeremodelings.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email1 \r\n";
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
