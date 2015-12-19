<?php
//Abspeicherung in Datenbank angelehnt an login_erf.php aus der Vorlesung mit Herr Hüsler
session_start();

if (isset($_POST))
{
        $institution = $_POST['institution'];
        $partner = $_POST['partner'];
        $street = $_POST['street'];
        $postalcode = $_POST['postalcode'];
        $city = $_POST['city'];
        $website = $_POST['website'];
 	$email=$_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $region = $_POST['region'];
        

    // Datenbankverbindung
        include "../db.inc.php";
        $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
        mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
    
    // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
        mysqli_set_charset($link,'utf8');
	
    // Prüfen ob die FH bereits registriert ist, anhand der Emailadresse.
        $abfrage = "SELECT * FROM `fh` WHERE `email`='$email'";
        $ergebnis = mysqli_query($link, $abfrage);
        
        $count= mysqli_num_rows($ergebnis);
        
        if($count == 0){
            $_SESSION['enrolementMessage']= 'already exists';
            header("Location: ../fh_enrolement.php");
        }
        date_default_timezone_set("Europe/Berlin");
            $timestamp = time();
            $date = date("Y.m.d",$timestamp);
            $status = 'open';
            
        //Daten in die Überprüfungsdatenbank fh_enrolement speichern, da FH noch nicht vorhanden.
            $insert= "INSERT into `fh_enrolement`(`institution`,`partner`,`street`,`postalcode`,`city`,`website`,`email`,`phonenumber`,`region`,`date`,`status`) VALUES('$institution','$partner','$street','$postalcode','$city','$website','$email','$phonenumber','$region','$date','$status')";
            mysqli_query($link, $insert) or die("DB entry failed!");
            $_SESSION['enrolementMessage'] = 'successful';
        // Datenbankverbindung beenden
        mysqli_close($link);  
        header("Location: ../fh_enrolement.php");
}
else{
    $_SESSION['enrolementMessage'] = 'failed';
    header("Location: ../fh_enrolement.php");
}
?>