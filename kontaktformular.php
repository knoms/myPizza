<?php
 session_start();
 include ("php/dbconnect.php");

//echo nl2br(print_r($_SESSION,true)); // Nur zu Debugzwecken, kann auskommentiert werden

 $eingeloggt=false;
 if (isset($_SESSION['login'])) {
 	if($_SESSION["login"]==1){
 	$eingeloggt=true;
		}
 }


 //echo "Login = $eingeloggt"; 	// Nur zu Debugzwecken, kann auskommentiert werden

 ?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<title>MyPizza, Kontaktformular</title>


	<link href="styleSchrift.css" type="text/css" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.mySlides {display:none;}
		 body, a:hover, button:hover {cursor: url(pizza.cur), default;}
	</style>

	<script type="text/javascript">
	var URL = "php/UserOnline.txt";

(function loadTxt() {
  ajaxRequest(URL, function(xhr) {
    document.getElementById('container').innerHTML = xhr.responseText;
    setTimeout(loadTxt, 2000);
  });
})();

function ajaxRequest(url, callback) {
  var xhr;
  if (typeof XMLHttpRequest !== 'undefined') xhr = new XMLHttpRequest();
  else {
    var versions = ["MSXML2.XmlHttp.5.0",
      "MSXML2.XmlHttp.4.0",
      "MSXML2.XmlHttp.3.0",
      "MSXML2.XmlHttp.2.0",
      "Microsoft.XmlHttp"
    ]
    for (var i = 0, len = versions.length; i < len; i++) {
      try {
        xhr = new ActiveXObject(versions[i]);
        break;
      } catch (e) {}
    } 
  }
  xhr.onreadystatechange = ensureReadiness;
  function ensureReadiness() {
    if (xhr.readyState < 4) {
      return;
    }
    if (xhr.status !== 200) {
      return;
    }
    if (xhr.readyState === 4) {
      callback(xhr);
    }
  }
  xhr.open('GET', url, true);
  xhr.send('');
}
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
		  <?php 
	  if ($eingeloggt==true){ ?>
	  		<a href='php/logout.php' class='w3-bar-item w3-button w3-right'>Logout</a>
	  		<a href='letzteBestellungen.php' class='w3-bar-item w3-button w3-right'>Letzte Bestellungen</a>
	  		<a href='warenkorb.php' class='w3-bar-item w3-button w3-right'><i class='w3-large fa fa-shopping-cart'></i></a>
	  		
	  		


	  		<?php
	  				}

	  	else { ?>
	  		<a href='login.php' class='w3-bar-item w3-button w3-right'>Login</a>
	  	 <?php }  ?>
		</div>
	</header>
	
	<form action="/action_page.php" class="w3-container w3-animate-left w3-card-4 w3-light-grey w3-text-light-green w3-margin">
		<h2>Kontaktformular</h2>
	 
		<div class="w3-row w3-section">
  			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    		<div class="w3-rest">
      			<input class="w3-input w3-border" name="first" type="text" placeholder="Vorname" required>
      			<br>
      			<input class="w3-input w3-border" name="last" type="text" placeholder="Nachname" required>
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
  			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
    		<div class="w3-rest">
      			<input class="w3-input w3-border" name="text" type="text" placeholder="Wie können wir Ihnen weiter helfen?" required>
    		</div>
		</div>
		<button class="w3-button w3 medium w3-section w3-light-green w3-ripple w3-padding">Abschicken</button>
	</form>

	<footer class="w3-container w3-padding-32 w3-margin-top">
		<!-- Fußleiste -->
		<div class="w3-bar w3-light-green" style="">
		  <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
		  <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>
		  	<span class="w3-bar-item w3-right">User online: <span class="w3-tag" id="container">0</span> <p></span>
		</div>
	</footer>

</body>

</html>
<?php
mysqli_close($db);
?>