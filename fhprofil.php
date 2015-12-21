<?php
    session_start();
    include("login/header.php");
?>
    <!-- Main content -->
    <!-- Source based on http://www.w3schools.com/php/php_ajax_database.asp -->
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
                    <label for="region">Region:</label>
                    <select class="form-control text-center" name="region" onchange="showFh(this.value)">
                        <option value=""> --------- Auswahl --------- </option>
                        <option value="Nordwestschweiz">Nordwestschweiz</option>
                        <option value="Zentralschweiz">Zentralschweiz</option>
                        <option value="Ostschweiz">Ostschweiz</option>
                        <option value="Westschweiz">Westschweiz</option>
                        <option value="Raum Zuerich">Raum Z&uuml;rich</option>
                        <option value="Raum Bern">Raum Bern</option>
                        <option value="Tessin">Tessin</option>
                        <option value="Gesamtschweiz">Gesamtschweiz</option>
                    </select>
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
                </div>
                <br/>
                <br/>
                <br/>
            </div>
        </form>
        <div id="txtHint" class="form-group">
            <br/>
            <p>Die gefilterten Fachhochschulen werden hier angezeigt werden.</p>
        </div>
    </div>
    <?php
        include ("login/login_alert.php");
        include ("Layout/login.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>
