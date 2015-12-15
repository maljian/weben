<?PHP
//Alert that enrolement was successful
if (isset($_SESSION['enrolementMessage']) AND $_SESSION['enrolementMessage']=="successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"enrolementSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Anmeldung erfolgreich abgesendet!</strong>
                </div>
            </div>";
        unset($_SESSION['enrolementMessage']);
        }
//Alert that enrolement failed        
if (isset($_SESSION['enrolementMessage']) AND $_SESSION['enrolementMessage']=="failed")
        {
        echo "<div class=\"panel-group\">
                <div id=\"enrolementFailed\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Anmeldung konnte nicht übermittelt werden! Versuchen Sie er erneut.</strong>
                </div>
            </div>";
        unset($_SESSION['enrolementMessage']);
        }            
?>

