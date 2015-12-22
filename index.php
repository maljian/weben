<?php
    session_start();
    include("login/header.php");
?>
    <!-- Main content -->
    <script>
        function showChoice(reg,col,deg) {
            if (col == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","ajax_db_course.php?reg="+reg+"&col="+col+"&deg="+deg,true);
                xmlhttp.send();
            }
        }

        $(document).ready(function()
        {
            $('.course').change(function()
            {
                var col=$('#college').val();
                var deg=$('#degree').val();
                var reg=$('#region').val();
                showChoice(reg,col,deg);

            })

        });
    </script>
    <div class = "col-md-7" id="mainBody">
        <h2>Suchen und Finden Sie jetzt den passenden Bachelor- , Master- oder Weiterbildungskurs</h2>
        <form role="form">
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ort">Region:</label>
                    <select class=" course form-control text-center" id="region">
                        <option value="0">Auswahl</option>
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
                    <select class="course form-control text-center" id="college">
                        <option value="0">Auswahl</option>
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
                <div class="col-md-4">
                    <label for="studiengang">Studium und Weiterbildung:</label>
                    <select class=" course form-control text-center" id="degree">
                        <option value="0">Auswahl</option>
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                        <option value="Weiterbildung">Weiterbildung</option>
                    </select>
                    <br/>
                </div>
            </div>
        </form>
        <div id="txtHint" class="form-group">
            <br/>
            <p>Die gefilterten Kurse werden Ihnen hier angezeigt.</p>
        </div>
    </div>
    
    <?php
        include ("login/login_alert.php");
        include ("Layout/login.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>
