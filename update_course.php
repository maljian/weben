<?php
session_start();

require 'database.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

// Codeteile von Rainer Telesko aus dem Web-Engineering Modul.
if (!empty($_POST)) {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $cost = $_POST['cost'];
    $text = $_POST['txt'];
    $result = $_POST['result'];
    $contact = $_POST['contact'];
    $type = $_POST['studiform'];
    $studigang = $_POST['studigang'];
    $fachbereich = $_POST['fachbereich'];


    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE studiengang SET name = ?, location =?, start =?, end =?, cost =?, text =?, result =?, contact_email =?, type =?, degreeprogram =?, category =? WHERE id = ?";
            
    // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
    $pdo->exec('set names utf8');

    $q = $pdo->prepare($sql);
    $q->execute(array($title, $location, $start, $end, $cost, $text, $result, $contact, $type, $studigang, $fachbereich, $id));
    Database::disconnect();
    
    //forward to myCourse Page
    $_SESSION['changeMessage']='updated';
    header("Location: myCourse.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM studiengang where id = ?";

    // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
    $pdo->exec('set names utf8');

    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $title = $data['name'];
    $location = $data['location'];
    $start = $data['start'];
    $end = $data['end'];
    $cost = $data['cost'];
    $text = $data['text'];
    $result = $data['result'];
    $contact = $data['contact_email'];
    $type = $data['type'];
    $studigang = $data['degreeprogram'];
    $fachbereich = $data['category'];
    Database::disconnect();
}
include("login/header.php");
include("login/login_pruefen_fh.inc.php");
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h2>Kurs bearbeiten</h2>
    <form class="form-horizontal" id="updateForm" role="form" action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name" >Kurstitel:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="title" name="title" value="<?php echo!empty($title) ? $title : ''; ?>">
            </div>
        </div>
        <div class="form-group" >  
            <label class="control-label col-sm-2" for="fachbereich">Fachbereich:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="fachbereich" name="fachbereich" value="<?php echo!empty($fachbereich) ? $fachbereich : ''; ?>">        
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="studigang">Studiengang:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="studigang" name="studigang" value="<?php echo!empty($studigang) ? $studigang : ''; ?>">
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
                <input type="text" class="form-control" id="location" name="location" value="<?php echo!empty($location) ? $location : ''; ?>">
            </div>
        </div>
        <div class="form-group">        
            <label class="control-label col-sm-2" for="start">Von:</label>
            <div class ="col-sm-3">
                <div class='input-group'>
                    <input type='text' id="start" name='start' class="form-control" value="<?php echo!empty($start) ? $start : ''; ?>">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <label class="control-label col-sm-2" for="end">Bis:</label>
            <div class ="col-sm-3">
                <div class='input-group date'>
                    <input type='text' id="end" name='end' class="form-control" value="<?php echo!empty($end) ? $end : ''; ?>">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>     
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="cost">Kosten in CHF:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="cost" name="cost" value="<?php echo!empty($cost) ? $cost : ''; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="contact">Kontakt E-Mail:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="contact" name="contact" value="<?php echo!empty($contact) ? $contact : ''; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="txt">Beschreibung:</label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="10" id="txt" name="txt"><?php echo!empty($text) ? $text : ''; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="result">Resultat:</label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="10" id="result" name="result"><?php echo!empty($result) ? $result : ''; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-success" value="send">Ändern</button>
                <a class="btn btn-default" href="myCourse.php">Abbrechen</a>
            </div>
        </div>
    </form>
</div>
<?php
include ("login/login_alert.php");
include ("Layout/login.html");
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
                            regexp: /^[0-9]{20}$/
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