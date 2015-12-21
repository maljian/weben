<?PHP
//Alert that course delete was successful
if (isset($_SESSION['changeMessage']) AND $_SESSION['changeMessage']=="deleted")
        {
        echo "<div class=\"panel-group\">
                <div id=\"deleteSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Kurs erfolgreich gelöscht!</strong>
                </div>
            </div>";
        unset($_SESSION['changeMessage']);
        }
//Alert that course update was successful
if (isset($_SESSION['changeMessage']) AND $_SESSION['changeMessage']=="updated")
        {
        echo "<div class=\"panel-group\">
                <div id=\"updateSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Kurs erfolgreich aktualisiert!</strong>
                </div>
            </div>";
        unset($_SESSION['changeMessage']);
        }
?>

