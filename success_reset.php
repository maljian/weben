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
                <div id=\"resetFailed\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Das alte Passwort ist nicht richtig. Versuchen Sie er noch einmal.</strong>
                </div>
            </div>";
        unset($_SESSION['resetMessage']);
        }
?>

