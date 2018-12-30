<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=myPizza', 'root', '');
 
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
        
    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="willkommen.html">Konto</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
        header("Location: ../login.html");
    }
    
}