    <?php
        session_start();
        include ("Layout/header.html");
        include "db.inc.php";
        if (isset($_SESSION['eingeloggt'])){
         if($_SESSION['eingeloggt']==true){
                include ("Layout/nav-loggedin.html");
            }
        }
        else{
            include ("Layout/nav.html");
        }
        // Codeteile von Rainer Telesko aus dem Web-Engineering Modul.
        if (!empty($_POST)) {
            // keep track validation errors
            $titleError = null;
            $emailError = null;
            $locationError = null;
            $dateError = null;
            $costError = null;
            $txtError = null;
            $resultError = null;
            $studigangError = null;
            $fachbereichError = null;
            $next = "course_create.php";

            // keep track post values
            $title = $_POST['title'];
            $location = $_POST['location'];
            //$start = $_POST['start'];
            //$end = $_POST['end']; 
            $cost = $_POST['cost'];
            $text = $_POST['txt'];
            $result = $_POST['result'];
            $contactemail = $_POST['contact'];
            $type = $_POST['studiform'];
            $studigang = $_POST['studigang'];
            $fachbereich = $_POST['fachbereich'];

            // validate input
            $valid = true;
            if (empty($title)) {
                $titleError = 'Bitte Kurstitel eingeben.';
                $valid = false;
            }
            if (empty($location)) {
                $locationError = 'Bitte den Durchführungsort eingeben';
                $valid = false;
            }
            /**if ((empty($start) && empty($end)) && (empty($start) || empty($end))){
               $dateError = "Bitte Start und End Datum eingeben";
               $valid = false;
            }*/
            if (empty($cost)){
                $costError = "Bitte Kurskosten eingeben";
                $valid = false;
            }
            if (empty($text)){
                $txtError = "Bitte Kursbeschreibung eingeben";
                $valid = false;
            }
            if (empty($result)){
                $resultError = "Bitte Resultat eingeben";
                $valid = false;
            }
            if (empty($contactemail)) {
                $emailError = 'Bitte E-Mail Adresse eingeben';
                $valid = false;
            } else if (!filter_var($contactemail, FILTER_VALIDATE_EMAIL)) {
                $emailError = 'Bitte eine valide E-Mail Adresse eingeben';
                $valid = false;
            }
            if (empty($studigang)){
                $studigangError = "Bitte Studiengang eingeben";
                $valid = false;
            }
            if (empty($fachbereich)){
                $fachbereichError = "Bitte Fachbereich eingeben";
                $valid = false;
            }

            // insert data
            if ($valid) {
                include "db.inc.php";
                $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
                mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!". mysql_error());
                
                $abfrage = "INSERT INTO `studiengang`(`id`, `name`, `fh`, `location`, `start`, `end`, `cost`, `text`, `result`, `contact_email`, `type`, `studiengang`, `fachbereich`) VALUES 
                    ('','$title','test','$location','','','$cost','$text','$result','$contactemail','$type','$studigang','$fachbereich')";
                $ergebnis = mysqli_query($link, $abfrage);
                if (!$ergebnis){
                    die('Could not connect: ' . mysql_error());
                }
                mysqli_close($link);
            }
        }
    ?>
        <!-- Main content -->
        <div class = "col-md-7" id="mainBody">
            <h2>Neuen Kurs erfassen</h2>
            <form class="form-horizontal" role="form" action="" method="post">
                <div class="form-group <?php echo!empty($titleError) ? 'error' : ''; ?>">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="name">Kurstitel:</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="title" value="<?php echo!empty($title) ? $title : ''; ?>">
                            <?php if (!empty($titleError)): ?>
                                <span class="help-inline"><?php echo $titleError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group <?php echo!empty($fachbereichError) ? 'error' : ''; ?>" >
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="fachbereich">Fachbereich:</label>
                        <input type="text" class="form-control" name="fachbereich" value="<?php echo!empty($fachbereich) ? $fachbereich : ''; ?>">
                        <?php if (!empty($fachbereichError)): ?>
                            <span class="help-inline"><?php echo $fachbereichError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group <?php echo!empty($studigangError) ? 'error' : ''; ?>">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for="studigang">Studiengang:</label>
                        <input type="text" class="form-control" name="studigang" value="<?php echo!empty($studigang) ? $studigang : ''; ?>">
                        <?php if (!empty($studigangError)): ?>
                            <span class="help-inline"><?php echo $studigangError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>               
                <div class="form-group <?php echo!empty($typeError) ? 'error' : ''; ?>">
                    <div class="radio">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">
                            <label class="radio-inline"><input type="radio" name="studiform" value="presVoll" checked="checked"> Pr&auml;senzstudium Vollzeit</label>
                        </div>
                        <div class="col-sm-2">
                            <label class="radio-inline"><input type="radio" name="studiform" value="presTeil"> Pr&auml;senzstudium Teilzeit</label>
                        </div>
                        <div class="col-sm-2">
                            <label class="radio-inline"><input type="radio" name="studiform" value="fernVoll"> Fernstudium Vollzeit</label>
                        </div>
                        <div class="col-sm-2">
                            <label class="radio-inline"><input type="radio" name="studiform" value="fernTeil"> Fernstudium Teilzeit</label>
                        </div>
                    </div>
                </div>
                <div class="form-group <?php echo!empty($locationError) ? 'error' : ''; ?>">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <label for="location">Ort:</label>
                        <input type="text" class="form-control" name="location" value="<?php echo!empty($location) ? $location : ''; ?>">
                        <?php if (!empty($locationError)): ?>
                            <span class="help-inline"><?php echo $locationError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <!--<div class="form-group <?php echo!empty($dateError) ? 'error' : ''; ?>">
                    <div class="col-sm-1"></div>
                    <div class ="col-sm-6">
                        <label for="start">Von:
                            <div class='input-group' name='start'>
                                <input type='text' class="form-control" value="<?php echo!empty($start) ? $start : ''; ?>"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </label>
                        <label for="end">bis:
                            <div class='input-group date' name='end'>
                                <input type='text' class="form-control" value="<?php echo!empty($end) ? $end : ''; ?>"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </label>
                        <script type="text/javascript">
                            $(function () {
                                $('#start').datetimepicker();
                                $('#end').datetimepicker({
                                    useCurrent: false //Important! See issue #1075
                                });
                                $("#start").on("dp.change", function (e) {
                                    $('#end').data("DateTimePicker").minDate(e.date);
                                });
                                $("#end").on("dp.change", function (e) {
                                    $('#start').data("DateTimePicker").maxDate(e.date);
                                });
                            });
                        </script>
                    </div>
                    <?php if (!empty($dateError)): ?>
                        <span class="help-inline"><?php echo $dateError; ?></span>
                    <?php endif; ?>
                </div>-->
                <div class="form-group <?php echo!empty($costError) ? 'error' : ''; ?>">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <label for="cost">Kosten:</label>
                        <input type="text" class="form-control" name="cost" value="<?php echo!empty($cost) ? $cost : ''; ?>">
                    </div>
                    <?php if (!empty($costError)): ?>
                        <span class="help-inline"><?php echo $costError; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo!empty($emailError) ? 'error' : ''; ?>">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <label for="contact">Kontakt E-Mail:</label>
                        <input type="email" class="form-control" name="contact" value="<?php echo!empty($contactemail) ? $contactemail : ''; ?>">
                    </div>
                    <?php if (!empty($emailError)): ?>
                        <span class="help-inline"><?php echo $emailError; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo!empty($txtError) ? 'error' : ''; ?>">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <label for="txt">Beschreibung:</label>
                        <textarea class="form-control" rows="7" name="txt" value="<?php echo!empty($text) ? $text : ''; ?>"></textarea>
                    </div>
                    <?php if (!empty($txtError)): ?>
                        <span class="help-inline"><?php echo $txtError; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo!empty($resultError) ? 'error' : ''; ?>">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <label for="result">Resultat:</label>
                        <textarea class="form-control" rows="7" name="result" value="<?php echo!empty($result) ? $result : ''; ?>"></textarea>
                    </div>
                    <?php if (!empty($resultError)): ?>
                        <span class="help-inline"><?php echo $resultError; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-default">Erfassen</button>
                        <a class="btn" href="myCourse.php">Abbrechen</a>
                    </div>
                </div>
            </form>
        </div>
    <?php
        include ("login_error.php");
        include ("Layout/sidebar.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>