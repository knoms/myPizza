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
	<title>My Pizza, Login</title>

	<link href="styleSchrift.css" type="text/css" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
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
		  <a href="login.php" class="w3-bar-item w3-button w3-right">Login</a>
		</div>  		
  	</header>

	<div class="w3-card-4 w3-animate-left w3-margin w3-light-grey w3-text-light-green w3-margin">

		
		<h3>Ihre E-Mail-Adresse ist bereits in unserem System angelegt</h3>

		<form class="w3-margin" action="login.php">
			  <input class="w3-margin-bottom w3-button w3-large w3-light-green w3-text-light-grey" type="button" value="Zur&uuml;ck" onClick="history.go(-1);return true;">
			  <input class="w3-margin-bottom w3-button w3-large w3-light-green w3-text-light-grey" type="submit" value="Zum Login">
		</form>

	</div>
	
	<!-- NAVIGATION FUßLEISTE -->
	<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
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