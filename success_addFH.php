<?PHP
//Alert that adding failed      
if (isset($_SESSION['acceptError']) AND $_SESSION['acceptError']=="failed")
        {
        echo "<div class=\"panel-group\">
                <div id=\"addFHFailed\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>FEHLER: Emailadresse ist bereits in der User oder FH Datenbank vorhanden!</strong>
                </div>
            </div>";
        unset($_SESSION['acceptError']);
        }  
?>

