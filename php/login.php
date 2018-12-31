<?php 
session_start();
include("dbconnect.php");
$db = mysqli_connect('localhost', 'root', '', 'mypizza');

 
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $statement = mysqli_query($db, "SELECT Pw FROM mp_users WHERE Email = '$email'");
   
        
    //Emailadresse bekannt?
    if (mysqli_num_rows($statement)==1) {

            if ($password==$statement) {
              header("Location: ../welcome.html");

                
            }
            

    }
    else 
    {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
        header("Location: ../login.html");
    }
    
}

?>