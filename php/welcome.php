<?php
 session_start();

 $eingeloggt=false;

 if($_SESSION["login"]==1){
 	$eingeloggt=true;

 }
 if($eingeloggt=false){
 	header("Location: ../login.html");
 }



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
	  <a href="index.html" class="w3-bar-item w3-button">Home</a>
	  <a href="speisekarte.html" class="w3-bar-item w3-button">Speisekarte</a>
	  <a href="ueberUns.html" class="w3-bar-item w3-button">Über uns</a>
	  <a href="login.html" class="w3-bar-item w3-button w3-right">Login</a>
	</div>
</header>

	<div>
		<h1>Wilkommen</h1>


	</div>

	



<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green" style="">
	  <a href="impressum.html" class="w3-bar-item w3-button">Impressum</a>
	  <a href="kontaktformular.html" class="w3-bar-item w3-button">Kontaktformular</a>

	  <!-- USER ONLINE ANZEIGE, MUSS BEI WELCOME PAGE EINGEBAUT WERDEN -->
	  <span class="w3-bar-item w3-right">User online: <span class="w3-tag">0</span> <p></span>

</footer>

</div>

</body>

</html>