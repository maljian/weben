<?php
    session_start();
    include("login/header.php");
?>
    <!-- Main content -->
    <!-- Copyright T. Theis: Einstieg in PHP 5.6 und MySQL 5.6, Galileo Computing, 2015 -->
        <script type="text/javascript"> 
            var rq;

            function anfordern(institution){
                rq = new XMLHttpRequest();
                rq.open("get", "ajax_db_fh.php?institution=" + institution, true);
                rq.setRequestHeader("ContentType", "application/x-www-form-urlencoded");
                rq.onreadystatechange = auswerten;
                rq.send();
            }

            function auswerten(e)
            {
                if (rq.readyState == 4 && rq.status == 200){
                    var antwort = e.target.responseXML;
                    document.getElementById("idpartner").firstChild.nodeValue = 
                            antwort.getElementByTagName("pa")[0].firstChild.nodeValue;
                    document.getElementById("idemail").firstChild.nodeValue = 
                            antwort.getElementByTagName("em")[0].firstChild.nodeValue;
                }
            }
        </script>
    <div class = "col-md-7" id="mainBody">
        <h1>FHNW</h1>
        
        <p>
            <?php
                include 'db.inc.php';
                $con = mysqli_connect($passwort,$user);
                mysqli_select_db($con, $dbname);
                $query = "SELECT * from fh order by institution";
                $res = mysqli_query($con, $query);
                while ($dsatz = mysqli_fetch_assoc($res))
                        echo "<a href='javascript:anfordern("
                        .$dsatz["institution"]. ")'>"
                        .$dsatz["website"]. ", ".$dsatz["city"]."</a><br/>";
                    mysqli_close($con);
            ?>
        </p>
        <p><span id="idpartner">$nbsp;</span>
            <span id="idemail">&nbsp;</span></p>
        
        
        <form role="form">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ort">Region:</label>
                    <select class="form-control text-center" id="ort">
                        <option> --------- Auswahl --------- </option>
                        <option>Nordwestschweiz</option>
                        <option>Zentralschweiz</option>
                        <option>Ostschweiz</option>
                        <option>Westschweiz</option>
                        <option>Raum Z&uuml;rich</option>
                        <option>Raum Bern</option>
                        <option>Gesamtschweiz</option>
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
            <div class="form-group">
                <div class="col-sm-2">
                    <br/>
                    <button type="submit" class="btn btn-default">Filtern</button>
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
