<?php
 session_start();
 include ("php/dbconnect.php");

echo nl2br(print_r($_SESSION,true)); // Nur zu Debugzwecken, kann auskommentiert werden

 $eingeloggt=false;
 if (isset($_SESSION['login'])) {
 	if($_SESSION["login"]==1){
 	$eingeloggt=true;
		}
 }


 echo "Login = $eingeloggt"; 	// Nur zu Debugzwecken, kann auskommentiert werden

 ?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<title>My Pizza, Login</title>

	<link href="styleSchrift.css" type="text/css" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
	
<body>

	<!-- NAVIGATIONS BEREICH -->
	<header class="w3-container w3-padding-32">
		<div class="w3-bar w3-light-grey">
		  <span class="w3-bar-item w3-light-green">My Pizza</span>
		  <a href="index.php" class="w3-bar-item w3-button">Home</a>
		  <a href="speisekarte.php" class="w3-bar-item w3-button">Speisekarte</a>
		  <a href="ueberUns.php" class="w3-bar-item w3-button">Über uns</a>
		  <a href="login.php" class="w3-bar-item w3-button w3-right">Login</a>
		</div>  		
  	</header>

	<div class="w3-card-4 w3-animate-left">

		<header class="w3-container w3-light-green w3-text-light-grey">
		  <h1><div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-thumbs-o-up"></i></div>Ihre Registrierung wurde erfolgreich durchgeführt</h1>
		</header>

		<div class="w3-container w3-text-light-green">
		  <p>Vielen Dank für Ihre Registrierung bei myPizza.de<br>
		  	Sie erhalten in kürze eine Bestätigungsmail im Postfach Ihrer genannten E-Mail-Adresse.<br>
		  	Sie können sich nun mit den registrierten Anmeldedaten über den Login anmelden und Ihre Lieblingspizza bestellen!
		  </p>
		</div>

		<footer class="w3-container w3-light-green w3-text-light-grey">
		  <h5><a href="login.php"><i class="fa fa-angle-double-right"></i>  Zum Login</a></h5>
		</footer>

	</div>
	
	<!-- NAVIGATION FUßLEISTE -->
	<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
		<div class="w3-bar w3-light-green" style="">
		  <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
		  <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>
		</div>
</footer>

</body>

</html>