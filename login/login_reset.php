<?php
// Codeteile von Martin Hüsler aus dem Web-Engineering Modul.
// Session starten oder uebernehmen

session_start();

if (isset($_POST['resetEmail']) AND ($_POST['resetEmail']!=''))
{
    $email = $_POST['resetEmail'];
    
    //Database connection
    include "../db.inc.php";
    $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
    
    // Check if emailadress exists in the database
    $query = "SELECT * from user WHERE `Email`='$email'";
    $result = mysqli_query($link, $query);
    $emailExists = mysqli_num_rows($result);
    if($emailExists == TRUE){
        //Create new password
        $chars = ("abcdefghijklmnopqrstuvwxyz1234567890"); 
        $newpwd = ''; 
        for ($i = 0; $i < 8; $i++) 
        { 
            $newpwd .= $chars{mt_rand (0,strlen($chars))}; 
        } 
        $passwort = $newpwd;
        $betreff = "Neues Passwort vom FH-Portal!";
        $inhalt = "Sehr geehrte Kundin\nSehr geehrter Kunde\n\nHier Ihr neues Passwort: '$passwort'\n
        Freundliche Grüsse\nIhr FH-Portal-Team\nwww.fh-portal.ch";
        $header = "From: admin@fh-portal.ch";
        @mail($email,$betreff,$inhalt,$header);
  
        // Datenbankupdate
        $pass = md5($newpwd);
        $neupasswort = "UPDATE user SET `Passwort`='$pass' WHERE `Email`='$email'";
        $angepasst = mysqli_query($link,$neupasswort);

        if($angepasst == TRUE)
	{
        $_SESSION['pwReset'] = 'successful';
        header("Location: ../index.php");
	}
    }    
    else{
      $_SESSION['pwReset'] = 'failed';
      header("Location: ../index.php");
    } 
}
else
{
    header("Location: ../index.php");
}
?>

