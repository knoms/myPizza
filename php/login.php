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
    $password = $_POST['password'];
    
    $sql = mysqli_query($db,"SELECT * from mp_users WHERE Email LIKE '$email' AND Pw LIKE '$password' LIMIT 1");
   
   	//$sql = "SELECT * from mp_users WHERE Email LIKE '{$email}' AND Pw LIKE '{$password}' LIMIT 1";
    //$result = $db->query($sql);   

    

    //Emailadresse bekannt?
    if (mysqli_num_rows($sql) == 1) {
    		
            header("Location: ../welcome.html");
    }
    else 
    {
    	   header("Location: ../login2.html");
    }
    
}
$db->close();

?>