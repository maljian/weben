<?PHP
//Alert that adding failed      
if (isset($_SESSION['deleteFHMessage']) AND $_SESSION['deleteFHMessage']=="successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"deleteFHSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Die FH wurde erfolgreich gelöscht!</strong>
                </div>
            </div>";
        unset($_SESSION['deleteFHMessage']);
        }  
?>

