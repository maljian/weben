<?php
    session_start();
    include("login/login_pruefen_admin.inc.php");
    include("login/header.php");
    $fh = $_SESSION['Name'];

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
        $start = $_POST['start'];
        $end = $_POST['end']; 
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
        if ((empty($start) && empty($end)) && (empty($start) || empty($end))){
           $dateError = "Bitte Start und End Datum eingeben";
           $valid = false;
        }
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
           include 'database.php';
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO studiengang(`id`, `name`, `fh`, `location`, `start`, `end`, `cost`, `text`, `result`, `contact_email`, `type`, `degreeprogram`, `category`) VALUES 
                ('',':name',':fh',':location',':start',':end',':cost',':text',':result',':contactemail',':type',':studigang',':fachbereich')";
                $q = $pdo->prepare($sql);
                $q->bindParam(':name', $title);
                $q->bindParam(':fh', $fh);
                $q->bindParam(':location', $location);
                $q->bindParam(':start', $start);
                $q->bindParam(':end', $end);
                $q->bindParam(':cost', $cost);
                $q->bindParam(':text', $text);
                $q->bindParam(':result', $result);
                $q->bindParam(':contactemail', $contactemail);
                $q->bindParam(':type', $type);
                $q->bindParam(':studigang', $studigang);
                $q->bindParam(':fachbereich', $fachbereich);
                $q->execute();
                Database::disconnect();
                header("Location: myCourse.php");
            /*include "db.inc.php";
            $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
            mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!". mysql_error());

            $abfrage = "INSERT INTO `studiengang`(`id`, `name`, `fh`, `location`, `start`, `end`, `cost`, `text`, `result`, `contact_email`, `type`, `studiengang`, `fachbereich`) VALUES 
                ('','$title','$name','$location','$start','$end','$cost','$text','$result','$contactemail','$type','$studigang','$fachbereich')";
            $ergebnis = mysqli_query($link, $abfrage);
            if (!$ergebnis){
                die('Could not connect: ' . mysql_error());
            }
            mysqli_close($link);
            header("Location: myCourse.php");*/
        }
    }
    
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h2>Neuen Kurs erfassen</h2>
        <form class="form-horizontal" role="form" action="#" method="post">
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
                        <label class="radio-inline"><input type="radio" name="studiform" value="Pr&auml;senzstudium Vollzeit"> Pr&auml;senzstudium Vollzeit</label>
                    </div>
                    <div class="col-sm-2">
                        <label class="radio-inline"><input type="radio" name="studiform" value="Pr&auml;senzstudium Teilzeit"> Pr&auml;senzstudium Teilzeit</label>
                    </div>
                    <div class="col-sm-2">
                        <label class="radio-inline"><input type="radio" name="studiform" value="Fernstudium Vollzeit"> Fernstudium Vollzeit</label>
                    </div>
                    <div class="col-sm-2">
                        <label class="radio-inline"><input type="radio" name="studiform" value="Fernstudium Teilzeit"> Fernstudium Teilzeit</label>
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
            <div class="form-group <?php echo!empty($dateError) ? 'error' : ''; ?>">
                <div class="col-sm-1"></div>
                <div class ="col-sm-6">
                    <label for="start">Von [jjjj-mm-tt]:
                        <div class='input-group'>
                            <input type='text' name='start' class="form-control" value="<?php echo!empty($start) ? $start : ''; ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </label>
                    <label for="end">bis [jjjj-mm-tt]:
                        <div class='input-group date'>
                            <input type='text' name='end' class="form-control" value="<?php echo!empty($end) ? $end : ''; ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </label>
                </div>
                <?php if (!empty($dateError)): ?>
                    <span class="help-inline"><?php echo $dateError; ?></span>
                <?php endif; ?>
            </div>
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
                    <button type="submit" class="btn btn-success" >Erfassen</button>
                    <a class="btn btn-default" href="myCourse.php">Abbrechen</a>
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
