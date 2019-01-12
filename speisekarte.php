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


 	echo "Login = $eingeloggt"; 	// Nur zu Debugzwecken, kann auskommentiert werden


	$cart = new cart();


	$cart->initial_cart(); 

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

  	<!-- LISTE SPEISEKARTE; man muss eine ADD FKT. MIT DB ERSTELLEN -->
  	<div class="w3-panel w3-container w3-animate-left">
  	
  	<div class="w3-container w3-center">
		<div class="w3-panel w3-border-top w3-border-bottom">
  			<h2>Speisekarte</h2>
		</div>
	</div> 

  	<div class="w3-container">
  		<?php  
		  		$db = mysqli_connect($db_server, $db_benutzer, $db_passwort, $db_name);
		  		$sql = "SELECT Preis FROM mp_menu WHERE Name='Pizza Margherita';";
		  		$preis=array();
		  		$ergebnis = mysqli_query($db, $sql);
		  		$row = mysqli_fetch_object($ergebnis);
		  		array_push($preis,$row->Preis);
  		?>
	  <ul class="w3-ul w3-card-4">
	    <li class="w3-bar">
	    	<form method="post"> 
			      <button type="submit" name="button" id="1" value="Pizza Margherita" class="w3-btn w3-light-green w3-border w3-round-large w3-right"><?php echo $row->Preis?> € | <i class="w3-large fa fa-shopping-cart"></i></button>  
			      <div class="w3-bar-item">
			        <span class="w3-large">Pizza Mageritha</span><br>
			        <span>Mit Tomate, Mozarella und Edamer</span>
			      </div> 
		    </form>
	    </li>

	    <?php  
		  		$sql = "SELECT Preis FROM mp_menu WHERE Name='Pizza Salami';";
		  		$preis=array();
		  		$ergebnis = mysqli_query($db, $sql);
		  		$row = mysqli_fetch_object($ergebnis);
		  		array_push($preis,$row->Preis);
  		?>
	    <li class="w3-bar">
	    	<form method="post"> 
			      <button type="submit" name="button" value="Pizza Salami" class="w3-btn w3-light-green w3-border w3-round-large w3-right"><?php echo $row->Preis?> € | <i class="w3-large fa fa-shopping-cart"></i></button>  
			      <div class="w3-bar-item">
			        <span class="w3-large">Pizza Salami</span><br>
			        <span>Mit Tomatensoße, Edamer und Salami</span>
			      </div>
			</form>
	    </li>

	    <?php  
		  		$sql = "SELECT Preis FROM mp_menu WHERE Name='Pizza Champignon';";
		  		$preis=array();
		  		$ergebnis = mysqli_query($db, $sql);
		  		$row = mysqli_fetch_object($ergebnis);
		  		array_push($preis,$row->Preis);
  		?>
	    <li class="w3-bar">
	    	<form method="post"> 
			      <button type="submit" name="button" value="Pizza Champignon" class="w3-btn w3-light-green w3-border w3-round-large w3-right"><?php echo $row->Preis?> € | <i class="w3-large fa fa-shopping-cart"></i></button>  
			      <div class="w3-bar-item">
			        <span class="w3-large">Pizza Champignon</span><br>
			        <span>Mit Tomatensoße, Edamer und Chamignon</span>
			      </div>
			</form>
	    </li>

	    <?php  
		  		$sql = "SELECT Preis FROM mp_menu WHERE Name='Pizza Paprika';";
		  		$preis=array();
		  		$ergebnis = mysqli_query($db, $sql);
		  		$row = mysqli_fetch_object($ergebnis);
		  		array_push($preis,$row->Preis);
  		?>
	    <li class="w3-bar">
	    	<form method="post"> 
			      <button type="submit" name="button" value="Pizza Paprika" class="w3-btn w3-light-green w3-border w3-round-large w3-right"><?php echo $row->Preis?> € | <i class="w3-large fa fa-shopping-cart"></i></button>  
		      <div class="w3-bar-item">
		        <span class="w3-large">Pizza Paprika</span><br>
		        <span>Mit Tomatensoße, Edamer, Oliven, Zwiebeln und Paprika</span>
		      </div>
		  	</form>
	    </li>

	    <?php  
		  		$sql = "SELECT Preis FROM mp_menu WHERE Name='Pizza Peperoni Speciale';";
		  		$preis=array();
		  		$ergebnis = mysqli_query($db, $sql);
		  		$row = mysqli_fetch_object($ergebnis);
		  		array_push($preis,$row->Preis);
  		?>
	    <li class="w3-bar">
	    	<form method="post"> 
			      <button type="submit" name="button" value="Pizza Peperoni Speciale" class="w3-btn w3-light-green w3-border w3-round-large w3-right"><?php echo $row->Preis?> € | <i class="w3-large fa fa-shopping-cart"></i></button>  
		      <div class="w3-bar-item">
		        <span class="w3-large">Pizza Peperoni Speciale</span><br>
		        <span>Mit Tomatensoße, Edamer, Oliven und Peperoniwurst</span>
		      </div>
		    </form>
	    </li>

	    <?php  
		  		$sql = "SELECT Preis FROM mp_menu WHERE Name='Pizza Ruccola';";
		  		$preis=array();
		  		$ergebnis = mysqli_query($db, $sql);
		  		$row = mysqli_fetch_object($ergebnis);
		  		array_push($preis,$row->Preis);
  		?>
	    <li class="w3-bar">
	    	<form method="post">
			      <button type="submit" name="button" value="Pizza Ruccola" class="w3-btn w3-light-green w3-border w3-round-large w3-right"><?php echo $row->Preis?> € | <i class="w3-large fa fa-shopping-cart"></i></button> 
			   

		      	<div class="w3-bar-item">

		        <span class="w3-large">Pizza Ruccola</span><br>
		        <span>Mit Tomatensoße, Mozzarella und Ruccola</span>

		      </div>
		    </form>
	    </li>

	  </ul>
	</div>
