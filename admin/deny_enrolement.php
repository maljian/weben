<?PHP 
    require '../database.php';
    $emailaddress = null;
    session_start();

    if (!empty($_GET['emailaddress'])) {
        $emailaddress = $_REQUEST['emailaddress'];
 
        //Quelle: http://wiki.selfhtml.org/wiki/PHP/Anwendung_und_Praxis/Formmailer-Advanced
        // eigene Mailadresse
        $zieladresse = $emailaddress;

        //Absenderadresse
        $absenderadresse = 'fhnw.weben@gmail.com';

        //Absendername
        $absendername = "FH Portal";

        //Betreff Empfänger und Absender
        $betreff = 'Anmeldung FH Portal';

        // Welches Zeichen soll zwischen dem Feldnamen und dem angegebenen Wert stehen
        $trenner = ":\t"; // Doppelpunkt und Tabulator

        /**
         * Ende Konfigurator
         */

        require_once "../swiftmailer/lib/swift_required.php"; // Swift initialisieren

        if ($_SERVER['REQUEST_METHOD']==="GET"){
            $message = Swift_Message::newInstance(); // Ein Objekt für die Mailnachricht

            $message
                    ->setFrom(array($absenderadresse => $absendername))
                    ->setTo(array($zieladresse))
                    ->setSubject($betreff)
                    ->setBody(
                            "Sehr geehrte Kundin\nSehr geehrter Kunde\n\n Leider konnten wir Sie nicht auf unserem Portal aufnehmen.\n
        Für weitere Informationen kontaktieren Sie uns.\n
        Freundliche Grüsse\nIhr FH-Portal-Team\nwww.dine.bronxx.org"
                      );

            $mailtext = "";

            foreach ($_GET as $name => $wert){
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
              ->setPassword("066a85305f6f0123561cec141da5af27");

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
            //change state in db fh_enrolement to denied
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE fh_enrolement SET status='denied' WHERE email = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($emailaddress));
                Database::disconnect();
                header("Location: ../addFH.php");
        }
        //echo $message->toString();

        header("Content-type: text/html; charset=utf-8");
        }
?>