<?php
 session_start();
 include 'dbconnect.php';




 $eingeloggt=false;

 if($_SESSION["login"]==1){
 	$eingeloggt=true;

 }
 if($eingeloggt=false){
 	header("Location: ../login.html");
 }
//$sql = mysqli_query($db,"SELECT Vorname from mp_users WHERE Email LIKE '$_SESSION["email"]");


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

</head>

<body>

<!-- NAVIGATIONS BEREICH -->
<header class="w3-container w3-padding-32">
	<div class="w3-bar w3-light-grey">
	  <span class="w3-bar-item w3-light-green">My Pizza</span>
	  <a href="../index.html" class="w3-bar-item w3-button">Home</a>
	  <a href="../speisekarte.html" class="w3-bar-item w3-button">Speisekarte</a>
	  <a href="../ueberUns.html" class="w3-bar-item w3-button">Über uns</a>
	  <a href="../warenkorb.html" class="w3-bar-item w3-button w3-right"><i class="../w3-large fa fa-shopping-cart"></i></a>
	  <a href="logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
	</div>
</header>

	<div class="w3-container">
  		<h2>Wilkommen bei MyPizza</h2>
	</div>

	



<footer class="w3-container w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green">
	  <a href="impressum.html" class="w3-bar-item w3-button">Impressum</a>
	  <a href="kontaktformular.html" class="w3-bar-item w3-button">Kontaktformular</a>

	  <!-- USER ONLINE ANZEIGE, MUSS BEI WELCOME PAGE EINGEBAUT WERDEN -->
	 <!-- <script>
		function showHint(str) {
		    if (str.length == 0) { 
		        document.getElementById("txtHint").innerHTML = "";
		        return;
		    } else {
		        var xmlhttp = new XMLHttpRequest();
		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
		                document.getElementById("").innerHTML = this.responseText;
		            }
		        };
		        xmlhttp.open("GET", "login.php?q=" +, true);
		        xmlhttp.send();
    }
}
</script>
-->

	  <span class="w3-bar-item w3-right">User online: <span class="w3-tag">0</span> <p></span>

</footer>

</div>

</body>

</html>