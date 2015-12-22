<?PHP
//Alert buying ad was successful    
if (isset($_SESSION['buyAdMessage']) AND $_SESSION['buyAdMessage']=="successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"buyAdSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Die Werbeanfrage wurde erfolgreich versendet!</strong>
                </div>
            </div>";
        unset($_SESSION['buyAdMessage']);
        }  
?>

