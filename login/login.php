<?PHP
session_start();


if (isset($_POST['email']) AND isset($_POST['passwort']))
{
 	$email=$_POST['email'];
	$pass=$_POST['passwort']; 
        $pass=md5($pass);

    // Datenbankverbindung
    include "../db.inc.php";
	
    $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
	
	// Check if the username and password exist and return the user's type
        $typeAbfrage = "SELECT `type` FROM `user` WHERE `Email`='$email' and `Passwort`='$pass'";
        $abfrage = "SELECT * FROM `user` WHERE `Email`='$email' and `Passwort`='$pass'";
        $ergebnis = mysqli_query($link, $abfrage) or die("Emailadresse oder Passwort stimmen nicht!");
        $typeData = mysqli_query($link, $typeAbfrage);
        $type = mysqli_fetch_row($typeData);
        $count= mysqli_num_rows($ergebnis);
      
	// Falls passendes Ergebnis in der Datenbank vorhanden, Session loggedin auf true setzen und type auslesen.
 	if ($count == 1) 
	  { 
	  $_SESSION['loggedin']=true;
	  $_SESSION['email']=$email;
          $_SESSION['type']=$type[0];
          //show alert that the login worked
          $_SESSION['message']='login successful';
          header("Location: ../index.php");
	  }
	else
	  {
            $_SESSION['loggedin']=false;
            //show alert that email or password is wrong
            $_SESSION['message']='wrong email or pw';
            header("Location: ../index.php");  
	  }
}
?>