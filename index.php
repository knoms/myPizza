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

	<script type="text/javascript"></script>

	<style>
		.mySlides {display:none;}
	</style>

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

<div class="w3-container w3-center">
			<h1><b>MyPizza</b></h1>
		<div class="w3-panel w3-border-top w3-border-bottom">
  			<p>- Ihr Lieferdienst mit Qualität | Try the new taste -</p>
		</div>
			
</div> 


	<!--<div class="w3-panel w3-card-4 w3-center w3-margin" style="width: 50%">
	  <p>Willkommen bei MyPizza Ihrem Lieferservice</p>
	</div><-->

	<!-- Bilder Galerie -->
	<div class=" w3-content w3-display-container">
		<img class="mySlides" src="Images/holzofen.jpg" style="width: 100%; height: auto;" >
		<img class="mySlides" src="Images/pizza-paprika.jpg" style="width: 100%; height: auto;">
		<img class="mySlides" src="Images/pizza-ruccola.jpg" style="width: 100%; height: auto;">
		<img class="mySlides" src="Images/teig-vorbereitung.jpg" style="width: 100%; height: auto;">
	</div>

	<script>
	var myIndex = 0;
	carousel();

	function carousel() {
	  var i;
	  var x = document.getElementsByClassName("mySlides");
	  for (i = 0; i < x.length; i++) {
	    x[i].style.display = "none";  
	  }
	  myIndex++;
	  if (myIndex > x.length) {myIndex = 1}    
	  x[myIndex-1].style.display = "block";  
	  setTimeout(carousel, 2000); // Change image every 2 seconds
	}
	</script>




<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green" style="">
	  <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
	  <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>

</footer>

</div>

</body>

</html>