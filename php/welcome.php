<?php
 session_start();
 include ("dbconnect.php");

//echo nl2br(print_r($_SESSION,true)); // Nur zu Debugzwecken, kann auskommentiert werden

 $eingeloggt=false;
 
 if (isset($_SESSION['login'])) {
 	if($_SESSION["login"]==1){
 	$eingeloggt=true;
 	$login_email=$_SESSION['email'];
 	$email = $_SESSION['email'];
 	$checkifordered = mysqli_query($db, "SELECT OrderID FROM 		alreadyordered
							WHERE UserID = (SELECT UserID FROM mp_users WHERE Email='$email')");
		 if(mysqli_num_rows($checkifordered)!==0){
		 	$orderedbefore=true;#
		 }
		 else $orderedbefore=false;
		}
 }


 //echo "Login = $eingeloggt"; 	// Nur zu Debugzwecken, kann auskommentiert werden

 
 if($eingeloggt=false){
 	header("Location: ../login.php");
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<script type="text/javascript"></script>

</head>

<body>

<!-- NAVIGATIONS BEREICH -->
<header class="w3-container w3-padding-32">
	<div class="w3-bar w3-light-grey">
	  <span class="w3-bar-item w3-light-green">My Pizza</span>
	  <a href="../index.php" class="w3-bar-item w3-button">Home</a>
	  <a href="../speisekarte.php" class="w3-bar-item w3-button">Speisekarte</a>
	  <a href="../ueberUns.php" class="w3-bar-item w3-button">Über uns</a>
	  <a href='logout.php' class='w3-bar-item w3-button w3-right'>Logout</a><?php if($orderedbefore){ ?>
	  <a href='letzteBestellungen.php' class='w3-bar-item w3-button w3-right'>Letzte Bestellungen</a> <?php } ?>
	   <a href="../warenkorb.php" class="w3-bar-item w3-button w3-right"><i class="../w3-large fa fa-shopping-cart"></i></a>
	</div>

	<script type="text/javascript">
	var URL = "UserOnline.txt";

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

</header>


	<div class="w3-container w3-center">
		<div class="w3-panel w3-border-top w3-border-bottom">

  		<?php
  			$row = 1;
  			 $sql = mysqli_query($db,"SELECT Vorname from mp_users WHERE Email LIKE '$login_email'");
  			
  			 $result = mysqli_fetch_assoc($sql);
  			 $name= $result["Vorname"];


			if(date("G") < 10) {

			      $begruessung= "Guten Morgen";

			}

			if(date("G") <= 18 && date("G") >= 10) {

			      $begruessung= "Guten Tag";

			}

			if(date("G") >= 19) {

			      $begruessung= "Guten Abend";

			}

			 echo "<h2>$begruessung $name :)";



  		?>

	</div>
	</div> 

	<!-- Inhalt der Webseite -->
	<div class="w3-row-padding">

	<a href="../warenkorb.php" style="text-decoration: none;">
	<div class="w3-panel w3-card-4 w3-center w3-margin w3-hover-light-green" style="width: 98%">
	  <p><b>Warenkorb</b></p>
	</div>
	</a>
	<?php if($orderedbefore){ ?>
	<a href="../letzteBestellungen.php" style="text-decoration: none;">
	<div class="w3-panel w3-card-4 w3-center w3-margin w3-hover-light-green" style="width: 98%">
	  <p><b>Deine letzten Bestellungen</b></p>
	</div>
	</a>
	<?php } ?>

	</div>




<footer class="w3-container w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green">
	  <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
	  <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>

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

		  <span class="w3-bar-item w3-right">User online: <span class="w3-tag" id="container">0</span> <p></span>

</footer>

</div>

</body>

</html>
<?php

mysqli_close($db);

?>