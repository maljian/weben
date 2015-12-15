<?php 
    session_start();
    //delete session array
    session_unset();
    unset($_SESSION);
    // delete session-cookie
    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]
    );
    }
    header("Location: ../index.php"); 
    die("Redirecting to: ../index.php");
?>

