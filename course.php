<?php
    session_start();
    include("login/header.php");
?>
        <!-- Main content -->
        <div class = "col-md-7" id="mainBody">
            <h1>Kurs</h1>
            <p>Tabelle mit allen Kursen einfügen. Diese soll gefiltert werden können und sich somit automatisch updaten.
                <br/> zusätzlich soll per klick auf den Kurstitel eine Detailansicht geöffnet werden.</p>
        </div>
    <?php
        include("login/login_alert.php");
        include ("Layout/login.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>
