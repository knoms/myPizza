<?php 
session_start();
//include("dbconnect.php");
$db = mysqli_connect('localhost', 'root', '', 'myPizza');



//Verbindung zur Datenbank?
if ($db->connect_errno) {
        echo "<p>MySQL error no {$db->connect_errno} : {$db->connect_error}</p>";
        exit();
    }
 
 //Submitbutton gedrückt -->
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    
    $sql = mysqli_query($db,"SELECT * from mp_users WHERE Email LIKE '$email' AND Pw LIKE '$password' LIMIT 1");
   
   	//$sql = "SELECT * from mp_users WHERE Email LIKE '{$email}' AND Pw LIKE '{$password}' LIMIT 1";
    //$result = $db->query($sql);   

    

    //Emailadresse bekannt?
    if (mysqli_num_rows($sql) == 1) {

            $_SESSION["email"] = $email;
            $_SESSION["login"] = 1;
            $_SESSION["Gesamt"]= 0;
        


            if(!file_exists("UserOnline.txt")){fopen("UserOnline.txt", "a" );}
            $counter=fopen("UserOnline.txt","r+"); $aufruf=fgets($counter,100);
            $aufruf=$aufruf+1;
            rewind($counter);
            fputs($counter,$aufruf);
            echo $aufruf;



    		//Anmeldung erfolgreich
            header("Location: welcome.php");
    }
    else 
    {   
            //Email oder Passwort falsch
            header("Location: ../login.php?error=1");

    }
    
}
$db->close();

?>