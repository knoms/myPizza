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

 if($eingeloggt==false){
 	header("Location: index.php");
 }


 echo "Login = $eingeloggt"; 	// Nur zu Debugzwecken, kann auskommentiert werden

 ?>
 <!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">
	<title>MyPizza letzte Bestellungen</title>

	<link href="styleSchrift.css" type="text/css" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script type="text/javascript"></script>

	<style>
		.mySlides {display:none;}
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

<div class="w3-container w3-center">
		<div class="w3-panel w3-border-top w3-border-bottom">
  			<h2>Deine letzten Bestellungen</h2>
		</div>

				<table class="w3-table w3-border">
		
		<thead>
  			<tr class="w3-light-green ">

    				
    				<th>Bestellnummer</th>
    				<th>Bestelldatum</th>
    				<th>Pizza</th>
    				<th>Preis</th>
  			</tr>

  		</thead>
  		
  			
	  		<?php

		  		$db = mysqli_connect($db_server, $db_benutzer, $db_passwort, $db_name);
		  		$email = $_SESSION['email'];
		  		/* 

		  		DAVOR VIEW ERSTELLT:

				CREATE VIEW AlreadyOrdered AS
				SELECT mp_orders.UserID, mp_orders.OrderID, mp_orders.Time, mp_menu.Name, mp_menu.Preis
				FROM mp_orders, mp_ordered_dishes, mp_menu
				WHERE mp_orders.OrderID = mp_ordered_dishes.OrderID
				AND mp_menu.MenuID=mp_ordered_dishes.MenuID
				ORDER BY UserId, Time;
				*/

		  		$ergebnis = mysqli_query($db, "SELECT OrderID, Time, Name, Preis FROM alreadyordered
							WHERE UserID = (SELECT UserID FROM mp_users WHERE Email='$email')
							ORDER BY OrderID;");


		  		$orderid=array();
		  		$time=array();
				$name=array();
				$preis=array();
				
				// Schreiben in Tabelle
				while ($row = mysqli_fetch_object($ergebnis)) 
				{
					?><tr><?php
					array_push($orderid,$row->OrderID);
					array_push($time,$row->Time);
					array_push($name,$row->Name);
					array_push($preis,$row->Preis);?>
					<td><?php echo $row->OrderID;?></td>
					<td><?php echo $row->Time;?></td>
					<td><?php echo $row->Name;?></td>
					<td><?php echo $row->Preis;?></td>
					</tr>

					<?php
					
				}


	        ?>
 	       
 		
		</table>


	<!-- Wiederbestellenbutton -->
		<?php
		if(isset($_POST['nochmal'])) {
			// noch unvollständig...muss um INSERT ergänzt werden
			$bestellen = "SELECT MAX(OrderID) FROM mp_orders WHERE UserID=(SELECT UserID FROM mp_users WHERE Email='leena.schumacher@web.de')";
			mysqli_query($db, $bestellen);

		}
		?>
		<form method="post">
			<button type="submit" name="nochmal" class="w3-button w3-light-green w3-small">Letzte Bestellung nochmal ausführen</button>			
		</form>

	</div> 





<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green" style="">
	  <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
	  <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>
		<span class="w3-bar-item w3-right">User online: <span class="w3-tag" id="container">0</span> <p></span>
</footer>

</div>

</body>

</html>