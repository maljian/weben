<?PHP
//Start of the Sidebar
echo "<div class = \"col-md-3\">";
//Alert that wrong Email or Password was entered
if (isset($_SESSION['message']) and $_SESSION['message']== "Falsche Emailadresse oder Passwort")
        {
        echo "<div class=\"panel-group\">
                <div id=\"loginError\" class=\"alert alert-danger\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Emailadresse oder Passwort ist falsch!</strong>
                </div>
            </div>";
        unset($_SESSION['message']);
        }
            
?>

