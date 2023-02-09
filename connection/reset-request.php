<?php

   //These must be at the top of your script, not inside a function
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;
   

if(isset($_POST["reset-request-submit"]))
{
  //tokens
  $selector=bin2hex(random_bytes(8)); //pin points user to database
  $token=random_bytes(32);//authenticates user

  $url="jajjadev.tech/create-new-password.php?selector=". $selector."&validator=".bin2hex($token);

  //expire time
  $expires=date("U") + 3600;

  
  //connect to the database
   require "../private/connlogin.php";

   $userEmail=$_POST["email"];
   $query="DELETE FROM pwdreset WHERE pwdResetEmail=?";//deleting token if exists
   $stmt=$pdo->prepare($query);
   
   if(!$stmt)
   {
     echo "There was an error";
     exit();
   } else
   {
    $stmt->bindParam(1,$userEmail,PDO::PARAM_STR);
    $stmt->execute();
   };

   $query="INSERT INTO pwdreset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";
   $stmt=$pdo->prepare($query);

   if(!$stmt)
   {
     echo "There was an error";
     exit();
   } else
   {
    $hashedToken=password_hash($token, PASSWORD_DEFAULT);
    $stmt->bindParam(1,$userEmail,PDO::PARAM_STR);
    $stmt->bindParam(2,$selector,PDO::PARAM_STR);
    $stmt->bindParam(3,$hashedToken,PDO::PARAM_STR);
    $stmt->bindParam(4,$expires,PDO::PARAM_INT);
    $stmt->execute();
   }

   $pdo=null;

  //  $to=$userEmail;
  //  $subject="Reset your password from the link below";

  //  $headers="From: Jajjatech<devjajja@gmail.com>\r\n";
  //  $headers.="Repy-To:<devjajja@gmail.com>\r\n";
  //  $headers.="Content-type: text/email\r\n";

  //  mail($to,$subject,$message,$headers);


//message to be sent
$message="<p>We received a password reset request. The link to reset your password 
is below. Please ignore the email if you did not make such a request.</p> ";
$message.="<p> Here is your password reset link:</br>";
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
    $mail->addAddress($userEmail);     //Add a recipient
    $mail->addAddress($userEmail);               //Name is optional
    // $mail->addReplyTo('d', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Reset your password from the link below";
    $mail->Body    =$message;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

   

   header("location:../reset-password.php?reset=success");

}

else{
  header("location:../index.php");
}