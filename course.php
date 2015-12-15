<?php
    include("login/header.php");
?>
        <!-- Main content -->
        <div class = "col-md-7" id="mainBody">
            <h1>Kurs</h1>
            <form role="form">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ort">Region:</label>
                    <select class="form-control text-center" id="ort">
                        <option> --------- Auswahl --------- </option>
                        <option>Nordwestschweiz</option>
                        <option>Zentralschweiz</option>
                        <option>Raum Z&uuml;rich</option>
                        <option>Raum Bern</option>
                    </select>
                    <label for="studiengang">Studiengang:</label>
                    <select class="form-control text-center" id="studiengang">
                        <option> --------- Auswahl --------- </option>
                        <option>Bachelor</option>
                        <option>Master</option>
                        <option>Weiterbildung</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="fachbereich">Fachbereich:</label>
                    <select class="form-control text-center" id="fachbereich">
                        <option> --------- Auswahl --------- </option>
                        <option>Wirtschaft</option>
                        <option>Technik</option>
                        <option>Angewandte Psychologie</option>
                        <option>Architektur, Bau und Geomatik</option>
                        <option>Gestaltung und Kunst</option>
                        <option>Life Science</option>
                        <option>Musik</option>
                        <option>P&auml;dagogik</option>
                        <option>Soziale Arbeit</option>
                    </select>
                    <label for="stform">Studienform:</label>
                    <select class="form-control text-center" id="stform">
                        <option> --------- Auswahl --------- </option>
                        <option>Pr&auml;senzstudium Vollzeit</option>
                        <option>Pr&auml;senzstudium Teilzeit</option>
                        <option>Fernstudium Vollzeit</option>
                        <option>Fernstudium Teilzeit</option>
                    </select>
                </div>
            </div>
        </form>
        </div>
    <?php
        include("login/login_alert.php");
        include ("Layout/login.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>
