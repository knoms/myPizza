<?php
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'myPizza');
	require '../phpmailer/PHPMailerAutoload.php';

	//if the register button is clicked
	if (isset($_POST['register']))
	{
		$first = $_POST['first'];
		$last = $_POST['last'];
		$street = $_POST['street'];
		$plz = $_POST['plz'];
		$town = $_POST['town'];
		$email = $_POST['email'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];

		// Überprüfen, ob die E-Mail-Adresse noch nicht registriert ist und schreiben in DB

			$statement = mysqli_query($db, "SELECT * FROM mp_users WHERE Email = '$email'");
			if(mysqli_num_rows($statement)==1) //Wenn Email bereits vorhanden ist
			{	
				header("Location: ../registrierung3.php");
			}
			else //Wenn Email noch nicht vorhanden ist 
			{
				$password = hash('sha256', $password1); 
				$sql = "INSERT INTO mp_users (Name, Vorname, Strasse, PLZ, Stadt, Email, Pw) VALUES ('$last', '$first', '$street', '$plz', '$town', '$email', '$password')";
				mysqli_query($db, $sql);
			
			//Bestätigungsmail versenden
							
			

			$mail = new PHPMailer;
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';
			// use
			// $mail->Host = gethostbyname('smtp.gmail.com');
			// if your network does not support SMTP over IPv6
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "service.mypizza@gmail.com";
			//Password to use for SMTP authentication
			$mail->Password = "mypizza123";
			//Set who the message is to be sent from
			$mail->setFrom('service.mypizza@gmail.com', 'MyPizza Service');
			//Set an alternative reply-to address
			$mail->addReplyTo('service.mypizza@gmail.com', 'MyPizza Service');
			//Set who the message is to be sent to
			$mail->addAddress("$email");


			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			$mail->isHTML(true);                                  // Set email format to HTML

			
			$body =	"<p>Hallo <strong>$first</strong>, vielen Dank f&uumlr deine Registrierung bei MyPizza<p>"; 
			

			$mail->Subject = 'Willkommen bei MyPizza';
			$mail->Body    = $body;
			$mail->AltBody = strip_tags($body);

			if(!$mail->send()) {
			   // echo 'Message could not be sent.';
			    //echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			   // echo 'Message has been sent';
			}

			// Ende Mail-Versand

				header("Location: ../registrierung2.php");				
			}	
		

		

	
		
mysqli_close($db);





	}

?>