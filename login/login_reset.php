<?php
// Codeteile von Martin Hüsler aus dem Web-Engineering Modul.
// Session starten oder uebernehmen

session_start();

if (isset($_POST['resetEmail']) AND ($_POST['resetEmail']!=''))
{
    $email = $_POST['resetEmail'];
    
    //Database connection
    include "../db.inc.php";
    $link=mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");
    
    // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
    mysqli_set_charset($link, 'utf8');
    
    // Check if emailadress exists in the database
    $query = "SELECT * from user WHERE `Email`='$email'";
    $result = mysqli_query($link, $query);
    $emailExists = mysqli_num_rows($result);
    if($emailExists == TRUE){
        //Create new password
        $chars = ("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890/()&%_-"); 
        $newpwd = ''; 
        for ($i = 0; $i < 8; $i++) 
        { 
            $newpwd .= $chars{mt_rand (0,strlen($chars))}; 
        } 
        $passwort = $newpwd;
        $betreff = "Neues Passwort vom FH-Portal!";
        
        include('../credentials.php');
  
        if(!empty($_POST)){
                //Quelle: http://wiki.selfhtml.org/wiki/PHP/Anwendung_und_Praxis/Formmailer-Advanced
                // eigene Mailadresse
                $zieladresse = $email;

                //Absenderadresse
                $absenderadresse = 'dine.bronxx@gmail.com';

                //Absendername
                $absendername = "FH Portal";

                //Betreff Empfänger und Absender
                $betreff = 'Neues Passwort vom FH Portal';

                // Welches Zeichen soll zwischen dem Feldnamen und dem angegebenen Wert stehen
                $trenner = ":\t"; // Doppelpunkt und Tabulator

                /**
                 * Ende Konfigurator
                 */

                require_once "../swiftmailer/lib/swift_required.php"; // Swift initialisieren

                if ($_SERVER['REQUEST_METHOD']==="POST"){

                    $message = Swift_Message::newInstance(); // Ein Objekt für die Mailnachricht

                    $message
                            ->setFrom(array($absenderadresse => $absendername))
                            ->setTo(array($zieladresse))
                            ->setSubject($betreff)
                            ->setBody("Sehr geehrte Kundin\nSehr geehrter Kunde\n\nHier Ihr neues Passwort: $passwort\n
                                      Freundliche Grüsse\nIhr FH-Portal-Team\nwww.dine.bronxx.org");

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
                      ->setUsername($USER)
                      ->setPassword($PWD);

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
                    
                }
                //echo $message->toString();

                header("Content-type: text/html; charset=utf-8");
                }
        
        
        // Datenbankupdate
        $pass = md5($newpwd);
        $neupasswort = "UPDATE user SET `Passwort`='$pass' WHERE `Email`='$email'";
        $angepasst = mysqli_query($link,$neupasswort);

        if($angepasst == TRUE)
	{
        $_SESSION['pwReset'] = 'successful';
        header("Location: ../index.php");
	}
    }    
    else{
      $_SESSION['pwReset'] = 'failed';
      header("Location: ../index.php");
    } 
}
else
{
    header("Location: ../index.php");
}
?>

