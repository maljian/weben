<html>
<head>
<title>Login-anpassen-Formular</title>
<link rel="stylesheet" type="text/css" href="css.inc.css">
</head>
<body>
<?php
// Session starten oder übernehmen
session_start();
if ($_SESSION['loggedin']== true)
{
$email = $_SESSION['email'];

// Datenbankverbindung
include "db.inc.php";
$link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
 
$abfrage="SELECT * from `user` where `Email`='$email'";
$result = mysqli_query($link,$abfrage) or die("Abfrage falsch");  
$count = @mysql_num_rows($result);

        while ($zeile=mysqli_fetch_assoc($result))
        {    
            while (list($key, $value)=each($zeile))
            {
                if ($key=='user_name'){$name=$value;}    
            } 
        } 

  if ($count <= 1)
  {
  ?>
  <h1> Passwort anpassen</h1>
  <form action="login_erf.php" method="POST">
  	<input type="hidden" name="vonwo" value="anpassen"/>
	<input type="hidden" name="email" value="<?php echo $email; ?>"/>
	E-Mail-Adresse (Ihr Benutzername): <?php echo $email; ?> <br/>
	<input type="text" name="benutzername" value="<?php echo $name; ?>" size="40" /> Name<br/>
    <input type="password" name="passwort1" value="" size="40" /> Passwort neu <br/>
	<input type="password" name="passwort2" value="" size="40" /> Passwort neu (Kontrolle)<br/>
    <input type="submit" name="anpassen" value="anpassen" /><input type="reset" value="nochmals" />
  </form> 
  <?php
  }
  else
  {
  echo "Benutzername ist unbekannt - wenden Sie sich an den Administrator!";
  }  
}
else
{
header("Location:test.php");
}
?>
</body>
</html>