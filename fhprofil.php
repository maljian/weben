<?php
    session_start();
    include("login/header.php");
?>
    <!-- Main content -->
    <script>
        function showFh(str) {
          if (str=="") {
            document.getElementById("txtHint").innerHTML="";
            return;
          }
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
              document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
          }
          xmlhttp.open("GET","ajax_db_fh.php?q="+str,true);
          xmlhttp.send();
        }
    </script>
    <div class = "col-md-7" id="mainBody">
        <h1>FHNW</h1>      
        <form role="form">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ort">Region:</label>
                    <select class="form-control text-center" name="region" onchange="showFh(this.value)">
                        <option value=""> --------- Auswahl --------- </option>
                        <option value="Nordwestschweiz">Nordwestschweiz</option>
                        <option value="Zenralschweiz">Zentralschweiz</option>
                        <option value="Ostschweiz">Ostschweiz</option>
                        <option value="Westschweiz">Westschweiz</option>
                        <option value="Raum Z&uuml;rich">Raum Z&uuml;rich</option>
                        <option value="Raum Bern">Raum Bern</option>
                        <option value="Gesamtschweiz">Gesamtschweiz</option>
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
<!--            <div class="form-group">
                <div class="col-sm-2">
                    <br/>
                    <button type="submit" class="btn btn-default">Filtern</button>
                </div>
            </div>-->
        </form>
        <div id="txtHint" class="form-group">
            <br/>
            <p>FH info will be listed here.</p>
        </div>
    </div>
    <?php
        include ("login/login_alert.php");
        include ("Layout/login.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>
