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
		  <a href="index.html" class="w3-bar-item w3-button">Home</a>
		  <a href="speisekarte.html" class="w3-bar-item w3-button">Speisekarte</a>
		  <a href="ueberUns.html" class="w3-bar-item w3-button">Über uns</a>
		  <a href="login.php" class="w3-bar-item w3-button w3-right">Login</a>
		</div>
  		
  	</header>

	<form action="php/login.php" id="loginform" method="post" role="form" class="w3-container w3-animate-left w3-card-4 w3-light-grey w3-text-light-green w3-margin">
		<h2>Login</h2>
	 		<?php

	 		if(isset($_GET['error'])==1){
	 		echo 'Email oder Passwort ungültig.';
	 		}

	 		?>


		<div class="w3-row w3-section">
  			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
    		<div class="w3-rest">
      			<input id="login-email" class="w3-input w3-border" name="email" type="email" placeholder="Email" required>
    		</div>
		</div>
		<div class="w3-row w3-section">
  			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-key"></i></div>
    		<div class="w3-rest">
      			<input id="login-password" class="w3-input w3-border" name="password" type="password" placeholder="Passwort" required>
    		</div>
		</div>

		<button class="w3-button w3 medium w3-section w3-light-green w3-ripple w3-padding" name="login" type="submit" >Anmelden</button>
	</form>

	<hr>

	<form action="registrierung.html">
		<button class="w3-button w3-small">Sie haben noch keinen Benutzeraccount? Dann schnell hier registrieren!</button>		
	</form>
	
	<!-- NAVIGATION FUßLEISTE -->
	<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
		<div class="w3-bar w3-light-green" style="">
		  <a href="impressum.html" class="w3-bar-item w3-button">Impressum</a>
		  <a href="kontaktformular.html" class="w3-bar-item w3-button">Kontaktformular</a>
		</div>
</footer>

</body>

</html>