<?php
    header("Content-Type: text/html; charset=utf-8");
   
    include 'db.inc.php';
    $con = mysqli_connect("localhost", $benutzer, $passwort);
    mysqli_select_db($con, $dbname);
    $query = "SELECT * from fh where institution = " . $_GET["institution"];
    $res = mysqli_query($con, $query);
    $dsatz = mysqli_fetch_assoc($res);
    
    echo "<?xml version='1.0' encoding='utf-8'?>\n";
    echo "<daten>\n";
    echo "<pa>" . $dsatz["partner"] . "</pa>\n";
    echo "<em>" . $dsatz["email"] . "</em>\n";
    echo "</daten>\n";
?>

