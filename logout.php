<?php 

    //Session wird beendet (Quelle: http://untame.net/2013/06/how-to-build-a-functional-login-form-with-php-twitter-bootstrap/)
    include "db.inc.php";
    unset($_SESSION['user']);
    header("Location: Layout.html"); 
    die("Redirecting to: Layout.html");
?>

