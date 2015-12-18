<?php
    session_start();
    include("login/login_pruefen_fh.inc.php");
    $email = $_SESSION['email'];
    
    require 'database.php';
    if ( !empty($_GET['email'])) {
            $email = $_REQUEST['email'];
    }

// Codeteile von Rainer Telesko aus dem Web-Engineering Modul.
    if (!empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $locationError = null;
        $linkError = null;
        $contactError = null;

        // keep track post values
        $name = $_POST['name'];
        $location = $_POST['location'];
        $link = $_POST['link'];
        $tel = $_POST['tel'];
        $person = $_POST['person'];

        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Bitte Name der Fachhochschule eingeben.';
            $valid = false;
        }
        if (empty($location)) {
            $locationError = 'Bitte Standort(e) der Fachhochschule eingeben.';
            $valid = false;
        }
        if ((empty($tel)) || (empty($person))) {
            $contactError = 'Bitte Kontaktdaten der Fachhochschule eingeben.';
            $valid = false;
        }

        // update data
        if ($valid) {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE fh set institution = ?, site = ?, website = ?, partner = ?, phonenumber = ?, WHERE email = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($name, $location,$link, $person, $tel, $email));
                Database::disconnect();
                header("Location: myfhprofil.php");
        }
    } else {
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
            
            Database::disconnect();
    }
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
?>
<!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h2>FH Profil bearbeiten</h2>
        <form class="form-horizontal" role="form" action="fhInfo_update.php?id=<?php echo $id?>" method="post">
            <div class="form-group <?php echo!empty($nameError) ? 'error' : ''; ?>">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="name">Name:</label>
                    <div class="controls">
                        <input type="text" class="form-control" name="name" value="<?php echo!empty($name) ? $name : ''; ?>">
                        <?php if (!empty($nameError)): ?>
                            <span class="help-inline"><?php echo $nameError; ?></span>
                        <?php endif; ?>
                    </div>
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
                    <label for="email">Emailadrese:</label>
                    <p><?php echo $email; ?></p>
                </div>
                <?php if (!empty($kontaktError)): ?>
                    <span class="help-inline"><?php echo $contactError; ?></span>
                <?php endif; ?>
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
