<?php
    session_start();
    include("login/header.php");
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <!-- alert window for a successful enrolement-->
    <?php include("success_enrolement.php"); ?>
    
    <h1>FH-Anmeldung</h1>
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
                <input type="number" class="form-control" id="postalcode" name="postalcode">
            </div>
            <label class="control-label col-sm-1" for="city">Ort:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="city" name="city">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="website">Webseite:</label>
            <div class="col-sm-6">
                <input type="url" class="form-control" id="website" name="website">
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
                <button type="submit" class="btn btn-default">Anmeldung absenden</button>
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
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
        <script id="source" language="javascript" type="text/javascript">
            $(document).ready(function () {
                $('#enrolementForm').bootstrapValidator({
                    container: '#messages',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        institution: {
                            validators: {
                                notEmpty: {
                                    message: 'Der Name der FH muss zwingend angegeben werden!'
                                }
                            }
                        },
                        partner: {
                            validators: {
                                notEmpty: {
                                    message: 'Ein Ansprechpartner muss zwingend angegeben werden!'
                                }
                            }
                        },
                        street: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Strasse muss zwingend angegeben werden!'
                                }
                            }
                        },
                        postalcode: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Postleitzahl muss zwingend angegeben werden!'
                                }
                            }
                        },
                        city: {
                            validators: {
                                notEmpty: {
                                    message: 'Ein Ort muss zwingend angegeben werden!'
                                }  
                            }
                        },
                        website: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Webseite muss zwingend angegeben werden!'
                                },
                                website: {
                                    message: 'Sie haben keine gültige URL eingegeben'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Ein Ort muss zwingend angegeben werden!'
                                },
                                emailAddress: {
                                    message: 'Sie haben keine gültige Emailadresse eingegeben'
                                }
                            }
                        },
                        phonenumber: {
                            validators: {
                                notEmpty: {
                                    message: 'Eine Telefonnummer muss zwingend angegeben werden!'
                                },
                                regexp: {
                                    message: 'Die Telefonnummer darf nur Ziffern, Leerschläge, -, (, ), + und . enthalten.',
                                    regexp: /^[0-9\s\-()+\.]+$/
                                }
                            }
                        },
                        agree: {
                            validators: {
                                notEmpty: {
                                    message: 'Bitte bestätigen Sie die Allgemeinen Geschaftsbedingungen!'
                                }
                            }
                        }
                        
                    }
                });
            }); 
</script>