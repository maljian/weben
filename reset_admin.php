<?php
    session_start();
    include("login/login_pruefen_admin.inc.php");
    include("login/header.php");
    include 'db.inc.php';
?>
    <!-- Main content -->
    <div class = "col-md-7" id="mainBody">
        <?php include("alerts/reset_alert.php"); ?>
        <h1> Passwort anpassen</h1>
        </br>
        <form id="passwordForm" role="form" action="login/reset_password_admin.php" method="POST" class="form-horizontal">
            <div class="form-group">
            <label class="control-label col-sm-2" for="oldPwd">Altes Passwort:</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="oldPwd" name="oldPwd">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="newPwd">Neues Passwort:</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="newPwd" name="newPwd">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="confirmPwd">Nochmals:</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="confirmPwd" name="confirmPwd">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-6">
                <a type="submit" class="btn btn-success" role="button">Passwort ändern</a>
                <a class="btn btn-default" href="index.php">Abbrechen</a>
            </div>      
        </div>
	</form>
    </div>
    <?php
        include ("login/login_alert.php");
        include ("Layout/login.html");
        include ("Layout/ads.html");
        include ("Layout/footer.html");
    ?>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
       <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  -->
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
        <script id="source" language="javascript" type="text/javascript">
            $(document).ready(function () {
                $('#passwordForm').bootstrapValidator({
                    // Source: http://formvalidation.io/examples/showing-message-custom-area/
                    err: {
                        container: function($field, validator) {
                        // Look at the markup
                        //  <div class="col-xs-4">
                        //      <field>
                        //  </div>
                        //  <div class="col-xs-5 messageContainer"></div>
                        return $field.parent().next('.messageContainer');
                        }
                    },
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        newPwd: {
                            validators: {
                                identical: {
                                    field: 'confirmPwd',
                                    message: 'Die Passwörter stimmen nicht überein!'
                                }
                            }
                        },
                        confirmPwd: {
                            validators: {
                                identical: {
                                    field: 'newPwd',
                                    message: 'Die Passwörter stimmen nicht überein!'
                                }
                            }
                        }  
                    }
                });
            }); 
</script>