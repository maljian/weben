<?php
    header("Content-Type: text/html; charset=utf-8");
   
    include 'db.inc.php';
    $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
            mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!". mysql_error());
    $query = "SELECT * from fh where email = " . $_GET["inst"];
    $res = mysqli_query($link, $query);
    $dsatz = mysqli_fetch_assoc($res);
    
    echo "<?xml version='1.0' encoding='utf-8'?>\n";
    echo "<daten>\n";
    echo "<pa>" . $dsatz["partner"] . "</pa>\n";
    echo "<em>" . $dsatz["email"] . "</em>\n";
    echo "</daten>\n";
    
?>

