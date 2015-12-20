<?PHP
//Alert that enrolement was successful
if (isset($_SESSION['contactMessage']) AND $_SESSION['contactMessage']=="successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"contactSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Die Anfrage wurde erfolgreich gesendet!</strong>
                </div>
            </div>";
        unset($_SESSION['contactMessage']);
        }
//Alert that enrolement failed        
if (isset($_SESSION['contactMessage']) AND $_SESSION['contactMessage']=="failed")
        {
        echo "<div class=\"panel-group\">
                <div id=\"contactFail\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Die Anfrage konnte nicht versendet werden! Versuchen Sie er erneut.</strong>
                </div>
            </div>";
        unset($_SESSION['contactMessage']);
        }  
if (isset($_SESSION['enrolementMessage']) AND $_SESSION['enrolementMessage']=="already exists")
        {
        echo "<div class=\"panel-group\">
                <div id=\"enrolementFailed\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Emailadresse ist bereit vorhanden. Bitte kontaktieren Sie uns.</strong>
                </div>
            </div>";
        unset($_SESSION['enrolementMessage']);
        }
?>

