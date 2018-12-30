<?php
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'mypizza');

	//if the register button is clicked
	if (isset($_POST['register']))
	{
		$first = $_POST['first'];
		$last = $_POST['last'];
		$street = $_POST['street'];
		$plz = $_POST['plz'];
		$town = $_POST['town'];
		$email = $_POST['email'];
		$password1 = $_POST['password'];
		$password2 = $_POST['password2'];

		// Überprüfen, ob die E-Mail-Adresse noch nicht registriert ist und schreiben in DB

			$statement = mysqli_query($db, "SELECT * FROM mp_users WHERE Email = '$email'");
			if(mysqli_num_rows($statement)==1) 
			{	
				header("Location: http://localhost/myPizza/registrierung3.html");
			}
			else
			{
				$password = $password1; //noch SHA einfügen
				$sql = "INSERT INTO mp_users (Name, Vorname, Strasse, PLZ, Stadt, Email, Pw) VALUES ('$last', '$first', '$street', '$plz', '$town', '$email', '$password1')";
				mysqli_query($db, $sql);	
				header("Location: http://localhost/myPizza/registrierung2.html");				
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