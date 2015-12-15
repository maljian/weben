<?PHP
if (isset($_SESSION['access']) and $_SESSION['access']== "denied")
        {
        echo "<div class=\"panel-group\">
                <div id=\"accessError\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Sie haben hier keine Zugriffsrechte!</strong>
                </div>
            </div>";
        unset($_SESSION['access']);
        }            
?>

