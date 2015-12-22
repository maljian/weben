<?PHP
//Alert that adding failed      
if (isset($_SESSION['deleteAdMessage']) AND $_SESSION['deleteAdMessage']=="successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"deleteAdSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Die Werbeanzeige wurde erfolgreich gelöscht!</strong>
                </div>
            </div>";
        unset($_SESSION['deleteAdMessage']);
        }  
?>

