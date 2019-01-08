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
				header("Location: ../registrierung3.html");
			}
			else //Wenn Email noch nicht vorhanden ist 
			{
				$password = hash('sha256', $password1); 
				$sql = "INSERT INTO mp_users (Name, Vorname, Strasse, PLZ, Stadt, Email, Pw) VALUES ('$last', '$first', '$street', '$plz', '$town', '$email', '$password')";
				mysqli_query($db, $sql);
			
			//Bestätigungsmail versenden
							
			

			$mail = new PHPMailer;
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.web.de';  							// Specify SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'mypizza.service@web.de';                 // SMTP username
			$mail->Password = 'mypizza123';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    

			$mail->From = 'mypizza.service@web.de';
			$mail->FromName = 'MyPizza Service';

			$mail->addAddress("$email");               
			$mail->addReplyTo('mypizza.service@web.de', 'Information');


			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			$mail->isHTML(true);                                  // Set email format to HTML

			$name= $first;
			$body =	"<p>Hallo <strong>$name</strong>, vielen Dank f&uumlr deine Registrierung bei MyPizza<p>"; // Hier kann per HTML später eine tolle Nachricht rein

			$mail->Subject = 'Willkommen bei MyPizza';
			$mail->Body    = $body;
			$mail->AltBody = strip_tags($body);

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}

			// Ende Mail-Versand

				header("Location: ../registrierung2.php");				
			}	
		

		

	
		$db->close();




	}

?>