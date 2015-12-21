<?PHP
//Alert that fhinfo update was successful
if (isset($_SESSION['resetFhinfoMessage']) AND $_SESSION['resetFhinfoMessage']=="successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"fhinfoSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Ihre Informationen wurden erfolgreich aktualisiert!</strong>
                </div>
            </div>";
        unset($_SESSION['enrolementMessage']);
        }
?>

