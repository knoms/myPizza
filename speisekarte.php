<?php

$db=mysqli_connect('localhost', 'root', '', 'myPizza');
$db->set_charset('utf8');

if ( ! $sql )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}

$sql= "SELECT * FROM mp_menu";
$daten = $sql->fetch_all(MYSQLI_ASSOC);

foreach($daten as $zeile) {
	echo '<br>';
	echo '<br>' . $zeile['MenuID'] .' '. $zeile['Name'].''. $zeile['Size'].' '. $zeile['Preis'];
}


?>


<!DOCTYPE html>

<htm

<head>
	<meta charset="utf-8">
	<title>MyPizza Speisekarte</title>

	<link href="styleSchrift.css" type="text/css" rel="stylesheet">
	

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
	      <button class="w3-btn w3-light-green w3-border w3-round-large w3-right">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Mageritha</span><br>
	        <span>Mit Tomate, Mozarella und Edamer</span>
	      </div>
	    </li>

	    <li class="w3-bar">
	     <button class="w3-btn w3-light-green w3-border w3-round-large w3-right">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Salami</span><br>
	        <span>Mit Tomatensoße, Edamer und Salami</span>
	      </div>
	    </li>

	    <li class="w3-bar">
	      <button class="w3-btn w3-light-green w3-border w3-round-large w3-right ">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Champignon</span><br>
	        <span>Mit Tomatensoße, Edamer und Chamignon</span>
	      </div>
	    </li>

	    <li class="w3-bar">
	      <button class="w3-btn w3-light-green w3-border w3-round-large w3-right ">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Paprika</span><br>
	        <span>Mit Tomatensoße, Edamer, Oliven, Zwiebeln und Paprika</span>
	      </div>
	    </li>

	    <li class="w3-bar">
	      <button class="w3-btn w3-light-green w3-border w3-round-large w3-right ">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Peperoni Speciale</span><br>
	        <span>Mit Tomatensoße, Edamer, Oliven und Peperoniwurst</span>
	      </div>
	    </li>

	    <li class="w3-bar">
	      <button class="w3-btn w3-light-green w3-border w3-round-large w3-right ">Preis | <i class="w3-large fa fa-shopping-cart"></i></button>
	      <div class="w3-bar-item">
	        <span class="w3-large">Pizza Ruccola</span><br>
	        <span>Mit Tomatensoße, Morzzarella und Ruccola</span>
	      </div>
	    </li>

	  </ul>
</div>
</div>


<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green" style="">
	  <a href="impressum.html" class="w3-bar-item w3-button">Impressum</a>
	  <a href="kontaktformular.html" class="w3-bar-item w3-button">Kontaktformular</a>
	</div>
</footer>

</body>

</html>