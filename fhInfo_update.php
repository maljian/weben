<?php
    session_start();
    include("login/header.php");
    include("login/login_pruefen_fh.inc.php");
   
    $email = $_SESSION['email'];
    
    require 'database.php';

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
        $fache = null;
        foreach($col as $fach) {
            $fache = $fache." ";
            echo $fach;
        }
        $college = null;
        $college = $fache;

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
        if (empty($college)){
            $collegeError = 'Bitte mindestens einen Fachbereich auswählen.';
            $valid = false;
        }
        echo $valid;

        // update data
        if ($valid) {    
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE fh set `site` = ?, `website` = ?, `partner` = ?, `phonenumber` = ?, `college` = ? WHERE `email` = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($location, $link, $person, $tel, $college, $email));
            Database::disconnect();
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
        $college = $data['college'];
            
        Database::disconnect();
    }
?>
<!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <h2>FH Profil bearbeiten</h2>
        <form class="form-horizontal" role="form" id="fhForm" action="#" method="post">
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
                    <input type="text" class="form-control" name="location" id="location" value="<?php echo!empty($location) ? $location : ''; ?>">
                    <?php if (!empty($locationError)): ?>
                        <span class="help-inline"><?php echo $locationError; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group <?php echo!empty($linkError) ? 'error' : ''; ?>">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">
                    <label for="link">Link:</label>
                    <input type="text" class="form-control" name="link" id="link" value="<?php echo!empty($link) ? $link : ''; ?>">
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
                    <input type="text" class="form-control" name="person" id="person" value="<?php echo!empty($person) ? $person : ''; ?>">
                </div>
                <div class="col-sm-3">
                    <label for="tel">Telefonnr.:</label>
                    <input type="text" class="form-control" name="tel" id="tel" value="<?php echo!empty($tel) ? $tel : ''; ?>">
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
                    <label for="college">Fachbereiche:</label>
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
                            <label class="checkbox" for="college">
                              <input type="checkbox" name="college[]" value="Architektur, Bau und Geomatik" <?php if (stripos($college,'Architektur, Bau und Geomatik') !== false) echo "checked='checked'"; ?>>Architektur, Bau und Geomatik
                            </label>
                            <label class="checkbox-inline"for="college">
                              <input type="checkbox" name="college[]" value="Pädagogik" <?php if (stripos($college,'Pädagogik') !== false) echo "checked='checked'"; ?>>Pädagogik
                            </label>
                            <label class="checkbox-inline" for="college">
                                <input type="checkbox" name="college[]" value="Sozial Arbeit" <?php if (stripos($college,'Soziale Arbeit') !== false) echo "checked='checked'"; ?>>Soziale Arbeit
                            </label>
                            <label class="checkbox" for="college">
                              <input type="checkbox" name="college[]" value="Angewandte Psychologie" <?php if (stripos($college,'Angewandte Psychologie') !== false) echo "checked='checked'"; ?> >Angewandte Psychologie
                            </label>
                            <label class="checkbox-inline" for="college">
                              <input type="checkbox" name="college[]" value="Gestaltung und Kunst" <?php if (stripos($college,'Gestaltung und Kunst') !== false) echo "checked='checked'"; ?>>Gestaltung und Kunst
                            </label>
                            <label class="checkbox-inline" for="college">
                                <input type="checkbox" name="college[]" value="Musik" <?php if (stripos($college,'Musik') !== false) echo "checked='checked'"; ?>>Musik
                            </label>
                        </div>
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
<!--Codeteile von Rainer Telesko aus dem Web-Engineering Modul.-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
       <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  -->
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
        <script id="source" language="javascript" type="text/javascript">
            $(document).ready(function () {
                $('#fhForm').bootstrapValidator({
                    // Source: http://formvalidation.io/examples/showing-message-custom-area/
                    err: {
                        container: function($field, validator) {
                        // Look at the markup
                        //  <div class="col-xs-4">
                        //      <field>
                        //  </div>
                        //  <div class="col-xs-5 messageContainer"></div>
                        return $field.parent().next('.messageContainer');
                        }
                    },
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        location: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie mindestens einen Standort an.'
                                },
                                regexp: {
                                    message: 'Bitte trennen Sie die Standorte mit Komma und Leerschlag.'
                                    regexp: '[\[a-zA-Z]\s]+'
                                }
                            }
                        },
                        link: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Webseite muss zwingend angegeben werden.'
                                },
                                uri: {
                                    message: 'Sie haben keine gültige URL eingegeben. Bitte stellen Sie zwingend http:// oder https:// vor das www!'
                                },
                            }
                        },
                        person: {
                            validators: {
                                notEmpty: {
                                    message: 'Ein Ansprechpartner muss zwingend angegeben werden.'
                                }
                            }
                        },
                        tel: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Telefonnummer muss zwingend angegeben werden.'
                                },
                                regexp: {
                                    message: 'Die Telefonnummer darf nur Ziffern, Leerschläge, -, (, ), + und . enthalten.',
                                    regexp: /^[0-9\s\-()+\.]+$/
                                }
                            }
                        } 
                    }
                });
            }); 
</script>