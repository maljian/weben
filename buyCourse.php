<?php
    session_start();
    include("login/login_pruefen_fh.inc.php");
    include("login/header.php");    
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h1>Kurse buchen</h1>
    <h2>Preisliste</h2>
    <br/>
    <table class="table table-striped table-bordered" style="width: 50%">
        <thead>
            <tr>
                <th style="width: 20%">Anzahl Kurse</th>
                <th style="width: 20%">Preis in CHF</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>10</td>
                <td>500.-</td>
            </tr>
            <tr>
                <td>20</td>
                <td>1000.-</td>
            </tr>
            <tr>
                <td>30</td>
                <td>1400.-</td>
            </tr>
            <tr>
                <td>40</td>
                <td>1800.-</td>
            </tr>
        </tbody>
    </table>
    <p>
        Bitte w&auml;hlen Sie die Anzahl Kurse, welche Sie buchen möchten.
    </p>

    <!-- Kontaktformular für die Webseite -->
    <form class="form-horizontal" id="buyCourse" role="form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="number">Anzahl: *</label>
            <div class="col-sm-2"> 
                <select class="form-control text-center" id="number" name="number">
                    <option selected disabled>Anzahl</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                </select>
            </div>      
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-success" value="send">Senden</button>
                <a class="btn btn-default" href="myCourse.php">Abbrechen</a>
            </div>      
        </div>
    </form>
</div>

<?php
if (!empty($_POST)) {
    $number = $_POST['number'];

include ("login/login_alert.php");
include ("Layout/login.html");
include ("Layout/ads.html");
include ("Layout/footer.html");

$_SESSION['number']=$number;
$_SESSION['id']=$id;
include("pdf/Kursrechnung/einzahlungsschein.php");
}
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
        redirect "pdf/Kursrechnung/einzahlungsschein.pdf";
        $('#buyCourse').bootstrapValidator({
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
                number: {
                    validators: {
                        callback: {
                            message: 'Bitte wählen Sie die gewünschte Anzahl an Kursen.',
                            callback: function (value, validator, $field) {
                                // Get the selected options
                                var options = validator.getFieldElements('number').val();
                                return (options != null && options.length >= 2);
                            }
                        }
                    }
                }
            }
        });
    });
</script>