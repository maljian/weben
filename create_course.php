<?php
session_start();
include("login/login_pruefen_admin.inc.php");
include("login/header.php");
$fh = $_SESSION['Name'];

// Codeteile von Rainer Telesko aus dem Web-Engineering Modul.
if (!empty($_POST)) {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $cost = $_POST['cost'];
    $text = $_POST['txt'];
    $result = $_POST['result'];
    $contactemail = $_POST['contact'];
    $type = $_POST['studiform'];
    $studigang = $_POST['studigang'];
    $fachbereich = $_POST['fachbereich'];

    include "db.inc.php";
    $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!" . mysql_error());

    // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
    mysqli_set_charset($link, 'utf8');

    $abfrage = "INSERT INTO `studiengang`(`id`, `name`, `fh`, `location`, `start`, `end`, `cost`, `text`, `result`, `contact_email`, `type`, `degreeprogram`, `category`) VALUES 
                ('','$title','$fh','$location','$start','$end','$cost','$text','$result','$contactemail','$type','$studigang','$fachbereich')";
    $ergebnis = mysqli_query($link, $abfrage);
    if (!$ergebnis) {
        die('Could not connect: ' . mysql_error());
    }
    mysqli_close($link);
}
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h2>Neuen Kurs erfassen</h2>
    <form class="form-horizontal" id="createForm" role="form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Kurstitel:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="title" name="title">
            </div>
        </div>
        <div class="form-group" >  
            <label class="control-label col-sm-2" for="fachbereich">Fachbereich:</label>
            <div class="col-sm-4">
                <select class="form-control text-center" name="fachbereich">
                    <option value=""> --------- Auswahl --------- </option>
                    <option value="Wirtschaft">Wirtschaft</option>
                    <option value="Technik">Technik</option>
                    <option value="Angewandte Psychologie">Angewandte Psychologie</option>
                    <option value="Architektur, Bau und Geomatik">Architektur, Bau und Geomatik</option>
                    <option value="Gestaltung und Kunst">Gestaltung und Kunst</option>
                    <option value="Life Science">Life Science</option>
                    <option value="Musik">Musik</option>
                    <option value="P&auml;dagogik">P&auml;dagogik</option>
                    <option value="Soziale Arbeit">Soziale Arbeit</option>
                </select>  
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="studigang">Studium:</label>
            <div class="col-sm-4">
                <select class="form-control text-center" name="studigang">
                    <option value=""> --------- Auswahl --------- </option>
                    <option value="Bachelor">Bachelor</option>
                    <option value="Master">Master</option>
                    <option value="Weiterbildung">Weiterbildung</option>
                </select>
            </div>
        </div>               
        <div class="form-group">
            <label class="control-label col-sm-2">Studienform: </label>
                <div class="col-sm-2">
                    <label class="radio-inline"><input type="radio" name="studiform" value="Pr&auml;senzstudium Vollzeit"> Präsenzstudium Vollzeit</label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline"><input type="radio" name="studiform" value="Pr&auml;senzstudium Teilzeit"> Präsenzstudium Teilzeit</label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline"><input type="radio" name="studiform" value="Fernstudium Vollzeit"> Fernstudium Vollzeit</label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline"><input type="radio" name="studiform" value="Fernstudium Teilzeit"> Fernstudium Teilzeit</label>
                </div>
           
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="location">Ort:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="location" name="location">
            </div>
        </div>
        <div class="form-group">        
            <label class="control-label col-sm-2" for="start">Von:</label>
            <div class ="col-sm-3">
                <div class='input-group'>
                    <input type='text' id="start" name='start' class="form-control" placeholder="JJJJ-MM-TT">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <label class="control-label col-sm-2" for="end">Bis:</label>
            <div class ="col-sm-3">
                <div class='input-group date'>
                    <input type='text' id="end" name='end' class="form-control" placeholder="JJJJ-MM-TT">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>     
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">Kosten in CHF:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="cost" name="cost">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="contact">Kontakt E-Mail:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="contact" name="contact">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="txt">Beschreibung:</label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="10" id="txt" name="txt"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="result">Resultat:</label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="10" id="result" name="result"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-success" value="send">Erfassen</button>
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
        $('#createForm').bootstrapValidator({
            // Source: http://formvalidation.io/examples/showing-message-custom-area/
            err: {
                container: function ($field, validator) {
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
                title: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte geben Sie einen Kurstitel ein.'
                        }
                    }
                },
                fachbereich: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte geben Sie den Fachbereich an.'
                        }
                    }
                },
                studigang: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte geben Sie den Studiengang an.'
                        }
                    }
                },
                location: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte geben Sie den Ort der Veranstaltung an.'
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
                end: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte geben Sie ein Enddatum an.'
                        },
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'Bitte geben Sie ein gültiges Datum ein.'
                        }
                    }
                },
                cost: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte geben Sie die Kosten der Veranstaltung an.'
                        },
                        regexp: {
                                    message: 'Bitte nur Ziffern verwenden.',
                                    regexp: /^[0-9]{1,20}$/
                                }
                    }
                },
                contact: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte geben Sie Ihre Emailadresse an.'
                        },
                        emailAddress: {
                            message: 'Sie haben keine gültige Emailadresse eingegeben.'
                        }
                    }
                },
                txt: {
                    validators: {
                        notEmpty: {
                            message: 'Bitte geben Sie die Beschreibung der Veranstaltung an.'
                        },
                        stringLength: {
                            max: 1000,
                            message: 'Die Kursbeschreibung darf maximal 1000 Zeichen lang sein!'
                        }
                    }
                }
            }
        });
    });
</script>