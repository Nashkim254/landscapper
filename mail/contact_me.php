<?php
// request for the use of the PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$email_subject = $_POST['subject'];
$message = $_POST['message'];

// require the PHPMailer files
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

$mail = new PHPMailer();

// smtp settings
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = "true";
$mail->Username = "emailtobeused@gmail.com";
$mail->Password = "emailPass";
$mail->Port = 465;
$mail->SMTPSecure = "ssl";

// email settings
$mail->isHTML(true);
$mail->setFrom($email_address, $name);
$mail->addAddress("queenevolvequalitysolutions@gmail.com");
$mail->Subject = ("$email_address ($email_subject)");
$mail->Body = $message;

if ($mail->send()) {
   $status = "success";
   $response = "Email is sent!";
} else {
   $status = "failed";
   $response = "Something went wrong: <br>" .$mail->ErrorInfo;
}

exit(json_encode(array("status" => $status, "response" => $response)));
	
// // Create the email and send the message
// $to = 'yourname@yourdomain.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
// $email_subject = "Website Contact Form:  $name";
// $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nMessage:\n$message";
// $headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
// $headers .= "Reply-To: $email_address";	
// mail($to,$email_subject,$email_body,$headers);
return true;			
?>