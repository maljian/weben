<?php
    session_start();
    include("login/header.php");
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <!-- alert window for a successful enrolement-->
    <?php include("alerts/enrolement_alert.php"); ?>
    
    <h1>FH-Anmeldung</h1>
    </br>
    <form id="enrolementForm" class="form-horizontal" role="form" action="admin/fh_enrolement_save.php" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-2" for="institution">Institution:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="institution" name="institution">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="partner">Ansprechpartner:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="partner" name="partner">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="street">Strasse:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="street" name="street">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="postalcode">PLZ:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="postalcode" name="postalcode">
            </div>
            <label class="control-label col-sm-1" for="city">Ort:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="city" name="city">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="website">Webseite:</label>
            <div class="col-sm-6">
                <input type="url" class="form-control" id="website" name="website" placeholder="http://">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Emailadresse:</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="phonenumber">Telefonnummer:</label>
            <div class="col-sm-6">
                <input type="tel" class="form-control" id="phonenumber" name="phonenumber">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="region">Region:</label>
            <div class="col-sm-6 selectContainer"> 
                <select class="form-control text-center" id="region" name="region">
                        <option selected disabled>Bitte wählen</option>
                        <option value="Nordwestschweiz">Nordwestschweiz</option>
                        <option value="Zentralschweiz">Zentralschweiz</option>
                        <option value="Ostschweiz">Ostschweiz</option>
                        <option value="Westschweiz">Westschweiz</option>
                        <option value="Raum Zürich">Raum Z&uuml;rich</option>
                        <option value="Raum Bern">Raum Bern</option>
                        <option value="Gesamtschweiz">Gesamtschweiz</option>
                </select>
            </div>   
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-6">
                <input type="checkbox" name="agree" value="agree"> Hiermit bestätige ich, dass ich die <a href="agb.html" target="_blank" onclick="window.open('agb.html', 'newwindow', 'width=600, height=500'); return false;">AGB</a> gelesen habe und diese akzeptiere.
            </div>      
        </div>
        <div class="form-group">
                <div class="col-sm-6">
                    <div id="messages"></div>
                </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-success">Anmeldung absenden</button>
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
                $('#enrolementForm').bootstrapValidator({
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
                        institution: {
                            validators: {
                                notEmpty: {
                                    message: 'Der Name der FH muss zwingend angegeben werden.'
                                }
                            }
                        },
                        partner: {
                            validators: {
                                notEmpty: {
                                    message: 'Ein Ansprechpartner muss zwingend angegeben werden.'
                                }
                            }
                        },
                        street: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Strasse muss zwingend angegeben werden.'
                                }
                            }
                        },
                        postalcode: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Postleitzahl muss zwingend angegeben werden.'
                                },
                                regexp: {
                                    message: 'Die Postleitzahl muss aus 4 oder 5 Ziffern bestehen.',
                                    regexp: /^[0-9]{4,5}$/
                                }
                            }
                        },
                        city: {
                            validators: {
                                notEmpty: {
                                    message: 'Ein Ort muss zwingend angegeben werden.'
                                }  
                            }
                        },
                        website: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Webseite muss zwingend angegeben werden.'
                                },
                                uri: {
                                    message: 'Sie haben keine gültige URL eingegeben. Bitte stellen Sie zwingend http:// oder https:// vor das www!'
                                },
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
                                notEmpty: {
                                    message: 'Eine Telefonnummer muss zwingend angegeben werden.'
                                },
                                regexp: {
                                    message: 'Die Telefonnummer darf nur Ziffern, Leerschläge, -, (, ), + und . enthalten.',
                                    regexp: /^[0-9\s\-()+\.]+$/
                                }
                            }
                        },
                        region: {
                            validators: {
                                callback: {
                                    message: 'Bitte wählen Sie die Region in welcher sich Ihre Institution befindet.',
                                    callback: function(value, validator, $field) {
                                        // Get the selected options
                                        var options = validator.getFieldElements('region').val();
                                        return (options != null && options.length >= 2);
                                    }
                                }
                            }
                        },
                        agree: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte bestätigen Sie die Allgemeinen Geschaftsbedingungen.'
                                }
                            }
                        }
                        
                    }
                });
            }); 
</script>