<?php 
# Zugangsdaten
$db_server = 'localhost';
$db_benutzer = 'root';
$db_passwort = '';
$db_name = 'myPizza';

# Verbindungsaufbau
if(mysqli_connect($db_server, $db_benutzer, $db_passwort)) {
echo 'Server-Verbindung erfolgreich, Datenbank erfolgreich ausgewählt.
';
$db = mysqli_connect($db_server, $db_benutzer, $db_passwort);
}
else {
echo 'Verbindung nicht möglich, bitte Daten prüfen!

';
echo 'MYSQL-Fehler: '.mysql_error();
}



?>





