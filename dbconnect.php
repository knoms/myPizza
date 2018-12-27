<?php 
// (Server, Benutzername, PW, DBName)
$db = new mysql_connect("rdbms.strato.de", "U2896074","unter_SLIP_2017", "DB2896074");
echo "string";
$dbtest = new PDO('mysql:host=rdbms.strato.de;dbname=DB2896074', "U2896074", "unter_SLIP_2017");


if(!$dbtest){
	exit("Verbindungsfehler: ".mysqli_connect_error());
} else echo "string";

if(!$db){
	exit("Verbindungsfehler: ".mysql_connect_error());
} else echo "string";
?>

<!DOCTYPE html>
<html>
<head>
	<title>DBTest</title>
</head>
<body>



</body>
</html>

