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

 //get Warenkorb 
$cart = new cart();


$cart->initial_cart(); 

$email = $_SESSION['email'];
$summe = $_SESSION['Gesamt'];
$Vk = $_SESSION['versand'];
$Artikelanzahl = $cart->get_cart_count();


 echo "Login = $eingeloggt"; 	// Nur zu Debugzwecken, kann auskommentiert werden



$Array = $_SESSION['cart'];

  		for($i = 0 ; $i < count($Array); $i++)
        {
            $innerArray = $Array[$i];
            
            echo "<tr>
           
            <td>$innerArray[1]</td>
            <td>$innerArray[2]</td>
            <td>$innerArray[3]€</td>
            </tr>";
        }
//

$date = date('Y-m-d H:i:s');
echo "<br>Datum: $date<br>";
$readUser = mysqli_query($db,"SELECT * FROM mp_users WHERE Email LIKE '$email'");
$result = mysqli_fetch_assoc($readUser);
$name = $result['Vorname'];
echo "Name: $name<br>";
$UserID = $result['UserID'];
echo "UserID: $UserID<br>";
//$newOrder = mysqli_query($db,"INSERT INTO mp_orders ('OrderID', 'UserID', 'Time', 'Artikelanzahl', 'Preis', 'Vk') VALUES ('$UserID','$date', '$Artikelanzahl', '$summe', '$Vk')");
$newOrder = "INSERT INTO mp_orders (UserID, Time, Artikelanzahl, Preis, Vk) VALUES ('$UserID', '$date', '$Artikelanzahl', '$summe', '$Vk')";



if(mysqli_query($db , $newOrder)) {
	echo "schreibt";
}



 ?>
<!DOCTYPE html>
<html>
<head>
	<link href="styleSchrift.css" type="text/css" rel="stylesheet">

	<title>Deine Bestellung bei MyPizza</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="w3-container w3-center">
		<div class="w3-panel w3-border-top w3-border-bottom w3-light-green">
  			<h2 style="color: white;">- Deine Bestellung - </h2>
		</div>
	</div>

	<div class="w3-container">
		<div class="w3-container w3-card-4">
			<br>

			<b>Hallo <?php echo $name;?>, </b><br><br>

			herzlichen Dank für deine Bestellung. <br>
			Dein Auftrag ist bei uns um <?php echo "$date"; ?> eingegangen. <br>
			<hr>

			<b>Deine Bestellung: </b><br>

			<table>
				<tr>

			    				
			    				<th>Artikelname</th>
			    				<th>Anzahl</th>
			    				<th>Preis</th>
			  			</tr>
			</table>

			<br><br>

			Summe:			<br>
			Versand:		<br><hr>
			Gesamtsumme:	<br><hr>

			Einen Guten Appetit, <br>
			wünscht dir dein <b>MyPizza</b> Lieferdienst. <br>
			Lass es dir schmecken! <br><br>
		</div>
	</div>
</body>
</html>