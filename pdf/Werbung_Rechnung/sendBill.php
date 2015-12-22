<?php
session_start();

$refn=$_SESSION['refn'];
$email=$_SESSION['email'];
$gender=$_SESSION['gender'];
$lastname=$_SESSION['lastname'];
$amount=$_SESSION['amount'];

if (strcmp($gender, 'Frau') == 0) {
        $return = 'geehrte';
    }if (strcmp($gender, 'Herr') == 0) {
        $return = 'geehrter';
    }
    $anrede = $return;

if (!empty($refn)) {
   
    include('../../credentials.php');
    
//Quelle: http://wiki.selfhtml.org/wiki/PHP/Anwendung_und_Praxis/Formmailer-Advanced
// eigene Mailadresse
    $zieladresse = $email;

//Absenderadresse
    $absenderadresse = $USER;

//Absendername
    $absendername = 'FH Portal';

//Betreff Empfänger und Absender
    $betreff = 'Rechnung FH Portal';

//Weiterleitung nach Absenden
    $urlDankeSeite = '../../addAd.php';

// Welches Zeichen soll zwischen dem Feldnamen und dem angegebenen Wert stehen
    $trenner = ":\t"; // Doppelpunkt und Tabulator

    /**
     * Ende Konfigurator
     */
    require_once "../../swiftmailer/lib/swift_required.php"; // Swift initialisieren
    
    $attachment = Swift_Attachment::fromPath("Rechnung_".$refn.".pdf", "application/pdf");

    if ($_SERVER['REQUEST_METHOD'] === "GET") {

        $message = Swift_Message::newInstance(); // Ein Objekt für die Mailnachricht

        $message
                ->setFrom(array($absenderadresse => $absendername))
                ->setTo(array($zieladresse))
                ->setSubject($betreff)
                ->attach ($attachment)
                ->setBody(
"Sehr ".$anrede." ".$gender." ".$lastname."

Vielen Dank dass Sie Ihre Werbung bei uns schalten möchten.
    
Nachdem Sie den Rechnungsbetrag von CHF ".$amount." bei uns beglichen haben, werden wir Ihre Werbung ab Ihrem Wunschtermin aufschalten.
Im Anhang finden Sie Ihre Rechnung mit der Rechnungsnummer ".$refn." und dem Einzahlungsschein.

Freundliche Grüsse

Freundliche Grüsse
Ihr FH-Portal-Team
www.dine.bronxx.org
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
        } catch (Exception $e) {
            $error_log = $logger->dump();
        }

        if ($result == 0) {
            die($_SESSION['contactMessage']='failed');
            echo $e;
        }
  
        header("Location: $urlDankeSeite");
        exit;
    }
//echo $message->toString();

    header("Content-type: text/html; charset=utf-8");
}