</div>


<script>
function dropdown() {
  var x = document.getElementById("Demo");
  if (x.className.indexOf("w3-show") == -1) {  
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>


<?php
	
 	 	if($eingeloggt==true){
			if(isset($_POST['button'])){

				//if($eingeloggt==false)
				//$db = mysqli_connect('localhost', 'root', '', 'myPizza');

				$pizza = $_POST['button'];
				$email = $_SESSION['email'];
				$anzahl = "1";

				/*$sql1 = "INSERT INTO mp_orders (UserID, Time, Artikelanzahl, Preis, Vk) VALUES 
						((SELECT UserID FROM mp_users WHERE Email='$email'), CURRENT_TIMESTAMP, '$anzahl', 
						(SELECT Preis FROM mp_menu WHERE Name='$pizza'), (SELECT Preis FROM mp_menu WHERE Name='$pizza'))"; */
				/*$sql2 = "INSERT INTO mp_ordered_dishes (MenuID, OrderID) VALUES 
						((SELECT MenuID FROM mp_menu WHERE Name='$pizza'),
						(SELECT OrderID FROM mp_orders WHERE Time = CURRENT_TIMESTAMP))"; */

				/*$sql3 = "INSERT INTO mp_shopping_cart (UserID, MenuID, Time) VALUES 
						((SELECT UserID FROM mp_users WHERE Email='$email'),
						(SELECT MenuID FROM mp_menu WHERE Name='$pizza'),
						CURRENT_TIMESTAMP)"; */

				$sql1 = mysqli_query($db,"SELECT MenuID FROM mp_menu WHERE Name LIKE '$pizza'");
  			
  			 	$res1 = mysqli_fetch_assoc($sql1);

  			 	$MenuID= $res1["MenuID"];

  			 	echo "Name: $Name";


  			 	$sql2 = mysqli_query($db,"SELECT Preis FROM mp_menu WHERE Name LIKE '$pizza'");

  			 	$res2 = mysqli_fetch_assoc($sql2);	

  			 	$Preis= $res2["Preis"];

  			 	echo "Preis: $Preis";
  			
  			 		


				
				$cart -> insertArtikel($MenuID, "$pizza", "$Anzahl", $Preis);

				//mysqli_query($db, $sql3);
				//mysqli_query($db, $sql1);
				//mysqli_query($db, $sql2);
				echo '<meta http-equiv=refresh content="0; url=warenkorb.php">';
			}
		}


		elseif($eingeloggt==false)
		{
			if(isset($_POST['button'])){
				echo '<meta http-equiv=refresh content="0; url=login.php">';
			}
		}


?>

<footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green" style="">
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

	</div>
</footer>

</body>

</html>