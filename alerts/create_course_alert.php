<?PHP
//Alert that course was successfully created     
if (isset($_SESSION['createCourseMessage']) AND $_SESSION['createCourseMessage']=="successful")
        {
        echo "<div class=\"panel-group\">
                <div id=\"createCourseSuccess\" class=\"alert alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Der Kurs wurde erfolgreich erfasst!</strong>
                </div>
            </div>";
        unset($_SESSION['createCourseMessage']);
        } 
?>

