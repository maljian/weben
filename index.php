<?php
    session_start();
    include("login/header.php");
    
    include 'db.inc.php';
    $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
    $abfrage = "SELECT * FROM fh";
    $ergebnis = mysqli_query($link, $abfrage) or die("Keine Verbindung!");
    $abfrage2 = "SELECT * FROM fh";
    $ergebnis2 = mysqli_query($link, $abfrage2) or die("Keine Verbindung!");
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h2>Suchen und Finden Sie jetzt den passenden Bachelor- , Master- oder Weiterbildungskurs</h2>
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
                    <label for="fh">Fachhochschule:</label>
                    <select class="form-control text-center" id="fh">
                        <option> --------- Auswahl --------- </option>
                        <?php 
                            while ($row = mysqli_fetch_array($ergebnis)) {
                                echo $row['institution'];
                            echo '<option value="'.$row['institution'].'">'.$row['institution'].'</option>';
                         }
                         ?>
                    </select>
                    <?php
                        /**<label for="bachelor">Bachelorstudiengang:</label>
                        <select class="form-control text-center" id="bachelor">
                            <option> --------- Auswahl --------- </option>
                            <option>Wirtschaftsinformatik</option>
                            <option>Betriebs&ouml;konomie</option>
                            <option>International Management</option>
                            <option>International Business Management</option>
                        </select>
                        <label for="weiterb">Weiterbildung:</label>
                        <select class="form-control text-center" id="weiterb">
                            <option> --------- Auswahl --------- </option>
                            <option>Wirtschaftsinformatik und E-Business</option>
                            <option>Human Resource Management</option>
                        </select>
                        <label for="master">Masterstudiengang:</label>
                        <select class="form-control text-center" id="master">
                            <option> --------- Auswahl --------- </option>
                            <option>International Management</option>
                            <option>Business Information Systems</option>
                        </select>*/
                    ?>
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
                    <label for="studiengang">Studiengang:</label>
                    <select class="form-control text-center" id="studiengang">
                        <option> --------- Auswahl --------- </option>
                        <option>Bachelor</option>
                        <option>Master</option>
                        <option>Weiterbildung</option>
                    </select>
                </div>
                <div class="col-md-4">
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
        include ("login/login_alert.php");
        include ("Layout/login.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>
