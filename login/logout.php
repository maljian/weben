<?php 
    session_start();
    //Session wird beendet (Quelle: http://untame.net/2013/06/how-to-build-a-functional-login-form-with-php-twitter-bootstrap/)
    include "../db.inc.php";
    unset($_SESSION['eingeloggt']);
    header("Location: ../index.php"); 
    die("Redirecting to: ../index.php");
?>

