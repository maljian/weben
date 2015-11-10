<html>
<head>
<link rel="stylesheet" type="text/css" href="css.inc.css">
</head>
<body>
<?PHP
session_start();
include 'login_pruefen.inc.php';

echo "Herzlich willkommen<br/>Sehr geehrter Kunde mit E-Mail: ".$_SESSION['email'];
echo "<br/> Hier alle aktuellen Gesundheitsdaten von....<br/>";

echo "<font>Ihre Session-ID: ".session_id()."</font>";
echo "<br/><a href=\"login-anpassen-form.php\"> Passwort anpassen </a>";
echo "<br/><a href=\"test.php\"> logout</a>";

?>
</body>
</html>
