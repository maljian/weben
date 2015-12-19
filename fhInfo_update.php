<?php
    session_start();
    include("login/header.php");
    include("login/login_pruefen_fh.inc.php");
   
    $email = $_SESSION['email'];
    
    require 'database.php';
    if ( !empty($_GET['email'])) {
            $email = $_REQUEST['email'];
    }
    if ( null==$email ) {
		header("Location: index.php");
	}

// Codeteile von Rainer Telesko aus dem Web-Engineering Modul.
    if (!empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $locationError = null;
        $linkError = null;
        $contactError = null;

        // keep track post values
        $location = $_POST['location'];
        $link = $_POST['link'];
        $tel = $_POST['tel'];
        $person = $_POST['person'];
        $col = $_POST['college'];
        foreach($col as $fach) {
            $fach = implode(';', $fach);
            echo $fach;
        }
        $college = $fach;

        // validate input
        $valid = true;
        if (empty($location)) {
            $locationError = 'Bitte Standort(e) der Fachhochschule eingeben.';
            $valid = false;
        }
        if ((empty($tel)) || (empty($person))) {
            $contactError = 'Bitte Kontaktdaten der Fachhochschule eingeben.';
            $valid = false;
        }
        /*if (empty($college)){
            $collegeError = 'Bitte mindestens einen Fachbereich auswählen.';
            $valid = false;
        }*/

        // update data
        if ($valid) {    
            echo "bin drin!";
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE fh set site = ?, website = ?, partner = ?, phonenumber = ? WHERE email = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($location,$link,$person,$tel,$email));
            echo 'query wurde ausgeführt!';
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        echo "bin draussen!";
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM fh where email = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($email));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['institution'];
        $location = $data['site'];
        $link = $data['website'];
        $person = $data['partner'];
        $tel = $data['phonenumber'];
        $college = $data['college'];
            
        Database::disconnect();
    }
?>
<!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h2>FH Profil bearbeiten</h2>
        <form class="form-horizontal" role="form" action="fhInfo_update.php?email=<?php echo $email?>" method="post">
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="name">Name:</label>
                    <p><?php echo $name ?></p>
                </div>
            </div>
            <div class="form-group <?php echo!empty($locationError) ? 'error' : ''; ?>" >
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="location">Standort(e):</label>
                    <input type="text" class="form-control" name="location" value="<?php echo!empty($location) ? $location : ''; ?>">
                    <?php if (!empty($locationError)): ?>
                        <span class="help-inline"><?php echo $locationError; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group <?php echo!empty($linkError) ? 'error' : ''; ?>">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">
                    <label for="link">Link:</label>
                    <input type="text" class="form-control" name="link" value="<?php echo!empty($link) ? $link : ''; ?>">
                    <?php if (!empty($linkError)): ?>
                        <span class="help-inline"><?php echo $linkError; ?></span>
                    <?php endif; ?>
                        <br/><p><b>Kontaktdaten</b></p>
                </div>
            </div>                    
            <div class="form-group <?php echo!empty($contactError) ? 'error' : ''; ?>">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">
                    <label for="person">Name:</label>
                    <input type="text" class="form-control" name="person" value="<?php echo!empty($person) ? $person : ''; ?>">
                </div>
                <div class="col-sm-3">
                    <label for="tel">Telefonnr.:</label>
                    <input type="text" class="form-control" name="tel" value="<?php echo!empty($tel) ? $tel : ''; ?>">
                </div>
                <div class="col-sm-3">
                    <label for="email">Emailadresse:</label>
                    <p><?php echo $email; ?></p>
                </div>
                <?php if (!empty($kontaktError)): ?>
                    <span class="help-inline"><?php echo $contactError; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group <?php echo!empty($collegeError) ? 'error' : ''; ?>">
                <div class="col-sm-1"></div>
                <div class="col-sm-6">
                    <label for="link">Fachbereiche:</label>
                    <form role="college" >
                        <div class="checkbox">
                            <label class="checkbox-inline" for="college">
                              <input type="checkbox" name="college[]" value="Wirtschaft" <?php if (stripos($college,'Wirtschaft') !== false) echo "checked='checked'"; ?>>Wirtschaft
                            </label>
                            <label class="checkbox-inline" for="college">
                                <input type="checkbox" name="college[]" value="Technik"  <?php if (stripos($college,'Technik') !== false) echo "checked='checked'"; ?>>Technik
                            </label>
                            <label class="checkbox-inline" for="college">
                              <input type="checkbox" name="college[]" value="Life Science" <?php if (stripos($college,'Life Science') !== false) echo "checked='checked'"; ?> >Life Science
                            </label>
                            <label class="checkbox-inline" for="college">
                              <input type="checkbox" name="college[]" value="Architektur, Bau und Geomatik" <?php if (stripos($college,'Architektur, Bau und Geomatik') !== false) echo "checked='checked'"; ?>>Architektur, Bau und Geomatik
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-inline"for="college">
                              <input type="checkbox" name="college[]" value="Pädagogik" <?php if (stripos($college,'Pädagogik') !== false) echo "checked='checked'"; ?>>Pädagogik
                            </label>
                            <label class="checkbox-inline" for="college">
                                <input type="checkbox" name="college[]" value="Sozial Arbeit" <?php if (stripos($college,'Soziale Arbeit') !== false) echo "checked='checked'"; ?>>Soziale Arbeit
                            </label>
                            <label class="checkbox-inline" for="college">
                              <input type="checkbox" name="college[]" value="Angewandte Psychologie" <?php if (stripos($college,'Angewandte Psychologie') !== false) echo "checked='checked'"; ?> >Angewandte Psychologie
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-inline" for="college">
                              <input type="checkbox" name="college[]" value="Gestaltung und Kunst" <?php if (stripos($college,'Gestaltung und Kunst') !== false) echo "checked='checked'"; ?>>Gestaltung und Kunst
                            </label>
                            <label class="checkbox-inline" for="college">
                                <input type="checkbox" name="college[]" value="Musik" <?php if (stripos($college,'Musik') !== false) echo "checked='checked'"; ?>>Musik
                            </label>
                        </div>
                    </form>
                    <?php 
                        if (!empty($collegeError)): ?>
                        <span class="help-inline"><?php echo $collegeError; ?></span>
                    <?php endif; ?>
                </div>
            </div> 
            <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success" >&Auml;ndern</button>
                    <a class="btn btn-default" href="myfhprofil.php">Abbrechen</a>
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