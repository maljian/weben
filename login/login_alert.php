<?PHP
//Start of the Sidebar
echo "<div class = \"col-md-3\">";
//Alert that wrong Email or Password was entered
if (isset($_SESSION['message']) and $_SESSION['message']== "wrong email or pw")
        {
        echo "<div class=\"panel-group\">
                <div id=\"loginError\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Emailadresse oder Passwort ist falsch!</strong>
                </div>
            </div>";
        unset($_SESSION['message']);
        }
if (isset($_SESSION['message']) and $_SESSION['message']== "login successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"loginSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Sie wurden erfolgreich eingeloggt!</strong>
                </div>
            </div>";
        unset($_SESSION['message']);
        }        
if (isset($_SESSION['pwReset']) and $_SESSION['pwReset']== "successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"pwResetSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Das neu generierte Passwort wird Ihnen per Email zugestellt.</strong>
                </div>
            </div>";
        unset($_SESSION['pwReset']);
        } 
if (isset($_SESSION['pwReset']) and $_SESSION['pwReset']== "failed")
        {
        echo "<div class=\"panel-group\">
                <div id=\"pwResetSuccess\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Email-Adresse nicht vorhanden, bitte kontaktieren Sie denn Admin bei weiteren Fragen.</strong>
                </div>
            </div>";
        unset($_SESSION['pwReset']);
        } 
                    
?>



