<?php

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.web.de';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mypizza.service@web.de';                 // SMTP username
$mail->Password = 'mypizza123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'mypizza.service@web.de';
$mail->FromName = 'MyPizza Service';

$mail->addAddress('noah@mautner.de');               // Name is optional
$mail->addReplyTo('mypizza.service@web.de', 'Information');


$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->isHTML(true);                                  // Set email format to HTML

$name= 'Noah';
$body =	"<p>Hallo <strong>$name</strong>, vielen Dank f&uumlr deine Registrierung bei MyPizza<p>";

$mail->Subject = 'Willkommen bei MyPizza';
$mail->Body    = $body;
$mail->AltBody = strip_tags($body);

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>