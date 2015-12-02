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
	
	// Prüfen ob es User und Passwort gibt
        $abfrage = "SELECT * FROM `user` WHERE `Email`='$email' and `Passwort`='$pass'";
        $ergebnis = mysqli_query($link, $abfrage) or die("Emailadresse oder Passwort stimmen nicht!");
        
        $count= mysqli_num_rows($ergebnis);
        
      
	// Ihr Code mysqli_query --> Ihre Abfrage!
	
 	if ($count == 1) 
	  { 
	  $_SESSION['eingeloggt']=true;
	  $_SESSION['email']=$email;
          header("Location:index.php");
	  }
	else
	  {
            $_SESSION['eingeloggt']=false;
            //Fehlermeldung ausgeben
            $_SESSION['message'] = 'Falsche Emailadresse oder Passwort!';
            header("Location:index.php");  
	  }
}
?>  
</body>
</html>