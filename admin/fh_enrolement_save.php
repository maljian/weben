<!-- Abspreicherung in Datenbank angelehnt an login_erf.php aus der Vorlesung mit Herr Hüsler
<?php
session_start();

if (isset($_POST['institution']) AND isset($_POST['partner']) AND isset($_POST['street']) AND isset($_POST['postalcode']) AND isset($_POST['city']) AND isset($_POST['website']) AND isset($_POST['email']) AND isset($_POST['phonenumber']))
{
        $institution = $_POST['institution'];
        $partner = $_POST['partner'];
        $street = $_POST['street'];
        $postalcode = $_POST['postalcode'];
        $city = $_POST['city'];
        $website = $_POST['website'];
 	$email=$_POST['email'];
        $phonenumber = $_POST['phonenumber'];

    // Datenbankverbindung
        include "../db.inc.php";
        $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
        mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
    
    // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
        mysql_set_charset('utf8');
	
    // Prüfen ob die FH bereits registriert ist, anhand der Emailadresse.
        $abfrage = "SELECT * FROM `fh` WHERE `email`='$email'";
        $ergebnis = mysqli_query($link, $abfrage);
        
        $count= mysqli_num_rows($ergebnis);
        
        if($count == 0){
            date_default_timezone_set("Europe/Berlin");
            $timestamp = time();
            $date = date("Y.m.d",$timestamp);
            //Daten in die Überprüfungsdatenbank fh_enrolement speichern, da FH noch nicht vorhanden.
            $insert= "INSERT into `fh_enrolement`(`institution`,`partner`,`street`,`postalcode`,`city`,`website`,`email`,`phonenumber`,`date`) VALUES('$institution','$partner','$street','$postalcode','$city','$website','$email','$phonenumber','$date')";
            mysqli_query($link, $insert) or die("DB-Eintrag hat nicht geklappt!");
            $_SESSION['message'] = 'Anmeldung erfolgreich';
        }
        
    // Datenbankverbindung beenden
        mysqli_close($link);      
        header("Location: ../fh_enrolement.php");
}
?>
