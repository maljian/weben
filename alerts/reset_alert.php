<?PHP
//Alert that enrolement was successful
if (isset($_SESSION['resetMessage']) AND $_SESSION['resetMessage']=="successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"resetSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Passwort erfolgreich geändert!</strong>
                </div>
            </div>";
        unset($_SESSION['resetMessage']);
        }
//Alert that old password is wrong 
if (isset($_SESSION['resetMessage']) AND $_SESSION['resetMessage']=="wrong password")
        {
        echo "<div class=\"panel-group\">
                <div id=\"resetWrongPW\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Das alte Passwort ist nicht richtig. Versuchen Sie es noch einmal.</strong>
                </div>
            </div>";
        unset($_SESSION['resetMessage']);
        }
//Alert that unable to reset password
if (isset($_SESSION['resetMessage']) AND $_SESSION['resetMessage']=="failed")
        {
        echo "<div class=\"panel-group\">
                <div id=\"resetFailed\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Passwort konnte nicht geändert werden! Versuchen Sie es noch einmal.</strong>
                </div>
            </div>";
        unset($_SESSION['resetMessage']);
        }  
if (isset($_SESSION['resetMessage']) AND $_SESSION['resetMessage']=="too short")
        {
        echo "<div class=\"panel-group\">
                <div id=\"resetTooShort\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Das neue Passwort ist zu kurz! Bitte wählen Sie ein Passwort mit mindestens 8 Zeichen.</strong>
                </div>
            </div>";
        unset($_SESSION['resetMessage']);
        }
?>

