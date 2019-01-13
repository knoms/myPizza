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
$Artikelanzahl = $cart->get_cart_count();





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
     body, a:hover, button:hover {cursor: url(pizza.cur), default;}
  </style>

	<script type="text/javascript"></script>

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
	  <a href="php/logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
	  <a href='letzteBestellungen.php' class='w3-bar-item w3-button w3-right'>Letzte Bestellungen</a>
	  <a href="warenkorb.php" class="w3-bar-item w3-button w3-right"><i class="../w3-large fa fa-shopping-cart"></i></a>
	</div>
</header>

	<div class="w3-container w3-center">
		<div class="w3-panel w3-border-top w3-border-bottom">
  			<h2>Warenkorb</h2>
		</div>
	</div>

	<div class="w3-container"><br>
		<table class="w3-table w3-border">
		
		<thead>
  			<tr class="w3-light-green ">

    				
    				<th>Name</th>
    				<th>Anzahl</th>
    				<th>Preis</th>
  			</tr>

  		</thead>
  		<?php
  		$Array = $_SESSION['cart'];
      if($Artikelanzahl==0) 
      echo "<tr>
      <td> Hier könnte </td>
      <td> deine Pizza </td>
      <td> liegen.</td>
      </tr>";
      else{
  		for($i = 0 ; $i < count($Array); $i++)
        {
            $innerArray = $Array[$i];
            
            echo "<tr>
           
            <td>$innerArray[1]</td>
            <td>$innerArray[2]</td>
            <td>$innerArray[3]€</td>
            </tr>";
        }

}

        ?>

		</table>

		<br>

		<?php
			$Summe = 0;
			
			for($i = 0 ; $i < count($Array); $i++)
        {
        	 $innerArray = $Array[$i];
        	$Summe+= $innerArray[3];

        }

        	if($Summe!=0){
        	echo "Summe: $Summe €<br>"; 
       		}
        	
       		



		?>
		<br><br><br>


		<form action="speisekarte.php">
			<button class="w3-button w3-dark-grey w3-small">Zurück zur Speisekarte und weitere Pizzen bestellen</button>	
		</form>
		<form method="post">

				<button type="submit" name="empty" class="w3-button w3-dark-grey w3-small" >Warenkorb leeren</button>

				<?php if(isset($_POST['empty'])) {
				 	$cart -> undo_cart();
					//header('Location: warenkorb.php');
          ?>
            <script type="text/javascript">javascript:location.reload()</script>
          <?php
          if(isset($_SESSION['Gesamt'])){ 
            $_SESSION['Gesamt']=0;
          }
          
				 	}
				?>

        

				<button class="w3-button w3-light-green w3-small" type="submit" name="proceed">Weiter</button>
				<?php if(isset($_POST['proceed'])) {
          if($Artikelanzahl==0){
            ?> <script type="text/javascript">alert("Ohne Pizza gehts nicht weiter");</script> <?php
          }else{
					 echo '<script type="text/javascript">';
        echo 'window.location.href="versand.php";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';        }
				 	}
				?>


				

		</form>

	

	
<footer class="w3-container w3-padding-32 w3-margin-top">
	<!-- Fußleiste -->
	<div class="w3-bar w3-light-green">
	  <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
	  <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>

	  <span class="w3-bar-item w3-right">User online: <span class="w3-tag" id="container">0</span> <p></span>

</footer>

</div>

</body>

</html>