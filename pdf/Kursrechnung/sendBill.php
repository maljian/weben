<?php
session_start();
if (!empty($_SESSION['refn'])) {
   
    include('../../credentials.php');
    
//Quelle: http://wiki.selfhtml.org/wiki/PHP/Anwendung_und_Praxis/Formmailer-Advanced
// eigene Mailadresse
    $zieladresse = $_SESSION['email'];

//Absenderadresse
    $absenderadresse = 'dine.bronxx@gmail.com';

//Absendername
    $absendername = 'FH Portal';

//Betreff Empfänger und Absender
    $betreff = 'Rechnung FH Portal';

//Weiterleitung nach Absenden
    $urlDankeSeite = '../../myCourse.php';

// Welches Zeichen soll zwischen dem Feldnamen und dem angegebenen Wert stehen
    $trenner = ":\t"; // Doppelpunkt und Tabulator
    
    /**
     * Ende Konfigurator
     */
    require_once "../../swiftmailer/lib/swift_required.php"; // Swift initialisieren
    
    $attachment = Swift_Attachment::fromPath("Kursrechnung_".$_SESSION['refn'].".pdf", "application/pdf");

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $message = Swift_Message::newInstance(); // Ein Objekt für die Mailnachricht

        $message
                ->setFrom(array($absenderadresse => $absendername))
                ->setTo(array($zieladresse))
                ->setSubject($betreff)
                ->attach ($attachment)
                ->setBody(
"Sehr geehrte/r Frau/Herr ".$_SESSION['partner']."

Um auf dem FH Portal ihre Kurse freizuschalten, begleichen Sie bitte den Rechnungsbetrag von CHF ".$_SESSION['amount']." .".
"
Im Anhang finden Sie Ihre Rechnung mit der Rechnungsnummer ".$_SESSION['refn']." und dem Einzahlungsschein.

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