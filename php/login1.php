<?php



session_start();

include("dbconnect.php");

$pdo = new PDO('mysql:host=localhost;dbname= myPizza', root, '');

$gefunden = false;

$User_email = $_POST["email"];
$User_password = $_POST["password"];

$db_users = "SELECT * FROM mp_users";

foreach ($pdo->query($db_users) as $row) {
	   	
		if($User_email==$row['email']){
			if ($User_password==$row['Pw']) {
				$gefunden=true;

				$_SESSION["login"]=1;
				$_SESSION["email"]=$row['email'];
				break;
				# code...
			}
		}


	}

	if($gefunden){
		alert ("Login erfolgreich, du wirst weitergeleitet.")
		header("Location: ../index.html");
	}
	else{
		header("Location: ../login.html");
		wrongPw();
	}

	function wrongPw(){
		alert("Benutzerkennung oder Passwort nicht korrekt");
	}






?>