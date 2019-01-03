<?php
require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.web.de ;smtp.web.de ';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mypizza.service@web.de';                 // SMTP username
$mail->Password = 'mypizza123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'mypizza.service@web.de';
$mail->FromName = 'MyPizza Service';
//$mail->addAddress('noah@mautner.de', 'Noah Mautner');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$mail->isHTML(true);                                  // Set email format to HTML


function bestaetigungsMail($email,$name){
	$body = '<p><strong>Hallo </strong>, vielen Dank für deine Registrierung bei MyPizza</p>';

	$subject ='Deine Registrierung bei MyPizza';
	$mail->Subject = $subject;
	$mail->Body    = $body;
	$mail->AltBody = strip_tags($body);

	$mail->addAddress('$email'); 

	if(!$mail->send()) {
   					 	echo 'Message could not be sent.';
    					echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
    					echo 'Message has been sent';
					}


}










?>