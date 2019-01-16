<?php
 session_start();
 include ('php/dbconnect.php');
 include_once ('php/cart.php');
//include('php/mailcontent.php');
 require "phpmailer/PHPMailerAutoload.php";

//echo nl2br(print_r($_SESSION,true)); // Nur zu Debugzwecken, kann auskommentiert werden



//echo "Order: $_POST['order']";
 $eingeloggt=false;
 if (isset($_SESSION['login'])) {
 	if($_SESSION['login']==1){
 	$eingeloggt=true;
    $email = $_SESSION['email'];
    $checkifordered = mysqli_query($db, "SELECT OrderID FROM        alreadyordered
                            WHERE UserID = (SELECT UserID FROM mp_users WHERE Email='$email')");
         if(mysqli_num_rows($checkifordered)!==0){
            $orderedbefore=true;#
         }
         else $orderedbefore=false;
		}
 }

 if($eingeloggt==false){
 	header('Location: index.php');
 }


 //get Warenkorb 
$cart = new cart();


$cart->initial_cart(); 


$email = $_SESSION['email'];
$summe = $_SESSION['Gesamt'];
$Vk = $_SESSION['versand'];
$Artikelanzahl = $cart->get_cart_count();
$Versand = $_SESSION['versand'];

if(isset($_POST['order'])&&($Artikelanzahl!==0)){

 //echo "Login = $eingeloggt"; 	// Nur zu Debugzwecken, kann auskommentiert werden


$Array = $_SESSION['cart'];

  		for($i = 0 ; $i < count($Array); $i++)
        {
            $innerArray = $Array[$i];
            
            /* echo "<tr>
           
            <td>$innerArray[1]</td>
            <td>$innerArray[2]</td>
            <td>$innerArray[3]€</td>
            </tr>";*/
        }
//

$date = date('Y-m-d H:i:s');
//echo "<br>Datum: $date<br>";
$readUser = mysqli_query($db,"SELECT * FROM mp_users WHERE Email LIKE '$email'");
$result = mysqli_fetch_assoc($readUser);
$name = $result['Vorname'];
//echo "Name: $name<br>";
$UserID = $result['UserID'];
//echo "UserID: $UserID<br>";



//Bestellung in die DB schreiben



///////IN DB schreiben/////////////////////////////////////////////////////////////////////////////////
$writeneworder = "INSERT INTO mp_orders (UserID, Time, Artikelanzahl, Preis, Vk) VALUES ('$UserID', '$date', '$Artikelanzahl', '$summe', '$Vk')";
$Array = $_SESSION['cart'];
if(mysqli_query($db , $writeneworder)) {
	//echo "Bestellung in DB abgelegt<br>";
	$readOrderID = mysqli_query($db,"SELECT * FROM mp_orders WHERE Time = '$date'");
$resultOrderID = mysqli_fetch_assoc($readOrderID);
$OrderID = $resultOrderID['OrderID'];
 //echo "OrderID: $OrderID<br>";
	for($i = 0 ; $i < count($Array); $i++)
        {
            $innerArray = $Array[$i];
            $MenuID = $innerArray[0];
            //Gericht aus Warenkorb in die DB schreiben
            //echo "Gericht $i: $MenuID<br>";

			$writenewdish = "INSERT INTO mp_ordered_dishes(MenuID, OrderID) VALUES('$MenuID','$OrderID')";
            mysqli_query($db,$writenewdish);
        }
} 
////////////////////////////////////////////////////////////////////////////////////////////////////////////


 ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>Deine Bestellung bei MyPizza</title>

    <link href="styleSchrift.css" type="text/css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
          <a href='php/logout.php' class='w3-bar-item w3-button w3-right'>Logout</a><?php if($orderedbefore){ ?>
          <a href='letzteBestellungen.php' class='w3-bar-item w3-button w3-right'>Letzte Bestellungen</a> <?php } ?>
          <a href="warenkorb.php" class="w3-bar-item w3-button w3-right"><i class="../w3-large fa fa-shopping-cart"></i></a>
        </div>
    </header>
	<div class='w3-container w3-center'>
		<div class='w3-panel w3-border-top w3-border-bottom w3-light-green'>
  			<h2 style='color: white;'>- Deine Bestellung - </h2>
		</div>
	</div>

	<div class='w3-container'>
		<div class='w3-container w3-card-4'>
			<br>

			Hallo <b><?php echo $name;?>, </b><br><br>

			herzlichen Dank für deine Bestellung. <br>
            Einen Guten Appetit wünscht dir <br><br>
            Dein <b>MyPizza</b> Team. <br><br>
            
            <b>Bestellübersicht:</b><br>
            Kundennummer: <?php echo "$UserID" ?><br>
            Bestellungsnummer: <?php echo "$OrderID" ?><br>
            Bestelleingang: <?php echo "$date"; ?><br><br>

			
            <br>

			<table class='w3-container w3-table' style='width:50%; height: 30%; float: left'>
		
		<thead>
  			<tr class='w3-light-green'>

    				
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
            <td>$innerArray[3]&euro;</td>
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
            echo "<hr>";
        	echo "<tr><td>Gesamtsumme:</td><td></td><td>$Gesamtsumme €<td></tr>";
        
       		}


		?>
	</table>
    <br><br><br>
    <?php
    ////////////////MAIL VERSAND////////////////////////////////////////////////////////////////////////////////
            $readvorname = mysqli_query($db,"SELECT Vorname from mp_users WHERE Email LIKE '$email'");
            
             $vorname = mysqli_fetch_assoc($readvorname);
            $name= $vorname['Vorname'];
            $mail = new PHPMailer;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';
            // use
            // $mail->Host = gethostbyname('smtp.gmail.com');
            // if your network does not support SMTP over IPv6
            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;
            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = "service.mypizza@gmail.com";
            //Password to use for SMTP authentication
            $mail->Password = "mypizza123";
            //Set who the message is to be sent from
            $mail->setFrom('service.mypizza@gmail.com', 'MyPizza Service');
            //Set an alternative reply-to address
            $mail->addReplyTo('service.mypizza@gmail.com', 'MyPizza Service');
            //Set who the message is to be sent to
            $mail->addAddress('fraguns1@web.de', 'John Doe');


            $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            $mail->isHTML(true);                                  // Set email format to HTML

            
            $body = "<b>Hallo $name, </b><br><br>
            herzlichen Dank f&uumlr deine Bestellung. <br>
            Dein Auftrag ist bei uns um $date eingegangen und deine Pizza ist schon so gut wie im Ofen. <br>
            <br>
            Einen Guten Appetit w&uumlnscht dir <br><br>
            Dein <b>MyPizza</b> Team. <br><br>
            

            <b>Deine Bestellung: </b><br>
            <table  style='width:0%; float: left'>
        
        <thead>
            <tr>

                    
                    <th>Name</th>
                    <th>Anzahl</th>
                    <th>Preis</th>
            </tr>

        </thead>



            ";

           for($i = 0 ; $i < count($Array); $i++)
        {
            $innerArray = $Array[$i];
            
            $body.= "<tr>
   
            <td>$innerArray[1]</td>
            <td>$innerArray[2]x</td>
            <td>$innerArray[3]&euro;</td>
            </tr>";
        }      
            $Gesamtsumme = $Summe+$Versand;   
            $body.= "<tr><td></td><td></td><td></td></tr>
            <tr><td>Summe:</td><td></td><td>$Summe &euro;<td></tr><tr><td>Versand:</td><td></td><td>$Versand &euro;<td></tr><hr><tr><td>Gesamtsumme:</td><td></td><td>$Gesamtsumme &euro;<td></tr>";
            

            $mail->Subject = 'Deine Bestellung bei MyPizza';
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                $cart -> undo_cart();
            }
            $cart -> undo_cart();
            unset($_SESSION['versand']); 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		?>
	</div>
    <footer class="w3-container w3-dark-gry w3-padding-32 w3-margin-top">
    <!-- Fußleiste -->
    <div class="w3-bar w3-light-green" style="">
      <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
      <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>
      <span class="w3-bar-item w3-right">User online: <span class="w3-tag" id="container">0</span> <p></span>
    </div>
</footer>
</body>
</html>


<?php


mysqli_close($db);
} else {
  mysqli_close($db);
  header('Location: speisekarte.php');
}
?>