<?php
if (!isset($_SESSION['loggedin']))
{
echo "Hallo, Sie haben keinen Zugang hier!<br/>";
echo "<a href=\"test.php\"> Zum Login</a>";
exit();
}
?>