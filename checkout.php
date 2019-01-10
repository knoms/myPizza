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




$option=1;

if(isset($_POST['versand'])){
	$_SESSION['versand']=$_POST['versand'];
}
$option=$_SESSION['versand'];



if($option==1){
	$Versand=3;
}
elseif($option==2){
	$Versand=5;

}
echo "Versand = $option";


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
	<style>
		.mySlides {display:none;}
	</style>

	<script type="text/javascript">
		
		function cardnumber(inputtxt)
{
  var cardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
  if(inputtxt.value.match(cardno))
        {
      return true;
        }
      else
        {
        alert("Not a valid Visa credit card number!");
        return false;
        }
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
	  <a href="php/logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
	  <a href="warenkorb.php" class="w3-bar-item w3-button w3-right"><i class="../w3-large fa fa-shopping-cart"></i></a>
	</div>
</header>
		<div class="w3-container w3-card-4 w3-light-green w3-padding-3 w3-margin-top"><h2>Bestellübersicht</h2></div>
		
		<div class="w3-container w3-card-4 w3-light-grey  w3-margin" style="width: 50%; float: left">
			<h4>Deine Bestellung wird an folgende Adresse geliefert:</h4>
			<?php 
			$email = $_SESSION['email'];
			$sql = mysqli_query($db,"SELECT * FROM mp_users WHERE Email LIKE '$email'");
			$result = mysqli_fetch_assoc($sql);
			$strasse = $result['Strasse'];
			$plz = $result['PLZ'];
			$stadt = $result['Stadt'];

			echo"Strasse: $strasse <br> PLZ: $plz Stadt: $stadt<br>";
			echo "<h4>Deine gewählte Versandoption:</h4>";
			if($Versand==3){
				echo "Standardlieferung (Etwa 45 Minuten)";

}
elseif($Versand==5){
	echo "Expresslieferung (Etwa 20 Minuten)";

}


	?>
		<br><br>

		<button onclick="history.go(-1);return true;unset($_POST['tocheckout']);" class="w3-button w3-light-green w3-small">Zurück</button>

		<button onclick="order.php;" class="w3-button w3-light-green w3-small" type="submit" name="order" >Bestellen</button>


		</div>
		
	
		

	
		

	
		<table class="w3-container w3-table w3-card-4 w3-light-grey w3-text-light-green w3-margin" style="width:40%; float: left">
		
		<thead>
  			<tr class="w3-light-green">

    				
    				<th>Name</th>
    				<th>Anzahl</th>
    				<th>Preis</th>
  			</tr>

  		</thead>
  		<?php
  		$Array = $_SESSION['cart'];

  		for($i = 0 ; $i < count($Array); $i++)
        {
            $innerArray = $Array[$i];
            
            echo "<tr>
   
            <td>$innerArray[1]</td>
            <td>$innerArray[2]x</td>
            <td>$innerArray[3]€</td>
            </tr>";
        }
        ?>
        
        <?php
			$Summe = 0;
			
			for($i = 0 ; $i < count($Array); $i++)
        {
        	 $innerArray = $Array[$i];
        	$Summe+= $innerArray[3];
        }
        if($Summe!=0){
        	echo"<tr><td></td><td></td><td></td></tr>";
        	echo "<tr><td>Summe:</td><td></td><td>$Summe €<td></tr>"; 
        	$Gesamtsumme = $Summe+$Versand;
        	echo "<tr><td>Versand:</td><td></td><td>$Versand €<td></tr>";
        	echo "<tr><td>Gesamtsumme:</td><td></td><td>$Gesamtsumme €<td></tr>";
        	$_SESSION["Gesamt"]= "$Gesamtsumme";	
       		}

        	
        	
       		



		?>
	</table>
	

		


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