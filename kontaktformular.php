<?php
session_start();
include("login/header.php");
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <h1>Kontaktformular</h1>
    <br/>
    <?php    include ("success_contact.php") ?>
    <!-- Kontaktformular für die Webseite -->
    <form class="form-horizontal" id="contactForm" role="form" action="sendContact.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="gender">Anrede:</label>
            <div class="selectContainer col-sm-2"> 
                <select class="form-control text-center" id="gender" name="gender">
                    <option value=""></option>
                    <option value="Frau">Frau</option>
                    <option value="Herr">Herr</option>
                </select>
            </div>      
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="firstname">Vorname: *</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="lastname">Nachname: *</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Emailadresse: *</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="phonenumber">Telefonnummer:</label>
            <div class="col-sm-4">
                <input type="tel" class="form-control" id="phonenumber" name="phonenumber">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="question">Anfrage: *</label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="10" id="question" name="question" required></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-default" value="send">Senden</button>
                <button type="reset" class="btn btn-default" value="reset">Abbrechen</button>
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
<!--Codeteile von Rainer Telesko aus dem Web-Engineering Modul.-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
       <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  -->
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
        <script id="source" language="javascript" type="text/javascript">
            $(document).ready(function () {
                $('#contactForm').bootstrapValidator({
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
                        gender: {
                            validators: {
                                callback: {
                                    message: 'Bitte wählen Sie eine Anrede.',
                                    callback: function(value, validator, $field) {
                                        // Get the selected options
                                        var options = validator.getFieldElements('gender').val();
                                        return (options != null && options.length >= 2);
                                    }
                                }
                            }
                        },
                        firstname: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie Ihren Vornamen ein.'
                                }
                            }
                        },
                        lastname: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte geben Sie Ihren Nachnamen ein.'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Emailadresse muss zwingend angegeben werden.'
                                },
                                emailAddress: {
                                    message: 'Sie haben keine gültige Emailadresse eingegeben.'
                                }
                            }
                        },
                        phonenumber: {
                            validators: {
                                regexp: {
                                    message: 'Die Telefonnummer darf nur Ziffern, Leerschläge, -, (, ), + und . enthalten.',
                                    regexp: /^[0-9\s\-()+\.]+$/
                                }
                            }
                        },
                        question: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Anfrage muss zwingend angegeben werden.'
                                },
                                stringLength: {
                                    max: 500,
                                    message: 'Ihre Anfrage darf maximal 500 Zeichen lang sein!'
                                }
                            }
                        }
                    }
                });
            }); 
</script>