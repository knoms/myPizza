<?php
//logout.php
session_start();
session_unset(); 
session_destroy();
            $counter=fopen("UserOnline.txt","r+"); $aufruf=fgets($counter,100);
            $aufruf=$aufruf-1;
            rewind($counter);
            fputs($counter,$aufruf);
            echo $aufruf;
header("location: ../index.php");
?>