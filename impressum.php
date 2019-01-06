<?php
 session_start();
 include ("php/dbconnect.php");

echo nl2br(print_r($_SESSION,true)); // Nur zu Debugzwecken, kann auskommentiert werden

 $eingeloggt=false;
 if (isset($_SESSION['login'])) {
 	if($_SESSION["login"]==1){
 	$eingeloggt=true;
		}
 }


 echo "Login = $eingeloggt"; 	// Nur zu Debugzwecken, kann auskommentiert werden

 ?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<title>MyPizza, Impressum</title>


	<link href="styleSchrift.css" type="text/css" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

<body>

	<!-- NAVIGATIONS BEREICH -->
	<header class="w3-container w3-padding-32">
		<div class="w3-bar w3-light-grey">
		  <span class="w3-bar-item w3-light-green">My Pizza</span>
		  <a href="index.php" class="w3-bar-item w3-button">Home</a>
		  <a href="speisekarte.php" class="w3-bar-item w3-button">Speisekarte</a>
		  <a href="ueberUns.php" class="w3-bar-item w3-button">Über uns</a>
		  <a href="login.php" class="w3-bar-item w3-button w3-right">Login</a>
		</div>
	</header>


	    <div class="w3-container w3-animate-left">

	    <div class="w3-container w3-center">
			<div class="w3-panel w3-border-top w3-border-bottom">
  				<h2>Impressum</h2>
			</div>
		</div> 
			<!--
	      	<div class="w3-panel w3-sand">
	      		<p><b>Angaben gem. § 5 TMG:<br></b>
			     	Liana Birt, Noah Mautner, Lena Schumacher<br>
			      	Hochschule Reutlingen<br>
			      	Alteburgstraße 150<br>
			      	72762 Reutlingen<br></p>
			     <p><b>Kontaktaufnahme:<br></b>
			      	Telefon: 01578 1234767<br>
			      	E-Mail: mypizza@gmx.de</p>
			</div>

	      		<div class="w3-panel w3-border-top w3-border-bottom w3-border-green">
	      		<p><b>Umsatzsteuer-ID</b><br>
	      			Umsatzsteuer-Identifikationsnummer gem. § 27 a Umsatzsteuergesetz:<br>
	      			DE XXX XXX XXX<br>
	      		</p>
	      	</div>

	      	<div class="w3-panel w3-border-top w3-border-bottom w3-border-green">
	      		<p><b>Haftungsausschluss - Disclaimer:</b><br>
	      			Haftung für Inhalte:<br>
	      			Alle Inhalte unseres Internetauftritts wurden mit größter Sorgfalt und nach bestem Gewissen erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte können wir jedoch keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt.<br>Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntniserlangung einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von den o.g. Rechtsverletzungen werden wir diese Inhalte unverzüglich entfernen.<br>
	      		
	      			<br>
	      			Haftung für Inhalte:<br>
	      			Unsere Webseite enthält Links auf externe Webseiten Dritter. Auf die Inhalte dieser direkt oder indirekt verlinkten Webseiten haben wir keinen Einfluss. Daher können wir für die „externen Links“ auch keine Gewähr auf Richtigkeit der Inhalte übernehmen. Für die Inhalte der externen Links sind die jeweilige Anbieter oder Betreiber (Urheber) der Seiten verantwortlich.
	      			<br>
					Die externen Links wurden zum Zeitpunkt der Linksetzung auf eventuelle Rechtsverstöße überprüft und waren im Zeitpunkt der Linksetzung frei von rechtswidrigen Inhalten. Eine ständige inhaltliche Überprüfung der externen Links ist ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht möglich. Bei direkten oder indirekten Verlinkungen auf die Webseiten Dritter, die außerhalb unseres Verantwortungsbereichs liegen, würde eine Haftungsverpflichtung ausschließlich in dem Fall nur bestehen, wenn wir von den Inhalten Kenntnis erlangen und es uns technisch möglich und zumutbar wäre, die Nutzung im Falle rechtswidriger Inhalte zu verhindern.
					<br>
					Diese Haftungsausschlusserklärung gilt auch innerhalb des eigenen Internetauftrittes „Name Ihrer Domain“ gesetzten Links und Verweise von Fragestellern, Blogeinträgern, Gästen des Diskussionsforums. Für illegale, fehlerhafte oder unvollständige Inhalte und insbesondere für Schäden, die aus der Nutzung oder Nichtnutzung solcherart dargestellten Informationen entstehen, haftet allein der Diensteanbieter der Seite, auf welche verwiesen wurde, nicht derjenige, der über Links auf die jeweilige Veröffentlichung lediglich verweist.
					<br>
					Werden uns Rechtsverletzungen bekannt, werden die externen Links durch uns unverzüglich entfernt.<br>
					<br>
					Urheberrecht:<br>
	      			Die auf unserer Webseite veröffentlichen Inhalte und Werke unterliegen dem deutschen Urheberrecht (<a href="http://www.gesetze-im-internet.de/bundesrecht/urhg/gesamt.pdf"><u>http://www.gesetze-im-internet.de/bundesrecht/urhg/gesamt.pdf</u></a>) . Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung des geistigen Eigentums in ideeller und materieller Sicht des Urhebers außerhalb der Grenzen des Urheberrechtes bedürfen der vorherigen schriftlichen Zustimmung des jeweiligen Urhebers i.S.d. Urhebergesetzes (<a href="http://www.gesetze-im-internet.de/bundesrecht/urhg/gesamt.pdf"><u>http://www.gesetze-im-internet.de/bundesrecht/urhg/gesamt.pdf</u></a> ). Downloads und Kopien dieser Seite sind nur für den privaten und nicht kommerziellen Gebrauch erlaubt. Sind die Inhalte auf unserer Webseite nicht von uns erstellt wurden, sind die Urheberrechte Dritter zu beachten. Die Inhalte Dritter werden als solche kenntlich gemacht. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte unverzüglich entfernen.
	      			<br>
					Dieses Impressum wurde freundlicherweise von www.jurarat.de zur Verfügung gestellt.<br>
	      			
	      		</p>
	      	</div>
	      </p>

	    </div> -->

	    <div class="w3-container">

	  <ul class="w3-ul w3-card-4">
	    <li class="w3-bar">
	      <div class="w3-bar-item">
	        <p><b>Angaben gem. § 5 TMG:<br></b>
			     	Liana Birt, Noah Mautner, Lena Schumacher<br>
			      	Hochschule Reutlingen<br>
			      	Alteburgstraße 150<br>
			      	72762 Reutlingen<br></p>
			     <p><b>Kontaktaufnahme:<br></b>
			      	Telefon: 01578 1234767<br>
			      	E-Mail: mypizza@gmx.de</p>
	     </div>
	    </li>

	    <li class="w3-bar">
	      <div class="w3-bar-item">
	        <p><b>Umsatzsteuer-ID</b><br>
	      			Umsatzsteuer-Identifikationsnummer gem. § 27 a Umsatzsteuergesetz:<br>
	      			DE XXX XXX XXX<br>
	      	</p>
	     </div>
	    </li>

	    <li class="w3-bar">
	      <div class="w3-bar-item">
	        <p><b>Haftungsausschluss - Disclaimer:</b><br>
	      			Haftung für Inhalte:<br>
	      			Alle Inhalte unseres Internetauftritts wurden mit größter Sorgfalt und nach bestem Gewissen erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte können wir jedoch keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt.<br>Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntniserlangung einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von den o.g. Rechtsverletzungen werden wir diese Inhalte unverzüglich entfernen.<br>
	     </div>
	    </li>

	  </ul>
</div>
</div>


	<footer class="w3-container w3-padding-32 w3-margin-top">
		<!-- Fußleiste -->
		<div class="w3-bar w3-light-green" style="">
		  <a href="impressum.php" class="w3-bar-item w3-button">Impressum</a>
		  <a href="kontaktformular.php" class="w3-bar-item w3-button">Kontaktformular</a>
		</div>
	</footer>

</body>

</html>