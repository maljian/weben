<?php
    session_start();
    include("login/header.php");
    
    include 'db.inc.php';
    $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
    $abfrage = "SELECT * FROM fh";
    $ergebnis = mysqli_query($link, $abfrage) or die("Keine Verbindung!");
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h2>Suchen und Finden Sie jetzt den passenden Bachelor- , Master- oder Weiterbildungskurs</h2>
        <form role="form">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ort">Region:</label>
                    <select class="form-control text-center" name="region">
                        <option value=""> --------- Auswahl --------- </option>
                        <option value="Nordwestschweiz">Nordwestschweiz</option>
                        <option value="Zenralschweiz">Zentralschweiz</option>
                        <option value="Ostschweiz">Ostschweiz</option>
                        <option value="Westschweiz">Westschweiz</option>
                        <option value="Raum Z&uuml;rich">Raum Z&uuml;rich</option>
                        <option value="Raum Bern">Raum Bern</option>
                        <option value="Gesamtschweiz">Gesamtschweiz</option>
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
                    <br/>
                    <button type="submit" class="btn btn-default">Suchen</button> 
                </div>
                <div class="col-md-4">
                    <label for="fachbereich">Fachbereich:</label>
                    <select class="form-control text-center" id="fachbereich">
                        <option> --------- Auswahl --------- </option>
                        <option value="Wirtschaft">Wirtschaft</option>
                        <option value="Technik">Technik</option>
                        <option value="Angewandte Psychologie">Angewandte Psychologie</option>
                        <option value="Architektur, Bau und Geomatik">Architektur, Bau und Geomatik</option>
                        <option value="Gestaltung und Kunst">Gestaltung und Kunst</option>
                        <option value="Life Science">Life Science</option>
                        <option value="Musik">Musik</option>
                        <option value="P&auml;dagogik">P&auml;dagogik</option>
                        <option value="Soziale Arbeit">Soziale Arbeit</option>
                    </select>
                    <label for="studiengang">Studium und Weiterbildung:</label>
                    <select class="form-control text-center" id="studiengang">
                        <option> --------- Auswahl --------- </option>
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                        <option value="Weiterbildung">Weiterbildung</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="stform">Studienform:</label>
                    <select class="form-control text-center" id="stform">
                        <option> --------- Auswahl --------- </option>
                        <option value="Pr&auml;senzstudium Vollzeit">Pr&auml;senzstudium Vollzeit</option>
                        <option value="Pr&auml;senzstudium Teilzeit">Pr&auml;senzstudium Teilzeit</option>
                        <option value="Fernstudium Vollzeit">Fernstudium Vollzeit</option>
                        <option value="Fernstudium Teilzeit">Fernstudium Teilzeit</option>
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
