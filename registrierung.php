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
	<title>MyPizza</title>

	<link href="styleSchrift.css" type="text/css" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script type="text/javascript"></script>

	<style>
		.mySlides {display:none;}
	</style>

	<script language="JavaScript" type="text/javascript"> 
		<!-- 
		function pwpruefen() { 
			var pass1=document.registrierung.password1.value; 
			var pass2=document.registrierung.password2.value; 
			if (document.registrierung.password1.value != document.registrierung.password2.value) 
			{ 
				alert ("Fehler. Bitte überprüfen Sie ihre Passwortangaben");
				document.registrierung.onsubmit ="javascript: return pwpruefen();";
				document.registrierung.password1.focus();
				document.registrierung.password1.value = "";
				document.registrierung.password2.value = "";

				return false; 
			}
			else{return true;}
		} 

		//--> 
	</script> 
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


	<form name="registrierung" method="post" action="php/registrierung.php" class="w3-container w3-animate-left w3-card-4 w3-light-grey w3-text-light-green w3-margin">
		<h2>Registrierung</h2>
	 
		<div class="w3-row w3-section">
  			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    		<div class="w3-rest">
      			<input class="w3-input w3-border" name="first" type="text" placeholder="Vorname" required>
      			<br>
      			<input class="w3-input w3-border" name="last" type="text" placeholder="Nachname" required>
    		</div>
		</div>

		<div class="w3-row w3-section">
  			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-home"></i></div>
   			<div class="w3-rest">
      			<input class="w3-input w3-border" name="street" type="text" placeholder="Staße + Nr." required>
      			<br>
      			<input pattern="[0-9]{5}" class="w3-input w3-border" name="plz" placeholder="PLZ" required>
      			<br>
      			<input class="w3-input w3-border" name="town" type="text" placeholder="Stadt" required>
    		</div>
		</div>
		<hr>

		<div class="w3-row w3-section">
  			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
    		<div class="w3-rest">
      			<input class="w3-input w3-border" name="email" type="email" placeholder="Email" required>
    		</div>
		</div>
		<hr>
		<div class="w3-row w3-section">
  			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-key"></i></div>
    		<div class="w3-rest">
      			<input class="w3-input w3-border" name="password1" type="password" placeholder="Passwort" required>
      			<br>
      			<input class="w3-input w3-border" name="password2" type="password" placeholder="Passwort wiederholen" required>
    		</div>
		</div>

		<button onclick="javascript: return pwpruefen();" type="submit" name="register" class="w3-button w3 medium w3-section w3-light-green w3-ripple w3-padding">Registrieren</button>
	</form>


<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green" style="">
	  <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
	  <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>
	</div>
</footer>

</div>

</body>

</html>