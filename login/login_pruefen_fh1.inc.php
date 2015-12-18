<?php
//checks if user is logged in
if (!isset($_SESSION['loggedin'])){
    $_SESSION['access']="denied";
    header("Location: ../index.php");
    exit();
}
//checks if user has the authorization for this page
if(!$_SESSION['type']=="fh"){
    $_SESSION['access']="denied";
    header("Location: ../index.php");
    exit();
}
?>