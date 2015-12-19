<?PHP 
    require '../database.php';
    $emailaddress = 0;
    if (!empty($_GET['emailaddress'])) {
        $emailaddress = $_REQUEST['emailaddress'];
   
        $pdo = Database::connect();
        $pdo->exec('set names utf8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // check if email is not used in db user or db fh
        $sql= "SELECT * FROM fh WHERE `email` = $emailaddress";
        $resultFH = $pdo->prepare($sql);
        
        $sql= "SELECT * FROM user WHERE `email` = $emailaddress";
        $resultUser = $pdo->prepare($sql);
       
        if($resultFH->rowCount()== TRUE OR $resultUser->rowCount()==TRUE){
        
        //add FH to db fh
        $sql= "SELECT * FROM fh_enrolement WHERE `email`='$emailaddress'";
                    // PDO-Query (kein Prepared Statement)
                    foreach ($pdo->query($sql) as $row) {                       
                        $institution = $row['institution'];
                        $partner = $row['partner'];
                        $street = $row['street'];
                        $postalcode = $row['postalcode'];
                        $city = $row['city'];
                        $website = $row['website'];
                        $email = $row['email'];
                        $phonenumber = $row['phonenumber'];
                        $region = $row['region'];
            }
        $sql = "INSERT INTO fh(`institution`,`partner`,street,`postalcode`,`city`,`website`,`email`,`phonenumber`,`site`,`region`,`college`) VALUES (?,?,?,?,?,?,?,?,?,?)";    
        $q = $pdo->prepare($sql);
        $q->execute(array("$institution","$partner","$street","$postalcode","$city","$website","$email","$phonenumber","NULL","$region","NULL"));
        
        //generate password and add to db user
        $chars = ("abcdefghijklmnopqrstuvwxyz1234567890"); 
        $newpwd = ''; 
        for ($i = 0; $i < 8; $i++) 
        { 
            $newpwd .= $chars{mt_rand (0,strlen($chars))}; 
        } 
        $newpassword = $newpwd;
        $pass = md5($newpassword);
        $type = "fh";
        
        $sql = "INSERT INTO user(`Name`,`Email`,`Passwort`,`Type`) VALUES (?,?,?,?)";    
        $q = $pdo->prepare($sql);
        $q->execute(array("$institution","$email","$pass","$type"));
        
        //write email to FH
        //Quelle: http://wiki.selfhtml.org/wiki/PHP/Anwendung_und_Praxis/Formmailer-Advanced
                // eigene Mailadresse
                $zieladresse = $email;

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

                

                    $message = Swift_Message::newInstance(); // Ein Objekt für die Mailnachricht

                    $message
                            ->setFrom(array($absenderadresse => $absendername))
                            ->setTo(array($zieladresse))
                            ->setSubject($betreff)
                            ->setBody("Sehr geehrte Kundin\nSehr geehrter Kunde\n\n Vielen Dank für Ihre Anmeldung bei FH Portal.\n"
                                    . "Gerne haben wir Ihre Anmeldung akzeptiert und Sie können sich nun mit folgenden Logindaten einloggen:\n\n"
                                    ."Benutzername: ".$email."\n"."Passwort: ".$newpassword."\n\nBitte passen Sie das Passwort nach dem ersten Login an."
                                    ."\nFreundliche Grüsse\nIhr FH-Portal-Team\nwww.dine.bronxx.org");

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
                    
                
                //echo $message->toString();

                header("Content-type: text/html; charset=utf-8");
        
       // delete data from db fh_enrolement
        $sql = "DELETE FROM fh_enrolement  WHERE email = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($emailaddress));
        Database::disconnect();
        header("Location: ../addFH.php");
        }
        else{
            //error message that email already exists in user or fh db!!!!!
            $_SESSION['acceptError']='failed';
            header("Location: ../addFH.php");
        }
    }
    
?>