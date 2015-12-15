<?php
    session_start();
    include("login/login_pruefen_admin.inc.php");
    include("login/header.php");
?>

<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h1>FH Anmeldungen</h1>
    <br/>
    <p>
        Hier sollte eine Liste mit allen FH-Anmeldungen entstehen...
    </p>

</div>

<?php
include ("login/login_alert.php");
include ("Layout/login.html");
include ("Layout/ads.html");
include ("Layout/footer.html");
?>
</html>
