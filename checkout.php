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
if($cartsize==0){
	header('Location: warenkorb.php');
}






if(isset($_POST['versand'])){
	$_SESSION['versand']=$_POST['versand'];

}
$Versand = $_SESSION['versand'];




echo "Versand = $Versand";

echo "<br>POST:<br>";
echo nl2br(print_r($_POST,true));


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
     body, a:hover, button:hover {cursor: url(pizza.cur), default;}
  </style>
	<script language="JavaScript" type="text/javascript">

  			function checkForm()
  				{	
            alert("tut");
   			 	
      			if (document.getElementById("credit").checked==true){
      				var cardname = document.bezahlung.cardname.value;
      				var cardnumber = document.bezahlung.cardnumber.value;
      				var expmonth = document.bezahlung.expmonth.value;
      				if(cardname ="" || cardnumber = "" || expmonth = ""){
      					alert ("Bitte vervollständige deine Zahlungsdaten");
      					return false;
      				}
      			}
      			else if (document.getElementById("cash").checked) {
      				return true;
      			}
      			
      			else {
      				alert("Bitte wähle eine Zahlungsmethode");
      				return false;
      			}
    			}
	</script>

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


	
		

	<div class="w3-container w3-card-4 w3-light-grey w3-text-black w3-margin" style="width: 50%; float: left ">
		<form onsubmit="checkForm()" name="bezahlung" action="order.php" method="post" >
			
			
  				<h3>Zahlungsmethode wählen</h2>
  					

                <div class="w3-panel w3-gray w3-border ">
                  <span onclick="this.parentElement.style.display='none'"
                  class="w3-button w3-large w3-display-topright">&times;</span>
                  <p>Kreditkartenzahlung vorrübergehend deaktiviert. Nur Barzahlung möglich.</p>
                </div> 
              
    					<input type="radio" id="credit" name="Zahlungsmethode" value="credit" required="required" disabled>
    					<label for="credit">Kreditkarte</label>
              				<i class="fa fa-cc-visa" style="color:navy;"></i>
              				<i class="fa fa-cc-amex" style="color:blue;"></i>
              				<i class="fa fa-cc-mastercard" style="color:red;"></i>
              				<i class="fa fa-cc-discover" style="color:orange;"></i>
            				<br><br>

            			
    					<label for="cname">Karteninhaber:</label>
            			<input type="text" id="cname" name="cardname" placeholder="Paul Pizzamann" disabled><br><label for="ccnum">Kartennummer:</label>
            			<input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" disabled><br><label for="expmonth">Gültig bis:</label>
            			<input type="text" id="expmonth" name="expmonth" placeholder="01/21" disabled>
            		
            			<br><br>

    					<input type="radio" id="cash" name="Zahlungsmethode" value="cash" required="required" checked="checked">
    					
    					<label for="cash">Barzahlung</label><br><br>

    					<button onclick="history.go(-1);return true;" class="w3-button w3-light-green w3-small">Zurück</button>

    					<button onclick="javascript: return checkForm();" class="w3-button w3-light-green w3-small" type="submit" name="order" >Bestellen</button>
    					
    					<br><br>
    					
  					
			
				
		</form>
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
    <span class="w3-bar-item w3-right">User online: <span class="w3-tag" id="container">0</span> <p></span>
	</div>
</footer>

</div>

</body>

</html>
<?php

mysqli_close($db);

?>