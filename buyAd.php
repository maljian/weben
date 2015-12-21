<?php
if (!empty($_POST)) {
    $gender = $_POST['gender'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $street = $_POST['street'];
    $plz = $_POST['plz'];
    $city = $_POST['city'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $start = $_POST['start'];
    $duration = $_POST['duration'];
    

    include "db.inc.php";
    $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!" . mysql_error());

    // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
    mysqli_set_charset($link, 'utf8');
    
    // Quelle: http://www.strassenprogrammierer.de/php-mysql-bilder_tipp_580.html
    if (array_key_exists('image', $_FILES)){
        $tmpname = $_FILES['image']['tmp_name'];
        $type = $_FILES['image']['type'];
        $hndFile = fopen($tmpname, "r");
        $image = addslashes(fread($hndFile, filesize($tmpname)));
        
         $abfrage = "INSERT INTO `ads`(`id`, `gender`, `firstname`, `lastname`, `street`, `plz`, `city`, `email`, `phonenumber`, `start`, `duration`, `image`, `imagetype`) VALUES 
                ('','$gender','$firstname','$lastname','$street','$plz','$city','$email','$phonenumber','$start','$duration','$image', '$type')";
   
         $ergebnis = mysqli_query($link, $abfrage);
    if (!$ergebnis) {
        die('Could not connect: ' . mysql_error());
    }
         
    }
       
    
    mysqli_close($link);

    include('credentials.php');
    
//Quelle: http://wiki.selfhtml.org/wiki/PHP/Anwendung_und_Praxis/Formmailer-Advanced
// eigene Mailadresse
    $zieladresse = 'dine.bronxx@gmail.com';

//Absenderadresse
    $absenderadresse = $_POST['email'];

//Absendername
    $absendername = $firstname . " " . $lastname;

//Betreff Empfänger und Absender
    $betreff = 'Werbefläche FH Portal mieten';

//Weiterleitung nach Absenden
    $urlDankeSeite = 'buyAd.php';

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
                ->setBcc(array($absenderadresse))
                ->setSubject($betreff)
                ->setBody(
"Anfrage FH Portal Werbung schalten:
    
Vorname : $firstname
Nachname: $lastname
Strasse: $street
PLZ: $plz
Ort: $city
E-Mailadresse: $email
Telefonnummer: $phonenumber
    
Das Bild wurde in der Datenbank gespeichert.");

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
    <h1>Werbefläche mieten</h1>
    <h2>Preisliste</h2>
    <br/>
    <table class="table table-striped table-bordered" style="width: 50%">
        <thead>
            <tr>
                <th style="width: 20%">Dauer</th>
                <th style="width: 20%">Preis in CHF</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1 Woche</td>
                <td>50.-</td>
            </tr>
            <tr>
                <td>2 Wochen</td>
                <td>100.-</td>
            </tr>
            <tr>
                <td>3 Wochen</td>
                <td>140.-</td>
            </tr>
            <tr>
                <td>1 Monat</td>
                <td>180.-</td>
            </tr>
        </tbody>
    </table>
    <h2>Formular</h2>
    <br/>
    <p>
        Bitte w&auml;hlen Sie ein Bild aus und geben Sie den Zeitraum an, wann Ihre Werbung geschalten werden soll.
    </p>

    <!-- Kontaktformular für die Webseite -->
    <form class="form-horizontal" id="adForm" role="form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="gender">Anrede:</label>
            <div class="col-sm-2"> 
                <select class="form-control text-center" id="gender" name="gender">
                    <option selected disabled>Anrede</option>
                    <option value="Frau">Frau</option>
                    <option value="Herr">Herr</option>
                </select>
            </div>      
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="firstname">Vorname:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="lastname">Nachname:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="street">Strasse:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="street" name="street" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="plz">PLZ:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="plz" name="plz" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="city">Ort:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Emailadresse:</label>
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
            <label class="control-label col-sm-2" for="start">Startdatum:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="start" name="start" placeholder="JJJJ-MM-TT" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="duration">Dauer:</label>
            <div class="col-sm-2"> 
                <select class="form-control text-center" id="duration" name="duration">
                    <option selected disabled>Bitte wählen</option>
                    <option value="1 Woche">1 Woche</option>
                    <option value="2 Wochen">2 Wochen</option>
                    <option value="3 Wochen">3 Wochen</option>
                    <option value="1 Monat">1 Monat</option>
                </select>
            </div>      
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="image">Bilddatei:</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-success" value="send">Senden</button>
                <a class="btn btn-default" href="../myCourse.php">Abbrechen</a>
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
                $('#adForm').bootstrapValidator({
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
                        gender: {
                            validators: {
                                callback: {
                                    message: 'Bitte wählen Sie eine Anrede aus.',
                                    callback: function(value, validator, $field) {
                                        // Get the selected options
                                        var options = validator.getFieldElements('gender').val();
                                        return (options != null && options.length >= 2);
                                    }
                                }
                            }
                        },
                        firstname: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie Ihren Vornamen an.'
                                }
                            }
                        },
                        lastname: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie Ihren Nachnamen an.'
                                }
                            }
                        },
                        street: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie Ihre Strasse an.'
                                }
                            }
                        },
                        plz: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie Ihre PLZ an.'
                                },
                                regexp: {
                                    message: 'Die Postleitzahl muss aus 4 oder 5 Ziffern bestehen.',
                                    regexp: /^[0-9]{4,5}$/
                                }
                            }
                        },
                        city: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie Ihren Ort an.'
                                }  
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie Ihre Emailadresse an.'
                                },
                                emailAddress: {
                                    message: 'Sie haben keine gültige Emailadresse eingegeben.'
                                }
                            }
                        },
                        phonenumber: {
                            validators: {
                                regexp: {
                                    message: 'Die Telefonnummer darf nur Ziffern, Leerschläge, -, (, ), + und . enthalten.',
                                    regexp: /^[0-9\s\-()+\.]+$/
                                }
                            }
                        },
                        start: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie ein Startdatum an.'
                                },
                                date: {
                                    format: 'YYYY-MM-DD',
                                    message: 'Bitte geben Sie ein gültiges Datum ein.'
                                }
                            }
                        },
                        duration: {
                            validators: {
                                callback: {
                                    message: 'Bitte wählen Sie eine Dauer aus.',
                                    callback: function(value, validator, $field) {
                                        // Get the selected options
                                        var options = validator.getFieldElements('duration').val();
                                        return (options != null && options.length >= 2);
                                    }
                                }
                            }
                        },
                        image: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte laden Sie ein Bild für die Werbeanzeige hoch.'
                                },
                                file: {
                                    type: 'image/jpeg,image/png',
                                    maxSize: 53248, // 52 * 1024
                                    message: 'Das Bild darf maximal eine Grösse von 52KB haben und muss ein .jpeg oder .png File sein!'
                                }
                            }
                        }
                    }
                });
            }); 
</script>