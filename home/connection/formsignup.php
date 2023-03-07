<?php
   //These must be at the top of your script, not inside a function
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;
include_once("../private/database.php");//database connection details

if(isset($_POST["submit"]))//checking whether user has submited info
{ 
  //gathering user information
  $fullname=$_POST["fullname"];
  $email=$_POST["email"];
  $dateupload=date("Y-m-d H:i:s");
  $access=$_POST["access"];
  $uniId=md5(str_shuffle("abcdefghijklmnopqrstuvwxyz"));

  //error handling
  $error="";
  //empty fields
  //emptyFieldSignUp($fullname,$username,$email,$tel,$password,$passwordRepeat,$access)
  if(emptyFieldSignUp($fullname,$email,$access)!==false)
  {
    header("location:../forms/signup.php?error=emptyfield");
    exit();
  }

  //sending an email to user
  $url="nucafegrading.com/updateaccount.php?user=". $uniId;

  //  $to=$userEmail;
  //  $subject="Reset your password from the link below";

  //  $headers="From: Jajjatech<devjajja@gmail.com>\r\n";
  //  $headers.="Repy-To:<devjajja@gmail.com>\r\n";
  //  $headers.="Content-type: text/email\r\n";

  //  mail($to,$subject,$message,$headers);


//message to be sent
$message="<p>Please use the link below to setup a user account with Nucafe for its ERP system.
Please ignore the email if you are not the intended recipient.</p> ";
$message.="<p> Here is a link to complete your account creation:</br>";
$message.="<a href='$url'>".$url."</a></p>";

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'premium33.web-hosting.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'devjajja@jajjadev.tech';                     //SMTP username
    $mail->Password   = 'christistheking@7';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('devjajja@jajjadev.tech', 'Nucafe');
    $mail->addAddress($email);     //Add a recipient
    $mail->addAddress($email);               //Name is optional
    // $mail->addReplyTo('d', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Create a Nucafe ERP system Account";
    $mail->Body    =$message;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
// exit();
signUpUser($fullname,$email,$access,$uniId);

}


?>