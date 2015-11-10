<?PHP
session_start();
?>

<html>
<head>
<title>Login</title>
</head>
<body>

<?PHP

if (isset($_POST['email']) AND isset($_POST['passwort']))
{
 	$email=$_POST['email'];
	$pass=$_POST['passwort']; 
        $pass=md5($pass);

    // Datenbankverbindung
    include "db.inc.php";
	
    $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
	
	// prüfen ob es User und Passwort gibt
        $abfrage = "SELECT * FROM `users` WHERE `email`='$email' and `password`='$pass'";
        $ergebnis = mysqli_query($link, $abfrage) or die("Email oder Passwort stimmen nicht!");
        
        $count= mysqli_num_rows($ergebnis);
        
      
	// Ihr Code mysqli_query --> Ihre Abfrage!
	
	
 	if ($count == 1) 
	  { 
	  $_SESSION['eingeloggt']=true;
	  $_SESSION['email']=$email;
	  echo "Herzlich willkommen im Loginbereich!<br/>";
	  echo "Ihre Session-ID: ".session_id();
	  echo "<br/><a href=\"login_b.php\"> Hier gehts zu den geheimen Daten</a>";
	  echo "<br/><a href=\"login-anpassen-form.php\"> Passwort anpassen </a>";
	  }
	else
	  {
	  $_SESSION['eingeloggt']=false;
	  header("Location:test.php");
	  // echo "Login nicht geklappt";
	  }
}
?>

</body>
</html>