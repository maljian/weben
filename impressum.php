<?php
    session_start();
    include("login/header.php");
?>

<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h1>Impressum</h1>
    <br/>
    <p>
        Web-Engineering Projekt<br/>
        S.K&auml;sermann, N.Racine und J.Ruppen <br/>
        BSc Wirtschaftsinformatik (WIVZ 3.51) HS15 <br/>
        FHNW Hochschule f&uuml;r Wirtschaft<br/>
        Riggenbachstrasse 16<br/>
        4600 Olten <br/>
    </p>

</div>

<?php
include ("login/login_alert.php");
include ("Layout/login.html");
include ("Layout/ads.html");
include ("Layout/footer.html");
?>
</html>
