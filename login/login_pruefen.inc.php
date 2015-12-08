<?php
if (!isset($_SESSION['eingeloggt']))
{
echo "Hallo, Sie haben keinen Zugang hier!<br/>";
echo "<a href=\"test.php\"> Zum Login</a>";
exit();
}
?>