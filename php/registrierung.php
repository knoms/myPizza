<?php
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'myPizza');

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
			if(mysqli_num_rows($statement)==1) 
			{	
				header("Location: ../registrierung3.html");
			}
			else
			{
				$password = $password1; //noch SHA einfügen
				$sql = "INSERT INTO mp_users (Name, Vorname, Strasse, PLZ, Stadt, Email, Pw) VALUES ('$last', '$first', '$street', '$plz', '$town', '$email', '$password1')";
				mysqli_query($db, $sql);


				$empfaenger = $_POST['email'];
				$betreff = "Registrierungsbestätigung myPizza";
				$from = "From: SupportService-To: mypizza.service@web.de\r\n";
				$from .= "Content-Type: text/html\r\n";
				$text = "Vielen Dank für Ihre Registrierung bei myPizza! <br> 
				Sie können sich nun mit der E-Mail-Adresse $email und Ihrem gewählten Passwort bei myPizza anmelden.";
				 
				if(mail($empfaenger, $betreff, $text, $from))
				{
					echo "Mail wurde erfldfnj verschiuckt";
				}
				


				$to = $email;
				$subject = "HTML email";

				$message = "
				<html>
				<head>
				<title>HTML email</title>
				</head>
				<body>
				<p>This email contains HTML Tags!</p>
				<table>
				<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				</tr>
				<tr>
				<td>John</td>
				<td>Doe</td>
				</tr>
				</table>
				</body>
				</html>
				";

				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <leena.schumacher@gmail.com>' . "\r\n";

				if(mail($to,$subject,$message,$headers))
				{
					echo "Mail wurde erfldfnj verschiuckt";
				}



				$subject = "erste Mail";
				$to = "leena.schumacher@gmail.com";
				$body = "baldsjnfdoikf";

				if( mail($to, $subject, $body))
				{
					echo "mail tut";
				}
				else{echo "tut nicht";}




				header("Location: ../registrierung2.html");				
			}	
		

		
/* 			function mySha512($str, $salt, $iterations) {
        		for ($x=0; $x<$iterations; $x++) {
            	$str = hash('sha512', $str . $salt);
        		}
        		return $str;
    		}
 
    		$str = $password1;
    		$salt = 'bQ423hbHM8Sbdb9pjquUQU1IWxcxnybBSjqnyBJ23HjqnI3WbkxUQsxnPw813jkq';
 
    		var_dump(mySha512($str, $salt, 10000));
*/		
		$db->close();




	}

?>