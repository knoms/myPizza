<?php
 session_start();
 include ("php/dbconnect.php");
 include_once ("php/cart.php");

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

 $cart = new cart();


$cart->initial_cart(); 

$cartsize = $cart -> get_cart_count();
if($cartsize=0){
	header('Location: warenkorb.php');
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
	  <a href="php/logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
	  <a href="warenkorb.php" class="w3-bar-item w3-button w3-right"><i class="../w3-large fa fa-shopping-cart"></i></a>
	</div>
</header>


	
		

	
		<form action="checkout.php" class="w3-container w3-card-4 w3-light-grey w3-text-light-green w3-margin" method="post" style="width: 50%; float: left " >
			<h2>Lieferung</h2>
				<select class="w3-select" name="versand" required>
  				<option value="" disabled selected>Wähle bitte eine Lieferoption</option>
				<option value="1">Normale Lieferung +3€</option>
  				<option value="2">Express Lieferung +5€</option>
  				
			</select>
			<br><br><br>

			


			<button onclick="warenkorb.php" class="w3-button w3-light-green w3-small">Zurück zum Warenkorb</button>

			<button class="w3-button w3-light-green w3-small" type="submit" name="tocheckout">Zur Kasse</button>
				<?php 

					if(isset($_POST['tocheckout'])) {

						
							header('Location: checkout.php');
						
						
						
					 
				 	}
				 	
				?>	
				<br><br>
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