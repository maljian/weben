<?php
session_start();
include ("Layout/header.html");
include "db.inc.php";
if (isset($_SESSION['eingeloggt'])) {
    if ($_SESSION['eingeloggt'] == true) {
        include ("Layout/nav-loggedin.html");
    }
    else{
            include ("Layout/nav.html");
    }
} else {
    include ("Layout/nav.html");
}

// Quelle Vorlesung Rainer Telesko
if (!empty($_POST)) {
    //keep track validation errors
    $firstnameError = null;
    $lastnameError = null;
    $emailError = null;
    $questionError = null;

    //keep track post values
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $question = $_POST['question'];

    // Quelle: http://www.informationsarchiv.net/topics/14583/
    $empfaenger = "nadine.toepfer@students.fhnw.ch"; // eigene Mailadresse
    $subject01 = "Kontaktanfrage"; // Betreff eigene Mailadresse
    $subject02 = "Kontaktanfrage FH Portal"; // Betreff der Bestätigungsmail
    $header = "From: $email";

    //validate input
    $valid = true;
    if (empty($firstname)) {
        $firstnameError = 'Bitte geben Sie Ihren Vornamen ein!';
        $valid = false;
    }
    if (empty($lastname)) {
        $lastnameError = 'Bitte geben Sie Ihren Nachnamen ein!';
        $valid = false;
    }
    if (empty($email)) {
        $emailError = 'Bitte geben Sie Ihre E-Mailadresse ein!';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Bitte geben Sie eine gültige E-Mailadresse ein!';
        $valid = false;
    }
    if (empty($question)) {
        $questionError = 'Bitte geben Sie Ihre Anfrage ein!';
        $valid = false;
    } 
    if ($valid) {
        // Quelle: http://www.informationsarchiv.net/topics/14583/
        // Body für die Mail
        $body01 = "Anfrage erhalten:
    Vorname : $firstname
    Nachname: $lastname
    E-Mailadresse: $email
    Telefonnummer: $phonenumber
    
    Anfrage: 
    $question";

// Body für Bestätigungsmail
        $body02 = "Folgende Anfrage haben wir von Ihnen erhalten:
    Vorname : $firstname
    Nachname: $lastname
    E-Mailadresse: $email
    Telefonnummer: $phonenumber
    
    Anfrage: 
    $question
    
    Ihre Anfrage wird so schnell wie möglich bearbeitet.";

// Mail an den Webmaster
        mail($empfaenger, $subject01, $body01, $header);
// Bestätigungsmail
        mail($email, $subject02, $body02, $header);
    }
}
?>

<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h1>Impressum</h1>
    <br/>
    <p>
        Web-Engineering Projekt<br/>
        S.K&auml;sermann, N.Racine und J.Ruppen <br/>
        BSc Wirtschaftsinformatik (WIVZ 3.51) HS15 <br/>
        FHNW Hochschule f&uuml;r Wirtschaft<br/>
        Riggenbachstrasse 16<br/>
        4600 Olten <br/>
    </p>

    <!-- Kontaktformular für die Webseite -->
    <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="gender">Anrede:</label>
            <div class="col-sm-2"> 
                <select class="form-control text-center" id="gender">
                    <option>Frau</option>
                    <option>Herr</option>
                </select>
            </div>      
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="firstname">Vorname: *</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="lastname">Nachname: *</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Emailadresse: *</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="phonenumber">Telefonnummer:</label>
            <div class="col-sm-4">
                <input type="tel" class="form-control" id="phonenumber" name="phonenumber">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="question">Anfrage: *</label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="10" id="question" name="question" required></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-default" value="send">Senden</button>
                <button type="reset" class="btn btn-default" value="reset">Abbrechen</button>
            </div>      
        </div>
    </form>

</div>

<?php
include ("login/login_error.php");
include ("Layout/sidebar.html");
include ("Layout/ads.html");
include ("Layout/footer.html");
?>
</html>
