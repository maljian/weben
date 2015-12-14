<?php
// Codeteile von Martin Hüsler aus dem Web-Engineering Modul.
// Session starten oder uebernehmen
/*
session_start();

if (isset($_POST['email']) AND ($_POST['email']!=''))
{
  $email = $_POST['email'];

  $chars = ("abcdefghijklmnopqrstuvwxyz1234567890"); 
  $newpwd = 'x'; 
  for ($i = 0; $i < 7; $i++) 
  { 
    $newpwd .= $chars{mt_rand (0,strlen($chars))}; 
  } 
  $passwort = $newpwd;
  $betreff = "Neues Passwort von fh-weiterbildung.ch!";
  $inhalt = "Sehr geehrte Kundin\nSehr geehrter Kunde\n\nHier Ihr neues Passwort: '$passwort'\n
Freundliche Gr&uuml;sse\nIhr FH-Weiterbildungs-Team\nwww.fh-weiterbildung.ch";
  $header = "From: huesler@fh-weiterbildung.ch";
  @mail($email,$betreff,$inhalt,$header);
  
  // Datenbankupdate
  include "db.inc.php";
  $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
  mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
  
  $pass = md5($newpwd);
  echo "Ihr md5-Passwort: ".$pass."<br/>"; // nur zu Testzwecken
  $neupasswort = "UPDATE user SET `Passwort`='$pass' WHERE `Email`='$email'";
  $angepasst = mysqli_query($link,$neupasswort);

  if ($angepasst == TRUE)
	{
	  echo "Das neue Passwort wurde eingetragen!<br/>";
	  echo "Ihr Passwort lautet: ".$newpwd;
	  echo "<br/> <a href=\"test.php\">Login</a><br/>";
      echo "<br/> <a href=\"login-anpassen-form.php\">Passwort anpassen</a><br/>";
	} 
}
else
{
    
}*/
?>

