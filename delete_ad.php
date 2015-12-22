<?php
session_start();

require 'database.php';
$id = 0;

if (!empty($_GET['id'])) {
$id = $_REQUEST['id'];
}

if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];

    // delete data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ads  WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $email = $data['email'];
    $gender = $date['gender'];
    $lastname = $data['lastname'];
    
    $sql = "DELETE FROM ads  WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));

    Database::disconnect();


    include('credentials.php');

    //Quelle: http://wiki.selfhtml.org/wiki/PHP/Anwendung_und_Praxis/Formmailer-Advanced
    // eigene Mailadresse
    $zieladresse = $email;

    //Absenderadresse
    $absenderadresse = $USER;

    //Absendername
    $absendername = 'FH Portal';

    //Betreff Empfänger und Absender
    $betreff = 'Werbefläche mieten FH Portal';

    //Weiterleitung nach Absenden
    $urlDankeSeite = 'addAd.php';

    // Welches Zeichen soll zwischen dem Feldnamen und dem angegebenen Wert stehen
    $trenner = ":\t"; // Doppelpunkt und Tabulator

    /**
     * Ende Konfigurator
     */
    require_once "swiftmailer/lib/swift_required.php"; // Swift initialisieren

    if ($_SERVER['REQUEST_METHOD'] === "POST") {


    $message = Swift_Message::newInstance(); // Ein Objekt für die Mailnachricht

    $message
    ->setFrom(array($absenderadresse => $absendername))
    ->setTo(array($zieladresse))
    ->setSubject($betreff)
    ->setBody(
    "Sehr geehrte/r ".$gender." ".$lastname.

    "\n\nLeider können wir Ihre Werbung nicht auf unserer Seite schalten.

    \n\nFür weitere Informationen können Sie sich gerne bei uns melden.

    \n\nFreundliche Grüsse

    \nFreundliche Grüsse
    \nIhr FH-Portal-Team
    \nwww.dine.bronxx.org
    ");

    $mailtext = "";

    foreach ($_POST as $name => $wert) {
    if (is_array($wert)) {
    foreach ($wert as $einzelwert) {
    $mailtext .= $name . $trenner . $einzelwert . "\n";
    }
    } else {
    $mailtext .= $name . $trenner . $wert . "\n";
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
      aber keine Information von logger */

    $Transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls') /* 'tls', Ports je nach Server */
    ->setUsername($USER)
    ->setPassword($PWD);

    $Transport2 = Swift_SmtpTransport::newInstance('mail.gmail.com', 995, 'tls') /* 'tls' */
    ->setUsername("...")
    ->setPassword("...");

    $mailer = Swift_Mailer::newInstance($Transport);

    // Echo Logger aktivieren (es gibt noch einen logger der auf File schreibt)
    $logger = new Swift_Plugins_Loggers_EchoLogger();
    $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

    $result = $mailer->send($message);
    $result2 = $mailer->send($message2);
    } catch (Exception $e) {
    $error_log = $logger->dump();
    }

    if ($result == 0) {
    die($_SESSION['contactMessage'] = 'failed');

    }
    $_SESSION['deleteAdMessage'] = 'successful';
    header("Location: $urlDankeSeite");
    exit;
    }
    //echo $message->toString();

    header("Content-type: text/html; charset=utf-8");
}


include ("login/header.php");
include("login/login_pruefen_admin.inc.php");
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h3>Werbeanfrage löschen</h3>
    <form class="form-horizontal" action="delete_ad.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <p class="alert alert-error">Möchten Sie die Werbeanfrage löschen?</p>
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Ja</button>
            <a class="btn btn-default" href="addAd.php">Nein</a>
        </div>
    </form>
</div>
<?php
include ("login/login_error.php");
include ("Layout/footer.html");
?>
</html>