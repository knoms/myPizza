<?php 
session_start();
include("dbconnect.php")

 
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $statement =  = mysqli_query("SELECT * FROM mp_users WHERE Email = '$email'");
   
        
    //Emailadresse bekannt?
    if (mysqli_num_rows($statement)==1) {

            if ($password==$statement['Pw']) {
                header(Location: ../welcome.html);
                
            }
            


    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
        header("Location: ../login.html");
    }
    
}