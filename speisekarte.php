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
	<title>MyPizza Speisekarte</title>

	<link href="styleSchrift.css" type="text/css" rel="stylesheet">
	

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style type="text/css">
		/* The Modal (background) */
		.modal {
		  display: none; /* Hidden by default */
		  position: fixed; /* Stay in place */
		  z-index: 1; /* Sit on top */
		  left: 0;
		  top: 0;
		  width: 100%; /* Full width */
		  height: 100%; /* Full height */
		  overflow: auto; /* Enable scroll if needed */
		  background-color: rgb(0,0,0); /* Fallback color */
		  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		}

		/* Modal Content/Box */
		.modal-content {
		  background-color: #fefefe;
		  margin: 15% auto; /* 15% from the top and centered */
		  padding: 20px;
		  border: 1px solid #888;
		  width: 80%; /* Could be more or less, depending on screen size */
		}

		/* The Close Button */
		.close {
		  color: #aaa;
		  float: right;
		  font-size: 28px;
		  font-weight: bold;
		}

		.close:hover,
		.close:focus {
		  color: black;
		  text-decoration: none;
		  cursor: pointer;
		}
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

  	<!-- LISTE SPEISEKARTE; man muss eine ADD FKT. MIT DB ERSTELLEN -->
  	<div class="w3-panel w3-container w3-animate-left">
  	
  	<div class="w3-container w3-center">
		<div class="w3-panel w3-border-top w3-border-bottom">
  			<h2>Speisekarte</h2>
		</div>
	</div> 

  	<div class="w3-container">

	  <ul class="w3-ul w3-card-4">
	    <li class="w3-bar">
		      <button onclick="insertMargeritha()" name="margeritha" id="margeritha" class="w3-btn w3-light-green w3-border w3-round-large w3-right">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
		      <div class="w3-bar-item">
		        <span class="w3-large">Pizza Mageritha</span><br>
		        <span>Mit Tomate, Mozarella und Edamer</span>
		      </div> 
	    </li>

	    <li class="w3-bar">
	     <button id="salami" class="w3-btn w3-light-green w3-border w3-round-large w3-right">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Salami</span><br>
	        <span>Mit Tomatensoße, Edamer und Salami</span>
	      </div>
	    </li>

	    <li class="w3-bar">
	      <button id="champignon" class="w3-btn w3-light-green w3-border w3-round-large w3-right ">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Champignon</span><br>
	        <span>Mit Tomatensoße, Edamer und Chamignon</span>
	      </div>
	    </li>

	    <li class="w3-bar">
	      <button id="paprika" class="w3-btn w3-light-green w3-border w3-round-large w3-right ">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Paprika</span><br>
	        <span>Mit Tomatensoße, Edamer, Oliven, Zwiebeln und Paprika</span>
	      </div>
	    </li>

	    <li class="w3-bar">
	      <button id="peperoni" class="w3-btn w3-light-green w3-border w3-round-large w3-right ">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Peperoni Speciale</span><br>
	        <span>Mit Tomatensoße, Edamer, Oliven und Peperoniwurst</span>
	      </div>
	    </li>

	    <li class="w3-bar">
	      <button id="ruccola" class="w3-btn w3-light-green w3-border w3-round-large w3-right ">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Ruccola</span><br>
	        <span>Mit Tomatensoße, Morzzarella und Ruccola</span>
	      </div>
	    </li>

	  </ul>
	</div>
</div>

<?php

function insertMargeritha(){
	$db = mysqli_connect('localhost', 'root', '', 'myPizza');

	// Kommentarstriche Entfernen wenn Session aktiv und Zeile darunter löschen!!
	// $userId = "SELECT UserID FROM mp_users WHERE Email='$_SESSION['email']'";

	// $userId = "(SELECT UserID FROM mp_users WHERE Email='leena.schumacher@web.de')";
	// $price = "(SELECT Preis FROM mp_menu WHERE Size='s' AND Name = 'Pizza Margherita')";
	$anzahl = "1";
	$menuId = "1";

	$sql1 = "INSERT INTO mp_orders (UserID, Time, Artikelanzahl, Preis, Vk) VALUES 
			((SELECT UserID FROM mp_users WHERE Email='leena.schumacher@web.de'), CURRENT_TIMESTAMP, '$anzahl', 
			(SELECT Preis FROM mp_menu WHERE Size='s' AND Name='Pizza Margherita'), (SELECT Preis FROM mp_menu WHERE Size='s' AND Name='Pizza Margherita')*2)";
	$sql2 = "INSERT INTO mp_ordered_dishes (MenuID, OrderID) VALUES 
			((SELECT MenuID FROM mp_menu WHERE Size='s' AND Name='Pizza Margherita'),
			(SELECT OrderID FROM mp_orders WHERE Time = CURRENT_TIMESTAMP))"; 
	mysqli_query($db, $sql1);
	mysqli_query($db, $sql2);
}

?>

	<!-- The Modal -->
	<div id="myModal" class="modal">

	  <!-- Modal content -->
	  <div class="modal-content">
	    <span class="close">&times;</span>
		<h3 class="w3-margin-left w3-text-light-green">Die gewünschte Pizza wurde Ihrem Warenkorb hinzugefügt!</h3>
		<form class="w3-margin" action="warenkorb.php">
			  <input class="w3-margin-bottom w3-button w3-large w3-light-green w3-text-light-grey" type="submit" value="Zum Warenkorb">
		</form>
	  </div>

	</div>

	<script type="text/javascript">
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("margeritha");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal 
	btn.onclick = function() {
	  modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
	</script>

	<script type="text/javascript">
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("salami");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal 
	btn.onclick = function() {
	  modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
	</script>

<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green" style="">
	  <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
	  <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>
	</div>
</footer>

</body>

</html>