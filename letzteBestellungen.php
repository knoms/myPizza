<?php
 session_start();
 include ("php/dbconnect.php");
 include_once ("php/cart.php");

//echo nl2br(print_r($_SESSION,true)); // Nur zu Debugzwecken, kann auskommentiert werden

 $eingeloggt=false;
 if (isset($_SESSION['login'])) {
 	if($_SESSION["login"]==1){
 	$eingeloggt=true;
		}
 }

 if($eingeloggt==false){
 	header("Location: index.php");
 }

$email = $_SESSION['email'];
 //echo "Login = $eingeloggt";  	// Nur zu Debugzwecken, kann auskommentiert werden
//echo "<br>POST:<br>";
//echo nl2br(print_r($_POST,true));

$cart = new cart();


$cart->initial_cart(); 



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

	  	else { 
	  		?>

	  		<a href='login.php' class='w3-bar-item w3-button w3-right'>Login</a>
	  	
	  	 <?php }  

	  	 ?>
	  	
	  
	  
	</div>
</header>


<div class="w3-container w3-center">
		<div class="w3-panel w3-border-top w3-border-bottom">
  			<h2>Deine letzten Bestellungen</h2>
		</div>
		<br><br>
		<div align="center">
		<?php
				$allebestellungen= array();
				$letztebestellung= (mysqli_query($db, "SELECT MAX(OrderID) AS OrderID FROM alreadyordered
							WHERE UserID = (SELECT UserID FROM mp_users WHERE Email='$email')
							ORDER BY OrderID"));
				$erstebestellung= (mysqli_query($db, "SELECT MIN(OrderID) AS OrderID  FROM alreadyordered
							WHERE UserID = (SELECT UserID FROM mp_users WHERE Email='$email')
							ORDER BY OrderID;"));
				$fetchMaxOrderID = mysqli_fetch_assoc($letztebestellung);
				$fetchMinOrderID = mysqli_fetch_assoc($erstebestellung);

				$maxOrderID = $fetchMaxOrderID['OrderID'];
				$minOrderID = $fetchMinOrderID['OrderID'];
				
				for($i=$maxOrderID; $i>=$minOrderID; $i--){
					$ergebnis = mysqli_query($db, "SELECT OrderID, Time, Name, Preis FROM alreadyordered
							WHERE UserID = (SELECT UserID FROM mp_users WHERE Email='$email') AND OrderID='$i'");
					$bestelltepizzen = array();
					while ($order=mysqli_fetch_assoc($ergebnis)) {
						array_push($bestelltepizzen,$order);
					}
					$ergebnis1 = mysqli_query($db, "SELECT Preis, Vk, Artikelanzahl FROM mp_orders WHERE UserID = (SELECT UserID FROM mp_users WHERE Email='$email') AND OrderID ='$i'");
					if(mysqli_num_rows($ergebnis1)==1){
					$order1=mysqli_fetch_assoc($ergebnis1);

					$time=$order['Time'];
					$name=$order['Name'];
					$preis=$order['Preis'];
					$gesamtsumme = $order1['Preis'];
					$versand = $order1['Vk'];
					$anzahl = '1';
					$artikelanzahl = $order1['Artikelanzahl'];

					
					 

					
						$aktuellebestellung = array($i,$gesamtsumme, $time ,$artikelanzahl,$versand,$bestelltepizzen);
							
					array_push($allebestellungen,$aktuellebestellung);
					}
				
				}


				//aausgabe ($b=$maxOrderID; $b>$minOrderID ; $b--)
				//echo nl2br(print_r($allebestellungen,true));
				foreach($allebestellungen as $diesebestellung){

					$Summe = $diesebestellung[1]-$diesebestellung[4];

					//echo nl2br(print_r($diesebestellung[4],true)); 
					?>

					
					<div class="w3-card w3-light-green w3-padding-16" style="width:40%; "><?php echo " <b>Bestellnummer: $diesebestellung[0]</b> " ?></div>
					<table class="w3-table w3-border" style="width:40%"><tr class="w3-light-green">
						
						<th>Name</th><th>Anzahl</th><th>Preis</th></tr>

					
					<?php
					
					
					$bestelltepizzen = $diesebestellung[5];
					//echo nl2br(print_r($bestelltepizzen,true)); 
					foreach($bestelltepizzen as $pizza){
						$pizzaname = $pizza['Name'];
						$pizzapreis = $pizza['Preis'];
						
						
						echo "<tr>
				            <td>$pizzaname</td>
				            <td>$anzahl</td>
				            <td>$pizzapreis &euro;</td>  
				            </tr>";
			    
					}
					echo"<tr><td></td><td></td><td></td></tr>";
        			echo "<tr><td>Summe:</td><td></td><td>$Summe €<td></tr>"; 
        			
        			echo "<tr><td>Versand:</td><td></td><td>$diesebestellung[4] &euro;<td></tr>";
           			echo "<hr>";
        			echo "<tr><td>Gesamtsumme:</td><td></td><td>$diesebestellung[1] &euro;<td></tr>";
					echo "</table><br> ";

					

					
				echo "<form  method='post' >
						<button type='submit' name='nochmal' class='w3-button w3-light-green w3-small' value='$diesebestellung[0]' style='width: 40%'>Diese Bestellung erneut aufgeben</button>		
						</form>
						<br><hr>";

					
					if(isset($_POST['nochmal'])) {
						$cart -> undo_cart();
						$p = $_POST['nochmal'];
						echo "P: $p";
						$pizzenofchosenorder = mysqli_query($db, "SELECT Name, Preis FROM alreadyordered
							WHERE UserID = (SELECT UserID FROM mp_users WHERE Email='$email') AND OrderID='$p'");
						$ausgewahltepizzen = array();

					
					$bestelltepizzen = array();
					while ($thispizza=mysqli_fetch_assoc($pizzenofchosenorder)) {
						array_push($ausgewahltepizzen,$thispizza);
					}

					



						foreach($ausgewahltepizzen as $thispizza){
							$name = $thispizza['Name'];
							$price = $thispizza['Preis'];
							$getMenuID = mysqli_query($db,"SELECT MenuID FROM mp_menu WHERE Name LIKE '$name'");
							$getMenuID1 = mysqli_fetch_assoc($getMenuID);
							$menuid = $getMenuID1['MenuID'];
							$count = 1;
							$cart -> insertArtikel("$menuid","$name","$count","$price");
						}
						
						
						

						echo "<script type='text/javascript'>";
        echo "window.location.href='versand.php';";
        echo "</script>";
        echo "<noscript>";
        echo "<meta http-equiv='refresh' content='0;url='.$url.'' />";
        echo "</noscript>";        }
					
						
						
						}
			    
					


			


			
		?>

	</div>


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
<?php

mysqli_close($db);

?>