<?php
    session_start();
    include("login/header.php");
?>
<!-- Main content -->
<div class = "col-md-7" id="mainBody">
    <?php include("success_enrolement.php"); ?>
    <h1>FH-Anmeldung</h1>
    <form class="form-horizontal" role="form" action="admin/fh_enrolement_save.php" method="POST">
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
                <input type="checkbox"> Hiermit bestätige ich, dass ich die <a href="">AGB</a> gelesen habe und diese akzeptiere.
            </div>      
        </div>
        <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-default" value="send">Anmeldung absenden</button>
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

