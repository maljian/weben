<?PHP
//Alert that enrolement was successful
if (isset($_SESSION['message']) AND $_SESSION['message']=="Anmeldung erfolgreich")
        {
        echo "<div class=\"panel-group\">
                <div id=\"enrolementSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Anmeldung erfolgreich abgesendet!</strong>
                </div>
            </div>";
        unset($_SESSION['message']);
        }
            
?>

