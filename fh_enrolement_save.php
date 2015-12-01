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
    include "db.inc.php";
	
    $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
	
	// Prüfen ob es User bereits gibt
        $abfrage = "SELECT * FROM `fh` WHERE `Email`='$email'";
        $ergebnis = mysqli_query($link, $abfrage);
        
        $count= mysqli_num_rows($ergebnis);
        
        if($count == 0){
            //Daten in die Überprüfungsdatenbank fh_enrolement speichern.
        }
        
     
}
?>
