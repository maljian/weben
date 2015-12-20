<?php
session_start();

if(!empty($_GET)){
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$phonenumber = $_SESSION['phonenumber'];
$email = $_SESSION['email'];
$question = $_SESSION['question'];

//Quelle: http://wiki.selfhtml.org/wiki/PHP/Anwendung_und_Praxis/Formmailer-Advanced
// eigene Mailadresse
$zieladresse = 'dine.bronxx@gmail.com';

//Absenderadresse
$absenderadresse = $email;

//Absendername
$absendername = $firstname." ".$lastname;

//Betreff Empfänger und Absender
$betreff = 'Kontaktanfrage FH Portal';

//Weiterleitung nach Absenden
$urlDankeSeite = 'http://www.dine.bronxx.org/kontaktformular.php';

// Welches Zeichen soll zwischen dem Feldnamen und dem angegebenen Wert stehen
$trenner = ":\t"; // Doppelpunkt und Tabulator

/**
 * Ende Konfigurator
 */

require_once "swiftmailer/lib/swift_required.php"; // Swift initialisieren
include ('credentials.php');

if ($_SERVER['REQUEST_METHOD']==="GET"){
    
    
    
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
 
     $Transport = Swift_SmtpTransport::newInstance('smtp.fhnw.ch',465,'tls' )     /* 'tls', Ports je nach Server */
      ->setUsername ($USER)
      ->setPassword ($PWD);
     
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

header("Content-type: text/html; charset=utf-8");
}
session_start();
include("login/header.php");
?>