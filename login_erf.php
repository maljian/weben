<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title> Login Daten erfassen</title>
		<link rel="stylesheet" type="text/css" href="css.inc.css">
	<script type="text/javascript">
	function mySubmit() 
	{
	if(document.formular.benutzername.value == "") {
    alert("Bitte tragen Sie Ihren Benutzernamen (Kontaktperson) ein!");
    document.formular.benutzername.focus();
    return false;
 
 
 
 // Ihr JavaScript-Code --> Passwortlänge ...
 
 
 
 
 
 
 
 
 
 
	}
    </script> 
    </head>
    <body>
<?php
// Session starten oder neu aufnehmen
session_start();

if (isset($_POST['erfassen']) OR isset($_POST['anpassen']))
{
		
  if (isset($_POST['email']) AND isset($_POST['passwort1']))
  {
  $vonwo = $_POST["vonwo"];
  $email = $_POST["email"];
  $benutzername = $_POST["benutzername"];
  $type =$_POST["type"];
  $passwort1 = $_POST["passwort1"];
  $passwort2 = $_POST["passwort2"];
  $pass = md5($passwort1);

    if (($passwort1 == $passwort2) && (strlen($passwort1) >= 8))
    {
    // Datenbankverbindung
    include "db.inc.php";
	$link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");

    // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
    mysql_set_charset('utf8');
	
	// falls vom Formular anpassen 
    if ($vonwo == "anpassen")      
    { 
      $anpassung = "UPDATE `user` SET `Name`='$benutzername', `Passwort`='$pass' WHERE `Email`='$email'";
      $angepasst = mysqli_query($link,$anpassung);
      if ($angepasst == TRUE)
	  {
	    echo "Die Daten wurden angepasst<br/>";
	    echo "Ihre Session_id ist:".session_id();
        echo "<br/> <a href=\"login_c.php\">Zu den geheimen Daten</a>";
	    echo "<br/> <a href=\"index.php\">Logout</a>";
	    $_SESSION['name']=$email;
        $_SESSION['eingeloggt']= true;
	  }
    } 
	
    // falls vom Formular "Neues Login" 
    if ($vonwo == "erfassung")
    {
    // prüfen ob email bereits vorhanden
    $abfrage="SELECT Email FROM `user` WHERE Email='$email'";
	$ergebnis=mysqli_query($link,$abfrage) or die("Abfrage hat nicht geklappt!");
	$count=mysqli_num_rows($ergebnis);
	
	if ($count == 1) 
	  { echo "<font>Diese E-Mail-Adresse wurde bereits erfasst!</font>";}
	else
	  {
	// Benutzer erfassen, weil noch nicht in DB vorhanden
            $insert= "INSERT into `user`(`Name`,`Email`,`Passwort`,`Type`) VALUES('$benutzername','$email','$pass','$type')";
            mysqli_query($link, $insert) or die("DB-Eintrag hat nicht geklappt!");
            echo "<font>Daten wurden erfasst!!</font><br/>";
	// Ihr Code DB-Insert
            echo "<font>Daten wurden erfasst!!</font><br/>";
	  }
	}
    // Datenbankverbindung beenden
    mysqli_close($link);  	    
	} // end if passwörter gleich und länger als 8 Zeichen
  } // end if isset email, passwort1
}  // end if isset $submit
?>	
        <h1> Neue Login-Daten erfassen</h1>	
        <form name="formular" onsubmit="return mySubmit()" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
		  	<input type="hidden" name="vonwo" value="erfassung"/>	
			<input type="text" name="benutzername" value="" size="40" /> Benutzername<br/>
            <input type="text" name="email" value="" size="40" /> E-Mail-Adresse<br/>
            <input type="password" name="passwort1" value="" size="40" /> Passwort <br/>
			<input type="password" name="passwort2" value="" size="40" /> Passwort (Kontrolle)<br/>
                        <input type="radio" name="type" value="admin"> Admin
                        <input type="radio" naem="type" value="fh" checked> Fachhochschule            
                        <input type="submit" name="erfassen" value="erfassen" />
			<input type="reset" value="nochmals" />
        </form><br/>
		
		<a href="login-reset-form.php">Passwort vergessen?</a><br/>
		<a href="test.php">Login</a><br/>
    </body>
</html>