<?php
    session_start();
    include("login/header.php");
?>
    <!-- Main content -->
    <script>
        function showFh() {
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
          var url="dd.php";
            var reg_id=document.getElementById('region').value;
            var fach_id=document.getElementById('fachbereich').value;
            url=url+"?reg="+reg_id;
            url=url+"&fach="+fach_id);
            httpxml.onreadystatechange=stateck;
            //alert(url);
            httpxml.open("GET",url,true);
          xmlhttp.send();
        }
    </script>
    <div class = "col-md-7" id="mainBody">
        <h1>FHNW</h1>      
        <form role="form" action="">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ort">Region:</label>
                    <select class="form-control text-center" id="region" onchange="showFh()">
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
                    <select class="form-control text-center" id="fachbereich"onchange="showFh()">
                        <option value=""> --------- Auswahl --------- </option>
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
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <br/>
                    <button type="submit" class="btn btn-default">Filtern</button>
                </div>
            </div>
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
