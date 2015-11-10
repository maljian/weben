<html>
<head>
<title>Login-A (index)</title>
</head>
<body>

<?PHP
session_start();

// Session beenden 
// damit können wir diese Seite als "Logout" verwenden
session_unset();
session_destroy();
unset($_SESSION); // Session-Array löschen
// Session-Cookie löschen 
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]
    );
}

?>
<form action="login.php" method="POST">
<input type="text" name="email" value="" size="40" /> E-Mail <br/>
<input type="password" name="passwort" value="" size="40" /> Passwort <br/>
<input type="submit" name="submit" value="einloggen" />
<input type="reset" value="nochmals" />
</form><br/>
<a href="login_erf.php">Login erfassen </a><br/>
<a href="login-reset-form.php">Passwort vergessen?</a><br/>
</body>
</html>

