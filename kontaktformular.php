<?php
if(!empty($_POST)){
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phonenumber = $_POST['phonenumber'];
$email = $_POST['email'];
$question = $_POST['question'];

//Quelle: http://wiki.selfhtml.org/wiki/PHP/Anwendung_und_Praxis/Formmailer-Advanced
// eigene Mailadresse
$zieladresse = 'fhnw.weben@gmail.com';

//Absenderadresse
$absenderadresse = $_POST['email'];

//Absendername
$absendername = $firstname." ".$lastname;

//Betreff Empfänger und Absender
$betreff = 'Kontaktanfrage FH Portal';

//Weiterleitung nach Absenden
$urlDankeSeite = '';

// Welches Zeichen soll zwischen dem Feldnamen und dem angegebenen Wert stehen
$trenner = ":\t"; // Doppelpunkt und Tabulator

/**
 * Ende Konfigurator
 */

require_once "swiftmailer/lib/swift_required.php"; // Swift initialisieren

if ($_SERVER['REQUEST_METHOD']==="POST"){
    
    $message = Swift_Message::newInstance(); // Ein Objekt für die Mailnachricht
    
    $message
            ->setFrom(array($absenderadresse => $absendername))
            ->setTo(array($zieladresse))
            ->setBcc(array($absenderadresse))
            ->setSubject($betreff)
            ->setBody(
    
"Anfrage FH Portal erhalten:
Vorname : $firstname
Nachname: $lastname
E-Mailadresse: $email
Telefonnummer: $phonenumber
    
Anfrage: 
$question");
    
    $mailtext = "";
    
    foreach ($_POST as $name => $wert){
        if(is_array($wert)){
            foreach ($wert as $einzelwert){
                $mailtext .= $name.$trenner.$einzelwert."\n";
            }
        } else {
            $mailtext .= $name.$trenner.$wert."\n";
        }
    }
    
    // Code Ergänzungen: try und catch, logger
 // gemäss: [http://swiftmailer.org/pdf/Swiftmailer.pdf Swiftmailer.pdf]
 
 try {
     /* Mit try und catch können die Fehlerevents differenzierter getestet werden
     *
     * diverse Möglichkeiten für $Transport 
     * smtp mit den gewohnten Optionen, siehe Dokumentation Swiftmailer  
     *  für TLS und SSL  allenfalls phpinfo ob extentiens installiert
     */
 
     $Transport0 = Swift_MailTransport::newInstance();        /* Beispiel geht über PHP-Mail, geht i.a. 
                                                                 aber keine Information von logger     */
 
     $Transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',587,'tls' )     /* 'tls', Ports je nach Server */
      ->setUsername("fhnw.weben@gmail.com")
      ->setPassword("!Je8Na8Sa9!");
     
     $Transport2 = Swift_SmtpTransport::newInstance('mail.gmail.com',995,'tls' )  /* 'tls' */
      ->setUsername("...")
      ->setPassword("...");
 
     $mailer = Swift_Mailer::newInstance($Transport); 
 
     // Echo Logger aktivieren (es gibt noch einen logger der auf File schreibt)
     $logger = new Swift_Plugins_Loggers_EchoLogger();
     $mailer -> registerPlugin ( new Swift_Plugins_LoggerPlugin ($logger));
 
     $result = $mailer->send($message);
 
    }
     catch(Exception $e){
       $error_log = $logger->dump();
    }
    
    if ($result == 0){
        die("Mail konnte nicht versandt werden.");
    }
    header("Location: $urlDankeSeite");
    exit;
}
//echo $message->toString();

header("Content-type: text/html; charset=utf-8");
}
session_start();
include("login/header.php");
?>

<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h1>Kontaktformular</h1>
    <br/>
   
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
include ("login/login_alert.php");
include ("Layout/login.html");
include ("Layout/ads.html");
include ("Layout/footer.html");
?>
</html>